<?php

namespace App\Http\Middleware;

use App\Helpers\CommonUtils;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Response;

class SuperAdminMiddleware
{
    use CommonUtils;
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
if (!Auth::check()) {
            return Redirect::route('login');
        }
        $user = Auth::user();

        if ($user->is_delete == 1) {

            return $this->logout("User not found");
        }

        if ($user->status == 0) {

            return $this->logout("Your Account has been deactivated");
        }
        if ($user->role_id != 1) {
            return $this->logout("You don't have access");
        }

        return $next($request);
    }
    public function logout($message)
    {
        $user = Auth::user();
        /** @var \Laravel\Passport\Token $token */
        $token = $user->token();
        $token->revoke();
        return $this->returnFail(401, [$message]);
    }
}
