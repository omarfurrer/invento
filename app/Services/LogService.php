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

        return $this->logRepository->create([
                    'item_id' => $itemID,
                    'quantity' => $quantity,
                    'user_id' => $user->id,
                    'item_batch_id' => $itemBatch->id,
                    'item_withdrawl_id' => null,
                    'in' => true,
                    'item_current_quantity' => $item->current_quantity
        ]);
    }

    /**
     * Get create log out dependencies.
     * 
     * @return array
     */
    public function getCreateOut()
    {
        $items = $this->itemsRepository->getInitiallyApproved();
        return compact('items');
    }

    /**
     * Create a new log out.
     * 
     * @param Integer $itemID
     * @param float $quantity
     * @param Integer $itemBatchID
     * @param User $user
     * @return Log
     */
    public function createOut($itemID, $quantity, $itemBatchID, User $user)
    {
        $item = $this->itemsRepository->getById($itemID);

        $itemWithdrawl = $this->itemWithdrawlsRepository->create([
            'item_id' => $itemID,
            'quantity' => $quantity,
            'item_batch_id' => $itemBatchID,
            'user_id' => $user->id
        ]);

        $item = $this->itemsService->subtractQuantity($item, $quantity);

        $itemBatch = $this->itemBatchesRepository->getById($itemBatchID);

        $this->itemsService->subtractQuantityFromItemBatch($itemBatch, $quantity);

        return $this->logRepository->create([
                    'item_id' => $itemID,
                    'quantity' => $quantity,
                    'user_id' => $user->id,
                    'item_batch_id' => $itemBatch->id,
                    'item_withdrawl_id' => $itemWithdrawl->id,
                    'in' => false,
                    'item_current_quantity' => $item->current_quantity
        ]);
    }

}
