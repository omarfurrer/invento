<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Services\ItemsService;

class ItemBatchesController extends Controller {

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
     * Return item batches for an item.
     * 
     * @param Item $item
     * @return \Illuminate\Http\JsonResponse
     */
    public function getForItem(Item $item)
    {
        $itemBatches = $this->itemsService->getNonZeroItemBatches($item);
        return response()->json(compact('itemBatches'));
    }

}
