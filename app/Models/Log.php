<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'log';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['item_id', 'quantity', 'user_id', 'item_batch_id', 'item_withdrawl_id', 'in', 'item_current_quantity'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['in' => 'boolean'];

    /**
     * A log belongs to an item.
     *
     * @return BelongsTo
     */
    public function item()
    {
        return $this->belongsTo('App\Models\Item');
    }

    /**
     * A log belongs to a user.
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * A log belongs to an item batch.
     *
     * @return BelongsTo
     */
    public function itemBatch()
    {
        return $this->belongsTo('App\Models\ItemBatch');
    }

    /**
     * A log belongs to an item withdrawl.
     *
     * @return BelongsTo
     */
    public function itemWithdrawl()
    {
        return $this->belongsTo('App\Models\ItemWithdrawl');
    }

}
