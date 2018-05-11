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
    protected $fillable = ['description', 'current_quantity', 'minimum_quantity', 'price', 'expires', 'notes'
        , 'is_initially_approved', 'initially_approved_at', 'image_path', 'unit_id', 'supplier_id'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'initially_approved_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['is_initially_approved' => 'boolean', 'expires' => 'boolean'];

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

    /**
     * An item has many batches.
     *
     * @return HasMany
     */
    public function itemBatches()
    {
        return $this->hasMany('App\Models\ItemBatch');
    }

}
