<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use App\Http\Resources\PermissionResource;
use App\Http\Resources\PermissionCollection;
use App\Http\Requests\StorePermissionRequest;

class PermissionController extends Controller
{
    public function index ():PermissionCollection
    {
        return new PermissionCollection(Permission::all());
    }

    public function show (Permission $permission):PermissionResource
    {
        return new PermissionResource($permission);
    }

    public function store (StorePermissionRequest $request):PermissionResource
    {
        $permission = Permission::create([
            'name'          => slugify($request->name),
            'display_name'  => $request->display_name,
            'guard'         => 'web',
        ]);
        return new PermissionResource($permission);
    }

    public function update (StorePermissionRequest $request, Permission $permission):PermissionResource
    {
        $permission->name         = slugify($request->name);
        $permission->display_name = $request->display_name;
        $permission->save();
        return new PermissionResource($permission);
    }

    public function delete (Permission $permission):bool
    {
        $permission->delete();
        return true;
    }
}
