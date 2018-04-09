<?php

namespace App\Repositories\Interfaces;

interface RolesRepositoryInterface {

    /**
     * Retrieve list of roles and their IDs.
     * 
     * @return array
     */
    public function lists();
}
