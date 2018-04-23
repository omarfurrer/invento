<?php

namespace App\Repositories\Interfaces;

interface UsersRepositoryInterface {

    /**
     * Return all users except super admins.
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllExceptSuperAdmins();
}
