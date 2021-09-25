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
            'name'          => slugify($request->name),
            'display_name'  => $request->display_name,
            'color'         => $request->color,
            'guard'         => 'web',
        ]);
        $role->givePermissionTo($request->permissions);
        return new RoleResource(Role::findOrFail($role->id));
    }

    public function update (Request $request, $id) {
        $role = Role::where('id', $id)->first();
        $role->name         = slugify($request->name);
        $role->display_name = $request->display_name;
        $role->color        = $request->color;
        $role->save();
        $role->syncPermissions($request->permissions);
        return new RoleResource(Role::findOrFail($role->id));
    }

    public function delete ($id) {
        $role = Role::where('id', $id)->first();
        $role->syncPermissions();
        $role->delete();
        return true;
    }
}
