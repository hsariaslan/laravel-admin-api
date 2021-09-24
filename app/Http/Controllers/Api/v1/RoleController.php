<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Resources\RoleResource;
use App\Http\Resources\RoleCollection;

class RoleController extends Controller
{
    public function index () {
        return new RoleCollection(Role::all());
    }

    public function read ($id) {
        return new RoleResource(Role::findOrFail($id));
    }

    public function create (Request $request) {
        $role = Role::create([
            'name'  => $request->name,
            'slug'  => slugify($request->name),
            'color' => $request->color,
            'guard' => 'web',
        ]);
        return new RoleResource(Role::findOrFail($role->id));
    }

    public function update (Request $request, $id) {
        $role = Role::where('id', $id)->first();
        $role->name  = $request->name;
        $role->slug  = slugify($request->name);
        $role->color = $request->color;
        $role->save();
        return new RoleResource(Role::findOrFail($role->id));
    }

    public function delete ($id) {
        Role::where('id', $id)->delete();
        return true;
    }
}
