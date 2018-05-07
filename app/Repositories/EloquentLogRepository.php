<?php

namespace App\Repositories;

use App\Repositories\Interfaces\LogRepositoryInterface;
use App\Models\Log;
use Illuminate\Support\Collection;
use Carbon\Carbon;

class EloquentLogRepository extends EloquentAbstractRepository implements LogRepositoryInterface {

    /**
     * Items Repository constructor.
     */
    public function __construct()
    {
        $this->modelClass = 'App\Models\Log';
    }

    /**
     * Get all log sorted.
     * 
     * @param string $orderBy
     * @param string $order
     * @return Collection
     */
    public function getAllOrderBy($orderBy = 'id', $order = 'DESC')
    {
        return Log::orderBy($orderBy, $order)->get();
    }

    /**
     * Get all records that were created after a specific one and related to an item.
     * 
     * @param Log|Integer $log
     * @return Collection
     */
    public function getFollowingByItem($log)
    {
        if (!($log instanceof Log)) {
            $log = $this->logRepository->getById($log);
        }
        return Log::where('item_id', $log->item_id)->where('id', '>', $log->id)->get();
    }

}
