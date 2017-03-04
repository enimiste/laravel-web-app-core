<?php
/**
 * Created by PhpStorm.
 * User: elbachirnouni
 * Date: 04/03/2017
 * Time: 16:19
 */

namespace Enimiste\LaravelWebApp\Core\Http\Middlewares;


use Closure;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Http\JsonResponse;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\JWTAuth;

class JWTAuthenticateApi
{
    /**
     * @var JWTAuth
     */
    private $auth;

    /**
     * @var \Illuminate\Contracts\Events\Dispatcher
     */
    protected $events;

    /**
     * InteractionByAdhesionAccount constructor.
     * @param JWTAuth $auth
     * @param Dispatcher $events
     */
    public function __construct(JWTAuth $auth, Dispatcher $events)
    {
        $this->auth = $auth;
        $this->events = $events;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (env('ENABLE_AUTH', true) && app()->isLocal()) {
            if (!$token = $this->auth->setRequest($request)->getToken())
                return $this->respond('notrasso.jwt.token_not_provided', 'Token not provided', 400);


            try {
                /** @var User $user */
                $user = $this->auth->authenticate($token);
                //Refresh token
                $this->auth->refresh();
            } catch (TokenExpiredException $e) {

                return $this->respond('notrasso.jwt.token_expired', 'Token expired', 403);
            } catch (JWTException $e) {

                return $this->respond('notrasso.jwt.token_invalid', 'Token invalid', 403);
            }

            if (!$user) {
                return $this->respond('tymon.jwt.user_not_found', 'User Not Found', 404);
            }

            $this->events->fire('tymon.jwt.valid', $user);
        }

        return $next($request);
    }

    /**
     * Fire event and return the response.
     *
     * @param  string $event
     * @param  string $error
     * @param  int $status
     * @param  array $payload
     * @return mixed
     */
    protected function respond($event, $error, $status, $payload = [])
    {
        $response = $this->events->fire($event, $payload, true);

        return $response ?: new JsonResponse([
            'auth_errors' => [$error]
        ], $status);
    }
}