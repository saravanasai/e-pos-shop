<?php

namespace App\Http\Controllers\Api\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\UserRequest;
use App\Http\Requests\v1\UserUpdateRequest;
use App\Http\Resources\v1\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('view', auth()->user());

        $users = Cache::rememberForever("user_cahce_" . auth()->id(), function () {

            return User::query()
                ->whereNot('id', auth()->id())
                ->get();
        });

        return UserResource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $this->authorize('create', auth()->user());

        $user = User::create([
            'username' => $request->get('username'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password'))
        ]);

        $role = Role::query()
            ->where('id', $request->get('role'))
            ->pluck('name')[0];

        $user->assignRole($role);

        return UserResource::make($user);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $this->authorize('view', auth()->user());

        $user = User::findOrFail($id);

        return UserResource::make($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, string $id)
    {

        $this->authorize('update', auth()->user());

        $user = User::findOrFail($id);

        $user->update([
            'username' => $request->get('username'),
            'email' => $request->get('email'),
        ]);

        $roles = Role::query()
            ->where('id', $request->get('role'))
            ->pluck('name');


        $user->syncRoles($roles);

        return UserResource::make($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->authorize('delete', auth()->user());

        $user = User::findOrFail($id);
        $user->delete();

        return Response::noContent();
    }
}
