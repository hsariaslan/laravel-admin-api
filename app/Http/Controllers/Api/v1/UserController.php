<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserCollection;
use App\Http\Requests\StoreUserRequest;

class UserController extends Controller
{
    /**
     * Get all users.
     *
     * @return App\Http\Resources\UserCollection
     */
    public function index ():UserCollection
    {
        return new UserCollection(User::all());
    }

    /**
     * Show the user given by id.
     *
     * @param  App\Models\User  $user
     * @return App\Http\Resources\UserResource
     */
    public function show (User $user):UserResource
    {
        return new UserResource($user);
    }

    /**
     * Store a new user.
     *
     * @param  App\Http\Requests\StoreUserRequest  $request
     * @return App\Http\Resources\UserResource
     */
    public function store (StoreUserRequest $request):UserResource
    {
        $user = User::create([
            'username'  => $request->username,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'name'      => $request->name,
            'surname'   => $request->surname,
        ]);
        $user->assignRole($request->roles);
        $user->givePermissionTo($request->permissions);
        return new UserResource($user);
    }

    /**
     * Update the user given by id.
     *
     * @param  App\Http\Requests\StoreUserRequest  $request
     * @param  App\Models\User  $user
     * @return App\Http\Resources\UserResource
     */
    public function update (StoreUserRequest $request, User $user):UserResource
    {
        $user->username = $request->username;
        $user->email    = $request->email;
        $user->password = Hash::make($request->password);
        $user->name     = $request->name;
        $user->surname  = $request->surname;
        $user->syncRoles($request->roles);
        $user->syncPermissions($request->permissions);
        $user->save();
        return new UserResource($user);
    }

    /**
     * Delete the user given by id.
     *
     * @param  App\Models\User  $user
     * @return bool
     */
    public function delete (User $user):bool
    {
        $user->syncRoles();
        $user->syncPermissions();
        $user->delete();
        return true;
    }
}
