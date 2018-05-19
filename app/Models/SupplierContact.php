<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupplierContact extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'supplier_contacts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['type', 'contact', 'supplier_id'];

    /**
     * A contact number belongs to a supplier.
     *
     * @return BelongsTo
     */
    public function supplier()
    {
        return $this->belongsTo('App\Models\Supplier');
    }

}
