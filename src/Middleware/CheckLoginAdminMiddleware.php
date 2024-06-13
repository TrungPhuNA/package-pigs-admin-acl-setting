<?php
/**
 * Created By PhpStorm
 * Code By : trungphuna
 * Date: 6/13/24
 */

namespace Pigs\AdminAclSetting\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckLoginAdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('get.adm_acl_setting.login');
        }
        return $next($request);
    }
}