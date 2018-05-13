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

    /**
     * Get all items expiring within 3 months.
     *  
     * @return Collection
     */
    public function getExpiringSoon();

    /**
     * Get all items which have expired.
     *  
     * @return Collection
     */
    public function getExpired();
}
