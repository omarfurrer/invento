<?php

namespace App\Repositories;

use App\Repositories\Interfaces\ItemWithdrawlsRepositoryInterface;
use App\Models\ItemWithdrawl;

class EloquentItemWithdrawlsRepository extends EloquentAbstractRepository implements ItemWithdrawlsRepositoryInterface {

    /**
     * Users Repository constructor.
     */
    public function __construct()
    {
        $this->modelClass = 'App\Models\ItemWithdrawl';
    }

}
