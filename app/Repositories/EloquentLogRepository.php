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

}
