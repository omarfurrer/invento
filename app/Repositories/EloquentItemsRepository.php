<?php

namespace App\Repositories;

use App\Repositories\Interfaces\ItemsRepositoryInterface;
use App\Models\Item;
use Illuminate\Support\Collection;
use Carbon\Carbon;

class EloquentItemsRepository extends EloquentAbstractRepository implements ItemsRepositoryInterface {

    /**
     * Items Repository constructor.
     */
    public function __construct()
    {
        $this->modelClass = 'App\Models\Item';
    }

    /**
     * Get items that need to be approved by an admin.
     * 
     * @return Collection
     */
    public function getNeedsInitialApproval()
    {
        return Item::where('is_initially_approved', false)->get();
    }

    /**
     * Set initial approval for an item.
     * 
     * @param Integer $id
     * @return Item
     */
    public function approveInitially($id)
    {
        $item = $this->getById($id);
        $item->is_initially_approved = true;
        $item->initially_approved_at = Carbon::now();
        return $item;
    }

}
