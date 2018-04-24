<?php

namespace App\Repositories;

use App\Repositories\Interfaces\SuppliersRepositoryInterface;
use App\Models\Supplier;

class EloquentSuppliersRepository extends EloquentAbstractRepository implements SuppliersRepositoryInterface {

    /**
     * Users Repository constructor.
     */
    public function __construct()
    {
        $this->modelClass = 'App\Models\Supplier';
    }

}
