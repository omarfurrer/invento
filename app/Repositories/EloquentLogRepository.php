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
     * Return log with ordering and filtering.
     * 
     * @param string $orderBy
     * @param string $order
     * @param string|null $itemID
     * @param string|null $fromDate
     * @param string|null $toDate
     * @return Collection
     */
    public function getAll($orderBy = 'id', $order = 'DESC', $itemID = null, $fromDate = null, $toDate = null)
    {
        $log = new Log;
        if (!empty($itemID)) {
            $log = $log->where('item_id', $itemID);
        }
        if (!empty($fromDate)) {
            $log->where('created_at', '>=', Carbon::parse($fromDate)->startOfDay());
        }
        if (!empty($toDate)) {
            $log->where('created_at', '<=', Carbon::parse($toDate)->endOfDay());
        }
        return $log->orderBy($orderBy, $order)->get();
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
