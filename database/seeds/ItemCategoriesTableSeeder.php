<?php

use Illuminate\Database\Seeder;
use App\Repositories\Interfaces\ItemCategoriesRepositoryInterface;

class ItemCategoriesTableSeeder extends Seeder {

    /**
     * @var ItemCategoriesRepositoryInterface 
     */
    protected $itemCategoriesRepository;

    /**
     * ItemCategoriesTableSeeder Constructor.
     * 
     * @param ItemCategoriesRepositoryInterface $itemCategoriesRepository
     */
    public function __construct(ItemCategoriesRepositoryInterface $itemCategoriesRepository)
    {
        $this->itemCategoriesRepository = $itemCategoriesRepository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->itemCategoriesRepository->truncate();
    }

}
