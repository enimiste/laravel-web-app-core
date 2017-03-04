<?php
/**
 * Created by PhpStorm.
 * User: elbachirnouni
 * Date: 04/03/2017
 * Time: 14:43
 */

namespace Enimiste\LaravelWebApp\Core\Listeners;


use Tymon\JWTAuth\JWTAuth;

class InvalidateJwtTokensOnPasswordUpdatedListener
{
    /**
     * InvalidateJwtTokensOnPasswordUpdatedListener constructor.
     */
    public function __construct()
    {
    }

    /**
     * @param JWTAuth $JWTAuth
     */
    public function handle(JWTAuth $JWTAuth)
    {
        try {
            $JWTAuth->invalidate();
        } catch (\Exception $e) {
            \Log::error(__CLASS__ . ' : ' . $e->getMessage());
        }
    }
}