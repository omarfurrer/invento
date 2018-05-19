<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Repositories\Interfaces\SuppliersRepositoryInterface;
use App\Repositories\Interfaces\SupplierContactsRepositoryInterface;

class SyncSuppliersWithSupplierContacts extends Migration {

    /**
     * @var SuppliersRepositoryInterface 
     */
    protected $suppliersRepository;

    /**
     * @var SupplierContactsRepositoryInterface 
     */
    protected $supplierContactsRepository;

    /**
     * SyncSuppliersWithSupplierContacts constructor.
     */
    public function __construct()
    {
        $this->suppliersRepository = app()->make(SuppliersRepositoryInterface::class);
        $this->supplierContactsRepository = app()->make(SupplierContactsRepositoryInterface::class);
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $suppliers = $this->suppliersRepository->all();
        foreach ($suppliers as $supplier) {
            $this->supplierContactsRepository->create([
                'type' => 'mobile',
                'contact' => $supplier->contact_number,
                'supplier_id' => $supplier->id
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $supplierContacts = $this->supplierContactsRepository->all();
        foreach ($supplierContacts as $supplierContact) {
            $this->suppliersRepository->update($supplierContact->supplier_id, [
                'contact_number' => $supplierContact->contact
            ]);
        }
        $this->supplierContactsRepository->truncate();
    }

}
