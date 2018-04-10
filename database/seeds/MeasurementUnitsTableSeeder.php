<?php

use Illuminate\Database\Seeder;
use App\Repositories\Interfaces\MeasurementUnitsRepositoryInterface;

class MeasurementUnitsTableSeeder extends Seeder {

    /**
     * @var MeasurementUnitsRepositoryInterface 
     */
    protected $measurementUnitsRepository;

    /**
     * MeasurementUnitsTableSeeder Constructor.
     * 
     * @param MeasurementUnitsRepositoryInterface $measurementUnitsRepository
     */
    public function __construct(MeasurementUnitsRepositoryInterface $measurementUnitsRepository)
    {
        $this->measurementUnitsRepository = $measurementUnitsRepository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->measurementUnitsRepository->truncate();
        $this->measurementUnitsRepository->create(['short_name' => 'bg', 'name' => 'bag']);
        $this->measurementUnitsRepository->create(['short_name' => 'bt', 'name' => 'bottle']);
        $this->measurementUnitsRepository->create(['short_name' => 'bx', 'name' => 'box']);
        $this->measurementUnitsRepository->create(['short_name' => 'gm', 'name' => 'gram']);
        $this->measurementUnitsRepository->create(['short_name' => 'kg', 'name' => 'kilogram']);
        $this->measurementUnitsRepository->create(['short_name' => 'li', 'name' => 'liter']);
        $this->measurementUnitsRepository->create(['short_name' => 'pc', 'name' => 'piece']);
        $this->measurementUnitsRepository->create(['short_name' => 'pk', 'name' => 'pack']);
    }

}
