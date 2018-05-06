<?php

namespace App\Repositories\Interfaces;

interface ItemsRepositoryInterface {

    /**
     * Get items that need to be approved by an admin.
     * 
     * @return Collection
     */
    public function getNeedsInitialApproval();

    /**
     * Set initial approval for an item.
     * 
     * @param Integer $id
     * @return Item
     */
    public function approveInitially($id);

    /**
     * Get items that have been approved by an admin.
     * 
     * @return Collection
     */
    public function getInitiallyApproved();
    
    /**
     * Get items where minimum quantity threshold has exceeded.
     * 
     * @return Collection
     */
    public function getLowQuantity();
}
