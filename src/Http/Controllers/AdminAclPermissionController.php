<?php

namespace Pigs\AdminAclSetting\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Pigs\AdminAclSetting\Models\Permission;

class AdminAclPermissionController extends Controller
{
//    use AuthorizesRequests, ValidatesRequests;
    public function index()
    {
        $permissions = Permission::orderByDesc('id')
            ->paginate(20);

        $viewData = [
            'permissions' => $permissions
        ];

        return view('adm_acl_setting::pages.permission.index', $viewData);
    }

    public function create(Request $request)
    {
        return view('adm_acl_setting::pages.permission.create');
    }

    public function store(Request $request)
    {
        try {
            $data = $request->except('_token');
            $data['created_at'] = Carbon::now();
            $data['slug'] = Str::slug($request->name);
            Permission::create($data);
        }catch (\Exception $exception) {
            Log::error("ERROR => AdminAclPermissionController@store => ". $exception->getMessage());
            return redirect()->route('get.adm_acl_setting.permission.create');
        }
        return redirect()->route('get.adm_acl_setting.permission.index');
    }

    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        return view('adm_acl_setting::pages.permission.update', compact('permission'));
    }

    public function update(Request $request, $id) {
        try {
            $data = $request->except('_token');
            $data['updated_at'] = Carbon::now();
            $data['slug'] = Str::slug($request->name);
            Permission::find($id)->update($data);
        }catch (\Exception $exception) {
            Log::error("ERROR => AdminAclPermissionController@store => ". $exception->getMessage());
            return redirect()->route('get.adm_acl_setting.permission.update', $id);
        }
        return redirect()->route('get.adm_acl_setting.permission.index');
    }

    public function delete(Request $request, $id) {
        try {
            $permission = Permission::findOrFail($id);
            if ($permission) {
                $permission->delete();
            }

        }catch (\Exception $exception) {
            Log::error("ERROR => AdminAclPermissionController@delete => ". $exception->getMessage());
        }

        return redirect()->route('get.adm_acl_setting.permission.index');
    }
}
