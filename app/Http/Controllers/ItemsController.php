<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\ItemsRepositoryInterface;
use App\Services\ItemsService;
use App\Http\Requests\Items\StoreItemRequest;
use App\Http\Requests\Items\UpdateItemRequest;

class ItemsController extends Controller {

    /**
     * @var ItemsRepositoryInterface 
     */
    protected $itemsRepository;

    /**
     * @var ItemsService 
     */
    protected $itemsService;

    /**
     * ItemsController Constructor.
     * 
     * @param ItemsRepositoryInterface $itemsRepository
     * @param ItemsService $itemsService
     */
    public function __construct(ItemsRepositoryInterface $itemsRepository, ItemsService $itemsService)
    {
        $this->itemsRepository = $itemsRepository;
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
        dd($dependencies);
        return view('items.edit', $dependencies);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateItemRequest $request
     * @param  Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        //
    }

}
