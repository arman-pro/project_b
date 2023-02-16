<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\PermissionTrait;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    use PermissionTrait;

    public function __construct()
    {
        // user permission check
        $this->middleware('permission:role-index,admin')->only(['index', 'show']);
        $this->middleware('permission:role-create,admin')->only(['create', 'store']);
        $this->middleware('permission:role-update,admin')->only(['edit', 'update']);
        $this->middleware('permission:role-destroy,admin')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::whereGuardName('admin')->get();
        return view('admin.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.role.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->create)
        {
            $request->validate([
                'name' => 'required|string|min:1',
            ]);
            Role::create([
                'name' => $request->name,
                'guard_name' => 'admin',
            ]);
            return redirect()->route('admin.roles.index')->with('message', 'Role create successfull!');
        }
    }

    /**
     * set role permission
     */
    public function permission(Role $role) 
    {
        $permission_list = $this->permission_list();
        $permissions = $role->permissions->pluck('name')->toArray();
        return view('admin.role.permission', compact('permission_list', 'permissions', 'role'));
    }

    /**
     * Store role permission
     */
    public function store_permission(Request $request, Role $role)
    {
        $request->validate([
            'permission' => ['required', 'array', 'min:1'],
        ]);

        $permissions = $role->permissions->pluck('name')->toArray();
        foreach($permissions as $per) {
            $perm = Permission::whereGuardName('admin')->whereName($per)->first();
            if($perm) {
                $role->revokePermissionTo($perm);
            }            
        }

        foreach($request->permission as $permission) {
            foreach($permission as $sub_per) {
                $permission = Permission::firstOrCreate([
                    'name' => $sub_per,
                    'guard_name' => 'admin',
                ]);
                $role->givePermissionTo($permission);
            }
        }
        return redirect()->route('admin.permission', ['role' => $role])->with('message', 'Permission save successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $request->validate(['name' => 'required|string|min:1']);
        $role->update(['name' => $request->name]);
        return redirect()->route('admin.roles.index')->with('message', "Role update successfull!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
