<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\UsersRepositoryInterface;
use App\Repositories\Interfaces\RolesRepositoryInterface;
use App\Http\Requests\Users\StoreUserRequest;
use App\Http\Requests\Users\UpdateUserRequest;
use App\User;

class UsersController extends Controller {

    /**
     * @var UsersRepositoryInterface 
     */
    protected $usersRepository;

    /**
     * @var RolesRepositoryInterface 
     */
    protected $rolesRepository;

    /**
     * UsersController Constructor.
     * 
     * @param UsersRepositoryInterface $usersRepository
     * @param RolesRepositoryInterface $rolesRepository
     */
    public function __construct(UsersRepositoryInterface $usersRepository, RolesRepositoryInterface $rolesRepository)
    {
        $this->usersRepository = $usersRepository;
        $this->rolesRepository = $rolesRepository;
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

    /**
     * Retrieve view to create a new user.
     * 
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $roles = $this->rolesRepository->lists();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a new user.
     * 
     * @param StoreUserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreUserRequest $request)
    {
        $user = $this->usersRepository->create($request->all(), $request->role_id);

        \Session::flash('flash_message_success', 'User Created.');
        return redirect()->to('/admin/users');
    }

    /**
     * Retrieve view to edit a user.
     * 
     * @param User $user
     * @return \Illuminate\View\View
     */
    public function edit(User $user)
    {
        $roles = $this->rolesRepository->lists();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update user.
     * 
     * @param UpdateUserRequest $request
     * @param User $user
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user = $this->usersRepository->update($user->id, $request->all(), $request->role_id);

        \Session::flash('flash_message_success', 'User updated.');
        return redirect()->to('/admin/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {

        $this->usersRepository->delete($user);

        \Session::flash('flash_message_success', 'User Deleted.');

        return redirect()->to('/admin/users');
    }

}
