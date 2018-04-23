<?php

namespace App\Repositories;

use App\Repositories\Interfaces\UsersRepositoryInterface;
use App\User;
use Spatie\Permission\Models\Role;

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
     * @param string|integer $role
     * @return mixed
     */
    public function create(array $fields = null, $role = 'employee')
    {
        if (!empty($fields['password'])) {
            $fields['password'] = bcrypt($fields['password']);
        } else {
            $fields['password'] = bcrypt('12345678');
        }

        $user = parent::create($fields);

        if (is_numeric($role)) {
            $role = Role::findById($role)->name;
        }

        $user->assignRole($role);

        return $user;
    }

    /**
     * Update a user.
     *
     * @param Integer $id
     * @param array $fields
     * @param string|integer $role
     * @return mixed
     */
    public function update($id, array $fields = array(), $role = 'employee')
    {
        $user = parent::update($id, $fields);

        $user->roles()->detach();

        if (is_numeric($role)) {
            $role = Role::findById($role)->name;
        }

        $user->assignRole($role);

        return $user;
    }

    /**
     * Return all users except super admins.
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllExceptSuperAdmins()
    {
        return User::whereHas('roles', function($q) {
                    $q->where('name', '!=', 'super admin');
                })->get();
    }

}
