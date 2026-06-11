<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\PutRequest;
use App\Http\Requests\User\StoreRequest;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function index()
    {
        
         $users = User::paginate(10);

        return view('dashboard/user/index', compact('users'));
    }

    public function create()
    {
        $user = new User();
        return view('dashboard.user.create', compact('user'));
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'rol' => 'admin',
        ]);
        return to_route('user.index')->with('status', 'User created');
    }

    public function show(User $user)
    {
        return view('dashboard/user/show', ['user' => $user]);
    }

    public function edit(User $user)
    {
        return view('dashboard.user.edit', compact('user'));
    }

    public function update(PutRequest $request, User $user)
    {
        $user->update($request->validated());
        return to_route('user.index')->with('status', 'User updated');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return to_route('user.index')->with('status', 'User deleted');
    }
}