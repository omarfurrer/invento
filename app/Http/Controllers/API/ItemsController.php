<?php

namespace App\Http\Controllers\API;

use App\Services\ItemsService;
use App\Http\Controllers\Controller;

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
     * Retrieve list of all items.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAll()
    {
        $items = $this->itemsService->getAllInitiallyApproved();
        $items->load('measurementUnit');
        return response()->json(compact('items'));
    }

}
