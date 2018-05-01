<?php

use Illuminate\Database\Seeder;
use App\Repositories\Interfaces\UsersRepositoryInterface;

class SuperAdminUsersTableSeeder extends Seeder {

    /**
     * @var UsersRepositoryInterface 
     */
    protected $usersRepository;

    /**
     * SuperAdminUsersTableSeeder Constructor.
     * 
     * @param UsersRepositoryInterface $usersRepository
     */
    public function __construct(UsersRepositoryInterface $usersRepository)
    {
        $this->usersRepository = $usersRepository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        $this->usersRepository->truncate();
        $this->usersRepository->create([
            'name' => 'Omar Furrer',
            'email' => 'omar.furrer@gmail.com',
            'password' => '12345678'
                ], 'super admin');
        $this->usersRepository->create([
            'name' => 'Ahmed EL Gallad',
            'email' => 'Ahmed.algalladd@gmail.com',
            'password' => '12345678'
                ], 'super admin');
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

}
