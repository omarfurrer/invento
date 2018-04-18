<?php

namespace App\Repositories;

use App\Repositories\Interfaces\ItemsRepositoryInterface;
use App\Models\Item;

class EloquentItemsRepository extends EloquentAbstractRepository implements ItemsRepositoryInterface {

    /**
     * Items Repository constructor.
     */
    public function __construct()
    {
        $this->modelClass = 'App\Models\Item';
    }

}
