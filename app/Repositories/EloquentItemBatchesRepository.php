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

}
