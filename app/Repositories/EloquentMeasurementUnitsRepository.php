<?php

namespace App\Repositories;

use App\Repositories\Interfaces\MeasurementUnitsRepositoryInterface;
use App\Models\MeasurementUnit;

class EloquentMeasurementUnitsRepository extends EloquentAbstractRepository implements MeasurementUnitsRepositoryInterface {

    /**
     * Users Repository constructor.
     */
    public function __construct()
    {
        $this->modelClass = 'App\Models\MeasurementUnit';
    }

  

}
