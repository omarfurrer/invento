<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemWithdrawl extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'item_withdrawls';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['quantity', 'item_batch_id', 'user_id', 'item_id'];

    /**
     * An item withdrawl belongs to an item.
     *
     * @return BelongsTo
     */
    public function item()
    {
        return $this->belongsTo('App\Models\Item');
    }

    /**
     * An item withdrawl belongs to an item batch.
     *
     * @return BelongsTo
     */
    public function itemBatch()
    {
        return $this->belongsTo('App\Models\ItemBatch');
    }

    /**
     * An item withdrawl belongs to a user.
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
