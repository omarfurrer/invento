<?php

namespace App\Http\Controllers\Admin;

use App\Models\Item;
use App\Services\ItemsService;
use Illuminate\Support\Facades\Auth;
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
     * Get all items that require admin approval.
     * 
     * @return \Illuminate\View\View
     */
    public function getNeedsInitialApproval()
    {
        $items = $this->itemsService->getNeedsInitialApproval();
        return view('admin.items.indexApproval', compact('items'));
    }

    /**
     * Set initial approval of an item.
     * 
     * @param Item $item
     */
    public function approveInitially(Item $item)
    {
        $item = $this->itemsService->approveInitially($item->id, Auth::user());

        if (!$item) {
            \Session::flash('flash_message_error', $this->itemsService->getErrorMessage());
            return redirect()->back();
        }

        \Session::flash('flash_message_success', 'Item approved.');
        return redirect()->to('/admin/items/approval/initial');
    }

}
