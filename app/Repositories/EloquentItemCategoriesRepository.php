<?php

namespace App\Repositories;

use App\Repositories\Interfaces\ItemCategoriesRepositoryInterface;
use App\Models\ItemCategory;

class EloquentItemCategoriesRepository extends EloquentAbstractRepository implements ItemCategoriesRepositoryInterface {

    /**
     * Users Repository constructor.
     */
    public function __construct()
    {
        $this->modelClass = 'App\Models\ItemCategory';
    }

}
