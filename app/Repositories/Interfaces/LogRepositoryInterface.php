<?php

namespace App\Repositories\Interfaces;

interface LogRepositoryInterface {

    /**
     * Get all log sorted.
     * 
     * @param string $orderBy
     * @param string $order
     * @return Collection
     */
    public function getAllOrderBy($orderBy = 'id', $order = 'DESC');
}
