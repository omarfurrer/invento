<?php

namespace App\Services;

use App\Repositories\Interfaces\ItemsRepositoryInterface;
use App\Repositories\Interfaces\SuppliersRepositoryInterface;
use App\Repositories\Interfaces\MeasurementUnitsRepositoryInterface;
use App\Repositories\Interfaces\ItemBatchesRepositoryInterface;
use App\Models\Item;
use App\Models\ItemBatch;
use App\User;

class ItemsService extends BaseService {

    /**
     * @var ItemsRepositoryInterface 
     */
    protected $itemsRepository;

    /**
     * @var SuppliersRepositoryInterface 
     */
    protected $suppliersRepository;

    /**
     * @var MeasurementUnitsRepositoryInterface 
     */
    protected $measurementUnitsRepository;

    /**
     * @var ItemBatchesRepositoryInterface
     */
    protected $itemBatchesRepository;

    /**
     * ItemsService Constructor.
     * 
     * @param ItemsRepositoryInterface $itemsRepository
     * @param SuppliersRepositoryInterface $suppliersRepository
     * @param MeasurementUnitsRepositoryInterface $measurementUnitsRepository
     * @param ItemBatchesRepositoryInterface $itemBatchesRepository
     */
    public function __construct(ItemsRepositoryInterface $itemsRepository, SuppliersRepositoryInterface $suppliersRepository, MeasurementUnitsRepositoryInterface $measurementUnitsRepository,
            ItemBatchesRepositoryInterface $itemBatchesRepository)
    {
        $this->itemsRepository = $itemsRepository;
        $this->suppliersRepository = $suppliersRepository;
        $this->measurementUnitsRepository = $measurementUnitsRepository;
        $this->itemBatchesRepository = $itemBatchesRepository;
    }

    /**
     * Get create dependencies.
     * 
     * @return array
     */
    public function getCreate()
    {
        $suppliers = $this->suppliersRepository->lists();
        $measurementUnits = $this->measurementUnitsRepository->lists();
        return compact('suppliers', 'measurementUnits');
    }

    /**
     * Create a new item.
     * 
     * @param array $data
     * @return Item
     */
    public function create($data, User $user)
    {
        $item = $this->itemsRepository->create($data);

        if (!empty($data['item_batches'])) {
            foreach ($data['item_batches'] as $itemBatch) {
                $this->itemBatchesRepository->create(array_merge(
                                $itemBatch,
                                [
                    'is_initial' => true,
                    'user_id' => $user->id,
                    'item_id' => $item->id
                                ]
                ));
            }
        }
        
        // If user adding the item is admin or super admin then bypass initial approval
        if ($user->hasRole(['admin', 'super admin'])) {
            $item = $this->approveInitially($item->id, $user);
        }

        return $item;
    }

    /**
     * Get edit dependencies.
     * 
     * @return array
     */
    public function getEdit($id)
    {
        $suppliers = $this->suppliersRepository->lists();
        $measurementUnits = $this->measurementUnitsRepository->lists();
        $item = $this->itemsRepository->getById($id);
        return compact('suppliers', 'measurementUnits', 'item');
    }

    /**
     * Update item record.
     * 
     * @param Integer $id
     * @param array $data
     * @param User $user
     * @return Item|Boolean
     */
    public function edit($id, $data, User $user)
    {
        $item = $this->itemsRepository->getById($id);

        $itemBatches = $this->itemBatchesRepository->findAllBy($item->id, 'item_id');

        $newItemBatches = collect($data['item_batches']);

        foreach ($itemBatches as $itemBatch) {
            $newItemBatch = $newItemBatches->firstWhere('id', '=', $itemBatch->id);

            if (empty($newItemBatch)) {
                continue;
            }

            // check if initial quantity will be changed
            // inital quantity cannot be changed after it has been approved, except by an admin
            if ($itemBatch->is_initial && $itemBatch->quantity != $newItemBatch['quantity'] && $item->is_initially_approved && !$user->hasRole(['admin', 'super admin'])) {
                $this->addError('Only an admin can change inital item quantity after it has been approved.');
                return false;
            }

            $this->itemBatchesRepository->update($itemBatch->id, $newItemBatch);
        }

        $item = $this->itemsRepository->update($id, $data);
        return $item;
    }

    /**
     * Delete an item.
     * 
     * @param Item $item
     * @param User $user
     * @return boolean
     */
    public function delete(Item $item, User $user)
    {
        if ($user->hasRole(['admin', 'super admin']) || !$this->isInitiallyApproved($item)) {
            return $this->itemsRepository->delete($item->id);
        }
        $this->addError('Only an admin can delete an item after it has been initially approved.');
        return false;
    }

    /**
     * Check whether an item has been initially approved or not.
     * 
     * @param Item $item
     * @return type
     */
    public function isInitiallyApproved(Item $item)
    {
        return $item->is_initially_approved;
    }

    /**
     * Set initial approval for an item. 
     * 
     * @param Integer $id
     * @param User $user
     * @return Item|Boolean
     */
    public function approveInitially($id, User $user)
    {
        if (!$user->hasRole(['admin', 'super admin'])) {
            $this->addError('Only an admin can give approval.');
            return false;
        }
        $item = $this->itemsRepository->approveInitially($id);
        $item = $this->updateCurrentQuantity($item);
        $this->updateItemBatchesCurrentQuantity($item);
        return $item;
    }

    /**
     * Get all items.
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return $this->itemsRepository->all();
    }

    /**
     * Get all items which have been initially approved by admin.
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllInitiallyApproved()
    {
        return $this->itemsRepository->getInitiallyApproved();
    }

    /**
     * Get all items that need initial admin approval.
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getNeedsInitialApproval()
    {
        $items = $this->itemsRepository->getNeedsInitialApproval();
        $items->map(function ($item, $key) {
            $item['current_quantity'] = $this->getTotalQuantity($item);
            return $item;
        });
        return $items->all();
    }

    /**
     * Update an Item's current quantity.
     * 
     * @param Item $item
     * @return Item
     */
    public function updateCurrentQuantity(Item $item)
    {
        $totalQuantity = $this->getTotalQuantity($item);
        return $this->itemsRepository->update($item->id, ['current_quantity' => $totalQuantity]);
    }

    /**
     * Update an Item's current quantity.
     * 
     * @param Item $item
     * @return Item
     */
    public function updateItemBatchesCurrentQuantity(Item $item)
    {
        $itemBatches = $this->getItemBatches($item);
        foreach ($itemBatches as $itemBatch) {
            $this->updateItemBatchCurrentQuantity($itemBatch);
        }
    }

    /**
     * Update current quantity for item batch.
     * 
     * TODO: update with item withdrawls
     * 
     * @param ItemBatch $itemBatch
     * @return ItemBatch
     */
    public function updateItemBatchCurrentQuantity(ItemBatch $itemBatch)
    {
        return $this->itemBatchesRepository->update($itemBatch->id, ['current_quantity' => $itemBatch->quantity]);
    }

    /**
     * Get total quantity from summing batch quantities.
     * 
     * TODO : Add subtracting of item withdrawls. 
     * 
     * @param Item $item
     * @return Integet
     */
    public function getTotalQuantity(Item $item)
    {
        return $this->getItemBatches($item)->sum('quantity');
    }

    /**
     * Get batches of a specific item.
     * 
     * @param Item $item
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getItemBatches(Item $item)
    {
        return $this->itemBatchesRepository->findAllBy($item->id, 'item_id');
    }

    /**
     * Get non zero batches of an item ordered by expiry date.
     * 
     * @param Item $item
     * @return type
     */
    public function getNonZeroItemBatches(Item $item)
    {
        return $this->itemBatchesRepository->getOrderByExpiryDate($item->id);
    }

    /**
     * Add quantity to Item.
     * 
     * @param Item $item
     * @param float $quantity
     * @return Item
     */
    public function addQuantity(Item $item, $quantity)
    {
        return $this->itemsRepository->update($item->id, ['current_quantity' => $item->current_quantity + $quantity]);
    }

    /**
     * Remove quantity from Item.
     * 
     * @param Item $item
     * @param float $quantity
     * @return Item
     */
    public function subtractQuantity(Item $item, $quantity)
    {
        return $this->itemsRepository->update($item->id, ['current_quantity' => $item->current_quantity - $quantity]);
    }

    /**
     * Add quantity to Item Batch.
     * 
     * @param ItemBatch $itemBatch
     * @param float $quantity
     * @return ItemBatch
     */
    public function addQuantityToItemBatch(ItemBatch $itemBatch, $quantity)
    {
        return $this->itemBatchesRepository->update($itemBatch->id, ['current_quantity' => $itemBatch->current_quantity + $quantity]);
    }

    /**
     * Remove quantity from Item Batch.
     * 
     * @param ItemBatch $itemBatch
     * @param float $quantity
     * @return ItemBatch
     */
    public function subtractQuantityFromItemBatch(ItemBatch $itemBatch, $quantity)
    {
        return $this->itemBatchesRepository->update($itemBatch->id, ['current_quantity' => $itemBatch->current_quantity - $quantity]);
    }

    /**
     * Check if quantity can be withdrawn from an item and a batch.
     * 
     * @param Item|null $item
     * @param ItemBatch|null $itemBatch
     * @param float $quantity
     * @return boolean
     */
    public function canWithdraw($item, $itemBatch, $quantity)
    {
        if (!empty($itemBatch)) {
            if (($itemBatch->current_quantity - $quantity) < 0) {
                return false;
            }
        }
        if (!empty($item)) {
            if (($item->current_quantity - $quantity) < 0) {
                return false;
            }
        }
        return true;
    }

}
