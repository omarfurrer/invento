<?php

namespace App\Repositories\Interfaces;

interface ItemBatchesRepositoryInterface {

    /**
     * Find item batch by item ID and expiry date.
     * 
     * @param integer $itemID
     * @param string $expiryDate
     * @return ItemBatch
     */
    public function findByItemAndExpiry($itemID, $expiryDate);
}
