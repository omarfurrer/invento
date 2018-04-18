<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'items';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['description', 'initial_quantity', 'current_quantity', 'minimum_quantity', 'price', 'expires_at', 'notes'
        , 'is_initially_approved', 'initially_approved_at', 'unit_id', 'supplier_id'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'initially_approved_at', 'expires_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['is_initially_approved' => 'boolean'];

    /**
     * An item belongs to a supplier.
     *
     * @return BelongsTo
     */
    public function supplier()
    {
        return $this->belongsTo('App\Models\Supplier');
    }

    /**
     * An item belongs to a measurement unit.
     *
     * @return BelongsTo
     */
    public function measurementUnit()
    {
        return $this->belongsTo('App\Models\MeasurementUnit', 'unit_id');
    }

}
