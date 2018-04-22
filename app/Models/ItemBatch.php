<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemBatch extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'item_batches';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['quantity', 'expiry_date', 'unit_price', 'current_quantity', 'is_initial', 'user_id', 'item_id'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'expiry_date'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['is_initial' => 'boolean'];

    /**
     * A product belongs to a therapy area
     *
     * @return BelongsTo
     */
    public function item()
    {
        return $this->belongsTo('App\Models\Item');
    }

}
