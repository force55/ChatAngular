<?php

    namespace App\Http\Middleware;

    use Illuminate\Auth\Middleware\Authenticate as Middleware;
    use Closure;
    use Illuminate\Http\Request as Request;
    use JWTAuth;

    class Authenticate extends Middleware
    {
        /**
         * Get the path the user should be redirected to when they are not authenticated.
         *
         * @param \Illuminate\Http\Request $request
         * @return string|null
         */
        protected function redirectTo($request)
        {
           //
           //
        }

        /**
         * Handle an incoming request.
         *
         * @param  \Illuminate\Http\Request  $request
         * @param  \Closure  $next
         * @return mixed
         */
        public function handle($request, Closure $next, ...$guards) {
            try {
                $jwt = JWTAuth::parseToken()->authenticate();
            } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
                $jwt = false;
            }

            if (auth()->check() || $jwt) {
                return $next($request);
            } else {
                return response('Unauthorized.', 401);
            }
        }
    }
