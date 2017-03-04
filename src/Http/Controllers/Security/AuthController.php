<?php

namespace Enimiste\LaravelWebApp\Core\Http\Controllers\Api\Security;


use Enimiste\LaravelWebApp\Core\Annotations\ApiDoc;
use Enimiste\LaravelWebApp\Core\Exception\BusinessException;
use Enimiste\LaravelWebApp\Core\Http\Controllers\BaseController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\JWTAuth;

class AuthController extends BaseController
{

    /**
     * @ApiDoc(
     *     description="Authenticate a given use",
     *     url="/api/auth/login",
     *     input={
     *        "email":"",
     *        "password":""
     *     },
     *     inputMetaData={
     *        "password":"Clear password"
     *     },
     *     output={
     *        "data":{"token":""},
     *        "errors":[]
     *     },
     *     statusCode={"400","500","200"}
     * )
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function authenticate(Request $request, JWTAuth $jWTAuth)
    {
        try {// grab credentials from the request
            $credentials = $request->only('email', 'password');

            // attempt to verify the credentials and create a token for the user
            if (!$token = $jWTAuth->attempt($credentials))
                throw new BusinessException('invalid_credentials');


            return new JsonResponse(
                [
                    'data' => [
                        'token' => $token
                    ]
                ], 200
            );
        } catch (BusinessException $bex) {

            return new JsonResponse(
                [
                    'errors' => $bex->getErrors(),
                ], 400
            );
        } catch (JWTException $e) {
            Log::error($e->getTraceAsString());

            return new JsonResponse(
                [
                    'errors' => ['Could Not Create Token'],
                ], 500
            );
        } catch (\Exception $ex) {
            Log::error($ex->getTraceAsString());

            return new JsonResponse(
                [
                    'errors' => [$ex->getMessage()],
                ], 500
            );
        }
    }
}