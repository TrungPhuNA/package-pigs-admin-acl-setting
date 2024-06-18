<?php
/**
 * Created By PhpStorm
 * Code By : trungphuna
 * Date: 6/13/24
 */

namespace Pigs\AdminAclSetting\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Pigs\AdminAclSetting\Models\Permission;

class CheckLoginAdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('get.adm_acl_setting.login');
        }
        $accountID = Auth::id();
        $routeName = \Request::route()->getName();

        $permission = Permission::where("name", $routeName)->first();

        if (!$permission) {
            return $next($request);
        }
        // check full quyền
        $permissionSupper = Permission::where("name", "full")->first();
        if ($permissionSupper) {
            $checkPermission = DB::table("accounts_permission")->where([
                "account_id"    => $accountID,
                "permission_id" => $permissionSupper->id
            ])->first();
            if ($checkPermission) {
                return $next($request);
            }
        }
        $checkPermission = DB::table("accounts_permission")->where([
            "account_id"    => $accountID,
            "permission_id" => $permission->id
        ])->first();

        if (!$checkPermission) {
            return abort(403);
        }

        return $next($request);
    }
}