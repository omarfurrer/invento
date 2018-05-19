<?php

namespace App\Repositories;

use App\Repositories\Interfaces\SupplierContactsRepositoryInterface;
use App\Models\SupplierContact;

class EloquentSupplierContactsRepository extends EloquentAbstractRepository implements SupplierContactsRepositoryInterface {

    /**
     * SupplierContact Repository constructor.
     */
    public function __construct()
    {
        $this->modelClass = 'App\Models\SupplierContact';
    }

}
