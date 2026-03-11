<?php

namespace App\Http\Middleware;

use Closure;

class Bot
{
  const SECRET_KEY = 'HThxme1bYrkoHQzkG6TnVErwydoAwKeQG2v3cfTk0KSJeoh5hfbogH';
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
  public function handle($request, Closure $next)
  {
    if ($request->get('secretKey') !== self::SECRET_KEY) return response()->json('Invalid Request');
    return $next($request);
  }
}
