<?php

namespace Pigs\AdminAclSetting\Http\Controllers\Acl;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Pigs\AdminAclSetting\Models\Permission;
use Pigs\AdminAclSetting\Models\Role;

class AdminAclRoleController extends Controller
{
    public function index()
    {
        $roles = Role::orderByDesc('id')
            ->paginate(20);

        $viewData = [
            'roles' => $roles
        ];

        return view('adm_acl_setting::pages.acl.role.index', $viewData);
    }

    public function create()
    {
        $permissions = Permission::all();
        $permissionActive = [];
        return view('adm_acl_setting::pages.acl.role.create', compact('permissions', 'permissionActive'));
    }

    public function store(Request $request)
    {
        try {
            $data = $request->except('_token', 'permissions');
            $data['slug'] = Str::slug($request->name);
            $data['created_at'] = Carbon::now();

            $role = Role::create($data);
            if ($role && !empty($request->permissions)) {
                foreach ($request->permissions as $item) {
                    DB::table('roles_permissions')->insert([
                        'role_id'       => $role->id,
                        'permission_id' => $item
                    ]);
                }
            }

        } catch (\Exception $exception) {
            Log::error("ERROR => RoleController@store => ".$exception->getMessage());
            return redirect()->route('get.adm_acl_setting.role.create');
        }

        return redirect()->route('get.adm_acl_setting.role.index');
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        $permissionActive = DB::table('roles_permissions')->where('role_id', $id)->pluck('permission_id')->toArray();
        return view('adm_acl_setting::pages.acl.role.update', compact('role', 'permissions', 'permissionActive'));
    }

    public function update(Request $request, $id)
    {
        try {
            $data = $request->except('_token', 'permissions');
            $data['updated_at'] = Carbon::now();

            $update = Role::find($id)->update($data);
            if ($update && !empty($request->permissions)) {

                DB::table('roles_permissions')->where('role_id', $id)->delete();
                foreach ($request->permissions as $item) {
                    DB::table('roles_permissions')->insert([
                        'role_id'       => $id,
                        'permission_id' => $item
                    ]);
                }
            }

        } catch (\Exception $exception) {
            Log::error("ERROR => RoleController@store => ".$exception->getMessage());
            return redirect()->route('get.adm_acl_setting.role.update', $id);
        }

        return redirect()->route('get.adm_acl_setting.role.index');
    }

    public function delete(Request $request, $id)
    {
        try {
            $role = Role::findOrFail($id);
            if ($role) {
                DB::table('roles_permissions')->where('role_id', $id)->delete();
                DB::table('accounts_roles')->where('role_id', $id)->delete();
                $role->delete();
            }

        } catch (\Exception $exception) {
            Log::error("ERROR => RoleController@delete => ".$exception->getMessage());
        }

        return redirect()->route('get.adm_acl_setting.role.index');
    }
}
