<?php

namespace App\Repositories;

use App\Repositories\Interfaces\RolesRepositoryInterface;
use Spatie\Permission\Models\Role;

class EloquentRolesRepository extends EloquentAbstractRepository implements RolesRepositoryInterface {

    /**
     * Users Repository constructor.
     */
    public function __construct()
    {
        $this->modelClass = 'Spatie\Permission\Models\Role';
    }

    /**
     * Retrieve list of roles and their IDs.
     * 
     * @return array
     */
    public function lists()
    {
        return Role::pluck('name', 'id');
    }

}
