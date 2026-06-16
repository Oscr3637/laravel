<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\PutRequest;
use App\Http\Requests\User\StoreRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function index()
    {
         // Verificar permiso para ver usuarios
        if (!Auth::user()->hasPermissionTo('editor.user.index')) {
            abort(403, 'No tienes permiso para ver usuarios');
        }
        // Filtrar usuarios según el rol del usuario autenticado
        // Si NO es Admin, solo ve usuarios 'regular' (editores)
        // Si es Admin, ve todos los usuarios
        if (Auth::user()->hasRole('Admin')) {
            $users = User::paginate(10);
           
        } else {

            $users = User::role('Editor')->paginate(10);
           
        }
        
        return view('dashboard/user/index', compact('users'));
    }

    public function create()
    {
        if (! auth()->user()->hasPermissionTo('editor.user.create')) {
            return abort(403);
        }
        $user = new User();
        return view('dashboard.user.create', compact('user'));
    }

    public function store(StoreRequest $request)
    {
    if (! auth()->user()->hasPermissionTo('editor.user.create')) {
            return abort(403);
        }    
    $data = $request->validated();
        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' =>  Hash::make($request['password']),
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