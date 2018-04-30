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

}
