<?php

namespace App\Services;

use App\Repositories\Interfaces\ItemsRepositoryInterface;
use App\Repositories\Interfaces\ItemBatchesRepositoryInterface;
use App\Repositories\Interfaces\ItemWithdrawlsRepositoryInterface;
use App\Repositories\Interfaces\LogRepositoryInterface;
use App\Models\Item;
use App\Models\ItemBatch;
use App\Models\ItemWithdrawl;
use App\User;
use App\Services\ItemsService;
use App\Models\Log;
use Illuminate\Support\Collection;

class LogService extends BaseService {

    /**
     * @var ItemsRepositoryInterface 
     */
    protected $itemsRepository;

    /**
     * @var ItemBatchesRepositoryInterface
     */
    protected $itemBatchesRepository;

    /**
     * @var ItemWithdrawlsRepositoryInterface 
     */
    protected $itemWithdrawlsRepository;

    /**
     * @var ItemsService 
     */
    protected $itemsService;

    /**
     * @var LogRepositoryInterface 
     */
    protected $logRepository;

    /**
     * Used to handle differences when working with an API.
     * @var boolean 
     */
    protected $isAPI;

    /**
     * LogService Constructor.
     * 
     * @param ItemsRepositoryInterface $itemsRepository
     * @param ItemBatchesRepositoryInterface $itemBatchesRepository
     * @param ItemWithdrawlsRepositoryInterface $itemWithdrawlsRepository
     * @param ItemsService $itemsService
     * @param LogRepositoryInterface $logRepository
     */
    public function __construct(ItemsRepositoryInterface $itemsRepository, ItemBatchesRepositoryInterface $itemBatchesRepository, ItemWithdrawlsRepositoryInterface $itemWithdrawlsRepository,
            ItemsService $itemsService, LogRepositoryInterface $logRepository)
    {
        $this->itemsRepository = $itemsRepository;
        $this->itemBatchesRepository = $itemBatchesRepository;
        $this->itemWithdrawlsRepository = $itemWithdrawlsRepository;
        $this->itemsService = $itemsService;
        $this->logRepository = $logRepository;
        $this->isAPI = false;
    }

    /**
     * Get all log records.
     * 
     * @return Collection
     */
    public function getAll()
    {
        return $this->logRepository->getAllOrderBy();
    }

    /**
     * Get create log in dependencies.
     * 
     * @return array
     */
    public function getCreateIn()
    {
        $items = $this->itemsRepository->getInitiallyApproved();
//        $items = $this->itemsRepository->getInitiallyApproved()->pluck('description','id');
        return compact('items');
    }

    /**
     * Create a new log in.
     * 
     * @param Integer $itemID
     * @param float $quantity
     * @param string $expiryDate
     * @param float $unitPrice
     * @param User $user
     * @return Log
     */
    public function createIn($itemID, $quantity, $expiryDate, $unitPrice, User $user)
    {
        $item = $this->itemsRepository->getById($itemID);

        $itemBatch = $this->itemBatchesRepository->create([
            'item_id' => $itemID,
            'quantity' => $quantity,
            'expiry_date' => $expiryDate,
            'unit_price' => $unitPrice,
            'user_id' => $user->id,
            'current_quantity' => $quantity
        ]);

        $item = $this->itemsService->addQuantity($item, $quantity);

        $log = $this->logRepository->create([
            'item_id' => $itemID,
            'quantity' => $quantity,
            'user_id' => $user->id,
            'item_batch_id' => $itemBatch->id,
            'item_withdrawl_id' => null,
            'in' => true,
            'item_current_quantity' => $item->current_quantity
        ]);

        if ($this->isAPI) {
            $log->load('user', 'item.measurementUnit');
        }
        return $log;
    }

    /**
     * Get create log out dependencies.
     * 
     * @return array
     */
    public function getCreateOut()
    {
        $items = $this->itemsRepository->getInitiallyApproved();
//        $items = $this->itemsRepository->getInitiallyApproved()->pluck('description','id');
        return compact('items');
    }

    /**
     * Create a new log out.
     * 
     * @param Integer $itemID
     * @param float $quantity
     * @param Integer $itemBatchID
     * @param User $user
     * @return Log|boolean
     */
    public function createOut($itemID, $quantity, $itemBatchID, User $user)
    {
        $item = $this->itemsRepository->getById($itemID);
        $itemBatch = $this->itemBatchesRepository->getById($itemBatchID);

        if (!$this->itemsService->canWithdraw($item, $itemBatch, $quantity)) {
            $this->addError("Not enough {$item->description} remain.");
            return false;
        }

        $itemWithdrawl = $this->itemWithdrawlsRepository->create([
            'item_id' => $itemID,
            'quantity' => $quantity,
            'item_batch_id' => $itemBatchID,
            'user_id' => $user->id
        ]);

        $item = $this->itemsService->subtractQuantity($item, $quantity);

        $this->itemsService->subtractQuantityFromItemBatch($itemBatch, $quantity);

        $log = $this->logRepository->create([
            'item_id' => $itemID,
            'quantity' => $quantity,
            'user_id' => $user->id,
            'item_batch_id' => $itemBatch->id,
            'item_withdrawl_id' => $itemWithdrawl->id,
            'in' => false,
            'item_current_quantity' => $item->current_quantity
        ]);

        if ($this->isAPI) {
            $log->load('user', 'item.measurementUnit');
        }
        return $log;
    }

    /**
     * Delete a log record and undo its changes.
     * 
     * @param Log|Integer $log
     * @return boolean
     */
    public function delete($log)
    {
        if (!($log instanceof Log)) {
            $log = $this->logRepository->getById($log);
        }
        if ($log->in) {
            return $this->undoCreateIn($log);
        }
        return $this->undoCreateOut($log);
    }

    /**
     * Undo changes done by creating a log in.
     * 
     * @param Log $log
     * @return boolean
     */
    public function undoCreateIn(Log $log)
    {
        $item = $this->itemsRepository->getById($log->item_id);
        $itemBatch = $this->itemBatchesRepository->getById($log->item_batch_id);
        $quantity = $log->quantity;

        // update dependent records item_current_quantity
        $followingRecords = $this->logRepository->getFollowingByItem($log);
        foreach ($followingRecords as $followingRecord) {
            $this->logRepository->update($followingRecord->id, [
                'item_current_quantity' => $followingRecord->item_current_quantity - $quantity
            ]);
        }

        $this->itemBatchesRepository->delete($itemBatch);
        $item = $this->itemsService->subtractQuantity($item, $quantity);

        // update $item->quantity if there are records which withdraw from the deleted item batch
        $followingOutRecords = $followingRecords->where('in', false)->where('item_batch_id', $itemBatch->id);
        foreach ($followingOutRecords as $followingOutRecord) {
            $item = $this->itemsService->addQuantity($item, $followingOutRecord->quantity);
        }

        $this->logRepository->delete($log);

        return true;
    }

    /**
     * Undo changes done by creating a log out.
     * 
     * @param Log $log
     * @return boolean
     */
    public function undoCreateOut(Log $log)
    {
        $item = $this->itemsRepository->getById($log->item_id);
        $itemBatch = $this->itemBatchesRepository->getById($log->item_batch_id);
        $quantity = $log->quantity;

        // update dependent records item_current_quantity
        $followingRecords = $this->logRepository->getFollowingByItem($log);
        foreach ($followingRecords as $followingRecord) {
            $this->logRepository->update($followingRecord->id, [
                'item_current_quantity' => $followingRecord->item_current_quantity + $quantity
            ]);
        }

        $itemWithdrawl = $this->itemWithdrawlsRepository->getById($log->item_withdrawl_id);
        $this->itemWithdrawlsRepository->delete($itemWithdrawl);
        $item = $this->itemsService->addQuantity($item, $quantity);
        $itemBatch = $this->itemsService->addQuantityToItemBatch($itemBatch, $quantity);

        $this->logRepository->delete($log);

        return true;
    }

    /**
     * IsAPI getter.
     * 
     * @return boolean
     */
    function getIsAPI()
    {
        return $this->isAPI;
    }

    /**
     * IsAPI setter.
     * 
     * @param boolean $isAPI
     */
    function setIsAPI($isAPI)
    {
        $this->isAPI = $isAPI;
    }

}
