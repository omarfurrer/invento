<?php

namespace App\Repositories;

use App\Repositories\Interfaces\ItemBatchesRepositoryInterface;
use App\Models\ItemBatch;
use Illuminate\Support\Collection;
use Carbon\Carbon;

class EloquentItemBatchesRepository extends EloquentAbstractRepository implements ItemBatchesRepositoryInterface {

    /**
     * Items Repository constructor.
     */
    public function __construct()
    {
        $this->modelClass = 'App\Models\ItemBatch';
    }

   

}
