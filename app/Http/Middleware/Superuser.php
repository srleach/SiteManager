<?php
/**
 * Created by PhpStorm.
 * User: seanleach
 * Date: 07/08/2015
 * Time: 20:32
 */

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Log;

class Superuser
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($this->auth->guest() || !$this->auth->user()->superuser){
            if ($request->ajax()) {
                return response('Unauthorized.', 404);
            } else {
                if(getenv('APP_DEBUG')){
                    Log::info('Auth: Attempted to access protected area without permission.', ['URI' => '']);
                }
                return abort(404);
            }
        }
        return $next($request);
    }
}
