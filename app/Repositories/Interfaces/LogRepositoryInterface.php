<?php

namespace App\Repositories\Interfaces;

use Illuminate\Support\Collection;
use App\Models\Log;

interface LogRepositoryInterface {

    /**
     * Return log with ordering and filtering.
     * 
     * @param string $orderBy
     * @param string $order
     * @param string|null $itemID
     * @param string|null $fromDate
     * @param string|null $toDate
     * @return Collection
     */
    public function getAll($orderBy = 'id', $order = 'DESC', $itemID = null, $fromDate = null, $toDate = null);

    /**
     * Get all records that were created after a specific one and related to an item.
     * 
     * @param Log|Integer $log
     * @return Collection
     */
    public function getFollowingByItem($log);
}
