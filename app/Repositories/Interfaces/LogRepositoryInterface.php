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

    /**
     * Get all records that were created after a specific one and related to an item.
     * 
     * @param Log|Integer $log
     * @return Collection
     */
    public function getFollowingByItem($log);
}
