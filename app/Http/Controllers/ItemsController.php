<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\ItemsRepositoryInterface;
use App\Services\ItemsService;
use App\Http\Requests\Items\StoreItemRequest;
use App\Http\Requests\Items\UpdateItemRequest;
use Illuminate\Support\Facades\Auth;

class ItemsController extends Controller {

    /**
     * @var ItemsService 
     */
    protected $itemsService;

    /**
     * ItemsController Constructor.
     * 
     * @param ItemsService $itemsService
     */
    public function __construct(ItemsService $itemsService)
    {
        $this->itemsService = $itemsService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = $this->itemsService->getAll();
        return view('items.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dependencies = $this->itemsService->getCreate();
        return view('items.create', $dependencies);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreItemRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreItemRequest $request)
    {
        $item = $this->itemsService->create($request->all(), Auth::user());

        \Session::flash('flash_message_success', 'Item Created.');
        return redirect()->to('/items');
    }

    /**
     * Display the specified resource.
     *
     * @param  Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        $dependencies = $this->itemsService->getEdit($item->id);
        return view('items.edit', $dependencies);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateItemRequest $request
     * @param  Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateItemRequest $request, Item $item)
    {
        $item = $this->itemsService->edit($item->id, $request->all(), Auth::user());

        if (!$item) {
            \Session::flash('flash_message_error', $this->itemsService->getErrorMessage());
            return redirect()->back();
        }

        \Session::flash('flash_message_success', 'Item Updated.');
        return redirect()->to('/items');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        $item = $this->itemsService->delete($item, Auth::user());

        if (!$item) {
            \Session::flash('flash_message_error', $this->itemsService->getErrorMessage());
            return redirect()->back();
        }

        \Session::flash('flash_message_success', 'Item Deleted.');
        return redirect()->to('/items');
    }

}
