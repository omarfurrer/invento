<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\UsersRepositoryInterface;

class UsersController extends Controller {

    /**
     * @var UsersRepositoryInterface 
     */
    protected $usersRepository;

    /**
     * UsersController Constructor.
     * 
     * @param UsersRepositoryInterface $usersRepository
     */
    public function __construct(UsersRepositoryInterface $usersRepository)
    {
        $this->usersRepository = $usersRepository;
    }

    /**
     * Retrieve a list of all users on the system.
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $users = $this->usersRepository->all();
        return view('admin.users.index', compact("users"));
    }

}
