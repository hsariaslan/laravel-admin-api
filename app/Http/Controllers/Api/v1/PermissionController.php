<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use App\Http\Resources\PermissionResource;
use App\Http\Resources\PermissionCollection;
use App\Http\Requests\StorePermissionRequest;

class PermissionController extends Controller
{
    /**
     * Get all permissions.
     *
     * @return App\Http\Resources\PermissionCollection
     */
    public function index ():PermissionCollection
    {
        return new PermissionCollection(Permission::all());
    }

    /**
     * Show the permission given by id.
     *
     * @param  App\Models\Permission  $permission
     * @return App\Http\Resources\PermissionResource
     */
    public function show (Permission $permission):PermissionResource
    {
        return new PermissionResource($permission);
    }

    /**
     * Store a new permission.
     *
     * @param  App\Http\Requests\StorePermissionRequest  $request
     * @return App\Http\Resources\PermissionResource
     */
    public function store (StorePermissionRequest $request):PermissionResource
    {
        $permission = Permission::create([
            'name'          => slugify($request->name),
            'display_name'  => $request->display_name,
            'guard'         => 'web',
        ]);
        return new PermissionResource($permission);
    }

    /**
     * Update the permission given by id.
     *
     * @param  App\Http\Requests\StorePermissionRequest  $request
     * @param  App\Models\Permission  $permission
     * @return App\Http\Resources\PermissionResource
     */
    public function update (StorePermissionRequest $request, Permission $permission):PermissionResource
    {
        $permission->name         = slugify($request->name);
        $permission->display_name = $request->display_name;
        $permission->save();
        return new PermissionResource($permission);
    }

    /**
     * Delete the permission given by id.
     *
     * @param  App\Models\Permission  $permission
     * @return bool
     */
    public function delete (Permission $permission):bool
    {
        $permission->delete();
        return true;
    }
}
