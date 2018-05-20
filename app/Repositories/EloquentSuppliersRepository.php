<?php

namespace App\Repositories;

use App\Repositories\Interfaces\SuppliersRepositoryInterface;
use App\Models\Supplier;

class EloquentSuppliersRepository extends EloquentAbstractRepository implements SuppliersRepositoryInterface {

    /**
     * Users Repository constructor.
     */
    public function __construct()
    {
        $this->modelClass = 'App\Models\Supplier';
    }

    /**
     * Create a new supplier.
     * 
     * @param array $fields
     * @return Supplier
     */
    public function create(array $fields = null)
    {
        $supplier = parent::create($fields);

        if (isset($fields['contacts'])) {
            foreach ($fields['contacts'] as $contact) {
                if (!empty($contact['contact'])) {
                    $supplier->contacts()->create([
                        'contact' => $contact['contact'],
                        'type' => 'mobile'
                    ]);
                }
            }
        }

        return $supplier;
    }

    /**
     * Update an existing supplier.
     * 
     * @param Integer $id
     * @param array $fields
     * @return Supplier
     */
    public function update($id, array $fields = array())
    {
        $supplier = parent::update($id, $fields);

        if (isset($fields['contacts'])) {
            $supplier->contacts()->delete();
            foreach ($fields['contacts'] as $contact) {
                if (!empty($contact['contact'])) {
                    $supplier->contacts()->create([
                        'contact' => $contact['contact'],
                        'type' => 'mobile'
                    ]);
                }
            }
        }

        return $supplier;
    }

}
