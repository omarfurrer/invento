<?php

namespace App\Services;

use App\Repositories\Interfaces\ItemsRepositoryInterface;
use App\Repositories\Interfaces\SuppliersRepositoryInterface;
use App\Repositories\Interfaces\MeasurementUnitsRepositoryInterface;
use App\Models\Item;

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
     * Get all items.
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return $this->itemsRepository->all();
    }

}
