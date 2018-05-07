<?php

namespace App\Repositories;

use App\Repositories\Interfaces\ItemBatchesRepositoryInterface;
use App\Models\ItemBatch;
use Illuminate\Support\Collection;
use Carbon\Carbon;

class EloquentItemBatchesRepository extends EloquentAbstractRepository implements ItemBatchesRepositoryInterface {

    /**
     * Items Repository constructor.
     */
    public function __construct()
    {
        $this->modelClass = 'App\Models\ItemBatch';
    }

    /**
     * Create a new item batch.
     *
     * @param array $fields
     * @return mixed
     */
    public function create(array $fields = null)
    {
        if (!empty($fields['expiry_date'])) {
            $fields['expiry_date'] = Carbon::parse($fields['expiry_date'])->format('Y-m-d');
        }
        return parent::create($fields);
    }

    /**
     * Update an item batch.
     *
     * @param Integer $id
     * @param array $fields
     * @return mixed
     */
    public function update($id, array $fields = array())
    {
        if (!empty($fields['expiry_date'])) {
            $fields['expiry_date'] = Carbon::parse($fields['expiry_date'])->format('Y-m-d');
        }
        return parent::update($id, $fields);
    }

    /**
     * Find item batch by item ID and expiry date.
     * 
     * @param integer $itemID
     * @param string $expiryDate
     * @return ItemBatch
     */
    public function findByItemAndExpiry($itemID, $expiryDate)
    {
        return ItemBatch::where('item_id', $itemID)->where('expiry_date', Carbon::parse($expiryDate)->format('Y-m-d'))->first();
    }

    /**
     * Get all initial item batches of a specific item.
     * 
     * @param Integer $itemID
     * @return Collection
     */
    public function getInitialByItem($itemID)
    {
        return ItemBatch::where('is_initial', true)->where('item_id', $itemID)->get();
    }

}
