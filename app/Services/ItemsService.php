<?php

namespace App\Services;

use App\Repositories\Interfaces\ItemsRepositoryInterface;
use App\Repositories\Interfaces\SuppliersRepositoryInterface;
use App\Repositories\Interfaces\MeasurementUnitsRepositoryInterface;
use App\Models\Item;
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
     * ItemsService Constructor.
     * 
     * @param ItemsRepositoryInterface $itemsRepository
     * @param SuppliersRepositoryInterface $suppliersRepository
     * @param MeasurementUnitsRepositoryInterface $measurementUnitsRepository
     */
    public function __construct(ItemsRepositoryInterface $itemsRepository, SuppliersRepositoryInterface $suppliersRepository, MeasurementUnitsRepositoryInterface $measurementUnitsRepository)
    {
        $this->itemsRepository = $itemsRepository;
        $this->suppliersRepository = $suppliersRepository;
        $this->measurementUnitsRepository = $measurementUnitsRepository;
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
    public function create($data)
    {
        $item = $this->itemsRepository->create($data);
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

        // check if initial quantity will be changed
        // inital quantity cannot be changed after it has been approved, except by and admin
        if ($item->initial_quantity != $data['initial_quantity'] && ($item->is_initially_approved || !$user->hasRole(['admin', 'super admin']))) {
            $this->addError('Only an admin can change inital item quantity after it has been approved.');
            return false;
        }

        // store pricing historic data
        if ($item->price != $data['price']) {
            /**
             * TODO : Store pricing historic data.
             */
        }

        $item = $this->itemsRepository->update($id, $data);
        return $item;
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
        return $this->itemsRepository->approveInitially($id);
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
        return $this->getAll()->where('is_initially_approved', true);
    }

    /**
     * Get all items that need initial admin approval.
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getNeedsInitialApproval()
    {
        return $this->itemsRepository->getNeedsInitialApproval();
    }

}
