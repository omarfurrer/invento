<?php

use Illuminate\Database\Seeder;
use App\Repositories\Interfaces\ItemCategoriesRepositoryInterface;
use Illuminate\Support\Facades\DB;

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
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        $this->itemCategoriesRepository->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

}
