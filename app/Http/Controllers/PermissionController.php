<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssignPermissioToRolenRequest;
use App\Http\Requests\StorePermissionRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->authorizeResource(Permission::class, 'permission');
    }

    public function index(){
        return $this->response(Permission::all());
    }

    public function store(StorePermissionRequest $request){
        
        if(Permission::query()->where('name', $request->name)->exists()){
            return $this->error('permission already exists');
        }
        $permission = Permission::create(['name' => $request->name, "guard_name" => "web"]);

        return $this->success('permission create', $permission);
    }

    public function assign(AssignPermissioToRolenRequest $request){
        $permission = Permission::find($request->permission_id);
        $role = Role::find($request->role_id);

        if($role->hasPermissionTo($permission->name)){
            return $this->error('permission already assigned');
        }

        $role->givePermissionTo($permission->name);
        return $this->success('permission assigned to role');

    }
}
