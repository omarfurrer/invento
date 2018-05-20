<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'suppliers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * A supplier can have many contacts.
     *
     * @return HasMany
     */
    public function contacts()
    {
        return $this->hasMany('App\Models\SupplierContact');
    }

}
