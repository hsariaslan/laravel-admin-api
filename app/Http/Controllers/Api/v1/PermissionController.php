<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Http\Resources\PermissionResource;
use App\Http\Resources\PermissionCollection;

class PermissionController extends Controller
{
    public function index () {
        return new PermissionCollection(Permission::all());
    }

    public function read ($id) {
        return new PermissionResource(Permission::findOrFail($id));
    }

    public function create (Request $request) {
        $permission = Permission::create([
            'name'  => $request->name,
            'slug'  => slugify($request->name),
            'guard' => 'web',
        ]);
        return new PermissionResource(Permission::findOrFail($permission->id));
    }

    public function update (Request $request, $id) {
        $permission = Permission::where('id', $id)->first();
        $permission->name = $request->name;
        $permission->slug = slugify($request->name);
        $permission->save();
        return new PermissionResource(Permission::findOrFail($permission->id));
    }

    public function delete ($id) {
        Permission::where('id', $id)->delete();
        return true;
    }
}