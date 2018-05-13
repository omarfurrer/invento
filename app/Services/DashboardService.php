<?php

namespace App\Services;

use App\Repositories\Interfaces\ItemsRepositoryInterface;
use App\Repositories\Interfaces\ItemBatchesRepositoryInterface;
use App\Repositories\Interfaces\ItemWithdrawlsRepositoryInterface;
use App\Models\Item;
use App\Models\ItemBatch;
use App\Models\ItemWithdrawl;
use App\User;
use Illuminate\Support\Collection;

class DashboardService {

    /**
     * @var ItemsRepositoryInterface 
     */
    protected $itemsRepository;

    /**
     * @var ItemBatchesRepositoryInterface
     */
    protected $itemBatchesRepository;

    /**
     * @var ItemWithdrawlsRepositoryInterface 
     */
    protected $itemWithdrawlsRepository;

    /**
     * LogService Constructor.
     * 
     * @param ItemsRepositoryInterface $itemsRepository
     * @param ItemBatchesRepositoryInterface $itemBatchesRepository
     * @param ItemWithdrawlsRepositoryInterface $itemWithdrawlsRepository
     */
    public function __construct(ItemsRepositoryInterface $itemsRepository, ItemBatchesRepositoryInterface $itemBatchesRepository, ItemWithdrawlsRepositoryInterface $itemWithdrawlsRepository)
    {
        $this->itemsRepository = $itemsRepository;
        $this->itemBatchesRepository = $itemBatchesRepository;
        $this->itemWithdrawlsRepository = $itemWithdrawlsRepository;
    }

    /**
     * Retrieve items where minimum quantity threshold has exceeded.
     * 
     * @return Collection
     */
    public function getLowQuantityItems()
    {
        return $this->itemsRepository->getLowQuantity();
    }

    /**
     * Retrieve items that are going to expire soon.
     * 
     * @return Collection
     */
    public function getExpiringSoonItems()
    {
        return $this->itemsRepository->getExpiringSoon();
    }

    /**
     * Retrieve items that have expired.
     * 
     * @return Collection
     */
    public function getExpiredItems()
    {
        return $this->itemsRepository->getExpired();
    }

}
