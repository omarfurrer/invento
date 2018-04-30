<?php

namespace App\Services;

use App\Services\ItemsService;

class NotificationsService {

    /**
     * @var ItemsService 
     */
    protected $itemsService;

    /**
     * NotificationsService Constructor.
     * 
     * @param ItemsService $itemsService
     */
    public function __construct(ItemsService $itemsService)
    {
        $this->itemsService = $itemsService;
    }

    /**
     * Check if there are items that need admin initial approval.
     * 
     * @return boolean
     */
    public function hasItemsNeedInitialApproval()
    {
        return $this->getItemsNeedInitialApprovalCount() > 0 ? true : false;
    }

    /**
     * Get number of items that need initial approval.
     * 
     * @return Integer
     */
    public function getItemsNeedInitialApprovalCount()
    {
        return collect($this->itemsService->getNeedsInitialApproval())->count();
    }

}
