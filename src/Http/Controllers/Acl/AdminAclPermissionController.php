<?php

namespace Pigs\AdminAclSetting\Http\Controllers\Acl;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Pigs\AdminAclSetting\Http\Requests\AdmAclPermissionRequest;
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

    public function store(AdmAclPermissionRequest $request)
    {
        try {
            $data = $request->except('_token');
            $data['created_at'] = Carbon::now();

            $permission = $request->name;
            $permission = str_replace("//", "",$permission);
            $arrPath = explode('/', $permission);
            $result = array_slice($arrPath, 1);
            $permission =  implode("-",$result);
            $permission = preg_replace('/\d+/', '', $permission);
            $permission = trim($permission, '-');

            $data["name"]= $permission;
            $data["slug"]= Str::slug($permission);
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

    public function update(AdmAclPermissionRequest $request, $id) {
        try {
            $data = $request->except('_token');
            $data['updated_at'] = Carbon::now();

            $permission = $request->name;
            $permission = str_replace("//", "",$permission);
            $arrPath = explode('/', $permission);
            $result = array_slice($arrPath, 1);
            $permission =  implode("-",$result);
            $permission = preg_replace('/\d+/', '', $permission);
            $permission = trim($permission, '-');
            $data["name"]= $permission;
            $data["slug"]= Str::slug($permission);

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
