<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserCollection;

class UserController extends Controller
{
    public function index () {
        return new UserCollection(User::all());
    }

    public function read ($id) {
        return new UserResource(User::findOrFail($id));
    }

    public function create (Request $request) {
        $user = User::create([
            'username'  => $request->username,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'name'      => $request->name,
            'surname'   => $request->surname,
        ]);
        return new UserResource(User::findOrFail($user->id));
    }

    public function update (Request $request, $id) {
        $user = User::where('id', $id)->first();
        $user->username = $request->username;
        $user->email    = $request->email;
        $user->password = Hash::make($request->password);
        $user->name     = $request->name;
        $user->surname  = $request->surname;
        $user->save();
        return new UserResource(User::findOrFail($user->id));
    }

    public function delete ($id) {
        User::where('id', $id)->delete();
        return true;
    }
}
