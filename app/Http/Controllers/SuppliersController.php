<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Requests\Suppliers\StoreSupplierRequest;
use App\Http\Requests\Suppliers\UpdateSupplierRequest;
use App\Repositories\Interfaces\SuppliersRepositoryInterface;

class SuppliersController extends Controller {

    /**
     * @var SuppliersRepositoryInterface 
     */
    protected $suppliersReposiotry;

    /**
     * SuppliersController Constructor.
     * 
     * @param SuppliersRepositoryInterface $suppliersReposiotry
     */
    public function __construct(SuppliersRepositoryInterface $suppliersReposiotry)
    {
        $this->suppliersReposiotry = $suppliersReposiotry;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = $this->suppliersReposiotry->all();
        return view('suppliers.index', compact("suppliers"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('suppliers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreSupplierRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSupplierRequest $request)
    {
        $supplier = $this->suppliersReposiotry->create($request->all());

        \Session::flash('flash_message_success', 'Supplier Created.');
        return redirect()->to('/suppliers');
    }

    /**
     * Display the specified resource.
     *
     * @param  Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        return view('suppliers.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateSupplierRequest $request
     * @param  Supplier $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSupplierRequest $request, Supplier $supplier)
    {
        $supplier = $this->suppliersReposiotry->update($supplier->id, $request->all());

        \Session::flash('flash_message_success', 'Supplier updated.');
        return redirect()->to('/suppliers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        $this->suppliersReposiotry->delete($supplier);

        \Session::flash('flash_message_success', 'Supplier Deleted.');

        return redirect()->to('/suppliers');
    }

}
