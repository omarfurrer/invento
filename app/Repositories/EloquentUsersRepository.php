<?php

namespace App\Repositories;

use App\Repositories\Interfaces\UsersRepositoryInterface;
use App\User;

class EloquentUsersRepository extends EloquentAbstractRepository implements UsersRepositoryInterface {

    /**
     * Users Repository constructor.
     */
    public function __construct()
    {
        $this->modelClass = 'App\User';
    }

    /**
     * Create a new user.
     *
     * @param array $fields
     * @return mixed
     */
    public function create(array $fields = null, $role = 'employee')
    {
        if (!empty($fields['password'])) {
            $fields['password'] = bcrypt($fields['password']);
        }

        $user = parent::create($fields);

        $user->assignRole($role);

        return $user;
    }

}
