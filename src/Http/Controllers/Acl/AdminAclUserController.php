<?php

namespace Pigs\AdminAclSetting\Http\Controllers\Acl;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Pigs\AdminAclSetting\Http\Requests\AdmAclAccountRequest;
use Pigs\AdminAclSetting\Models\Account;
use Pigs\AdminAclSetting\Models\Role;

class AdminAclUserController extends Controller
{
    public function index(Request $request)
    {
        $users = Account::with("roles")->whereRaw(1);
        if ($n = $request->n) {
            $users->where('name', 'like', '%'.$n.'%');
        }

        $users = $users->orderByDesc('id')
            ->paginate(20);

        $viewData = [
            'users' => $users,
            'query' => $request->query()
        ];

        return view('adm_acl_setting::pages.acl.account.index', $viewData);
    }

    public function create()
    {
        $roles = Role::all();
        $roleActive = $userHasType = [];

        return view('adm_acl_setting::pages.acl.account.create', compact('roles', 'roleActive', 'userHasType'));
    }

    public function store(AdmAclAccountRequest $request)
    {
        try {
            $data = $request->except('_token', 'avatar', 'user_type', 'roles');
            $data['created_at'] = Carbon::now();
            $data['email_verified_at'] = Carbon::now();
            $data['password'] = bcrypt('123456789');
            $data['status'] = $request->status ?? 1;


            $user = User::create($data);
            if ($user) {
                if ($request->roles) {
                    foreach ($request->roles as $roleID) {
                        DB::table('accounts_roles')->insert([
                            "account_id" => $user->id,
                            "role_id"    => $roleID
                        ]);
                    }
                    $permissions = DB::table('roles_permissions')->whereIn("role_id",
                        $request->roles)->pluck("permission_id")->toArray();
                    if (!empty($permissions)) {
                        foreach ($permissions as $id) {
                            DB::table("accounts_permission")->insert([
                                "account_id"    => $user->id,
                                "permission_id" => $id
                            ]);
                        }
                    }
                }

//                Mail::to($user->email)->queue(new SendEmailRegisterUser($user));
            }
        } catch (\Exception $exception) {
            Log::error("ERROR => UserController@store => ".$exception->getMessage());
            return redirect()->back();
        }

        return redirect()->route('get.adm_acl_setting.user.index');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        $roleActive = DB::table('accounts_roles')->where('account_id', $id)->pluck('role_id')->toArray();

        $viewData = [
            "user"       => $user,
            "roles"      => $roles,
            "roleActive" => $roleActive
        ];
        return view('adm_acl_setting::pages.acl.account.update', $viewData);
    }

    public function update(Request $request, $id)
    {
        try {
            $data = $request->except('_token', 'avatar', 'user_type', 'roles');
            $data['updated_at'] = Carbon::now();


            $update = User::find($id)->update($data);
            if ($update) {
                $user = User::find($id);

                if ($request->roles) {
                    DB::table('accounts_roles')->where('account_id', $id)->delete();

                    foreach ($request->roles as $roleID) {
                        DB::table('accounts_roles')->insert([
                            "account_id" => $user->id,
                            "role_id"    => $roleID
                        ]);
                        DB::table('accounts_permission')->where('account_id', $id)->delete();
                    }

                    $permissions = DB::table('roles_permissions')->whereIn("role_id",
                        $request->roles)->pluck("permission_id")->toArray();
                    dump($permissions);
                    if (!empty($permissions)) {
                        foreach ($permissions as $id) {
                            DB::table("accounts_permission")->insert([
                                "account_id"    => $user->id,
                                "permission_id" => $id
                            ]);
                        }
                    }
                }

            }
        } catch (\Exception $exception) {
            Log::error("ERROR => UserController@store => ".$exception->getMessage());

            return redirect()->route('get.adm_acl_setting.user.update', $id);
        }
        return redirect()->route('get.adm_acl_setting.user.index');
    }

    public function delete(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            if ($user) {
                DB::table('accounts_roles')->where('account_id', $id)->delete();
                $user->delete();
            }

        } catch (\Exception $exception) {
            Log::error("ERROR => UserController@delete => ".$exception->getMessage());
        }
        return redirect()->route('get.adm_acl_setting.user.index');
    }
}
