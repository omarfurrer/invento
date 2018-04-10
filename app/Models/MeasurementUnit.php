<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MeasurementUnit extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'measurement_units';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['short_name', 'name'];

}
