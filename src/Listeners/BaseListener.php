<?php
/**
 * Created by PhpStorm.
 * User: elbachirnouni
 * Date: 04/03/2017
 * Time: 14:11
 */

namespace Enimiste\LaravelWebApp\Core\Listeners;


abstract class BaseListener
{
    /**
     * Class that implements this class should define a public function :
     *
     * public function handle($event){ }
     * or
     * public function handle($event){ return $response;}
     *
     * If a response is returned from the handle function and event halting is enabled
     * when the event was fired then return this response and stop propagation.
     *
     * Handle function don't support dependency injection like Jobs handlers
     *
     * NB : - Event listeners should not trigger an Exception.
     * ==== - It should catch all its exception and log it, add their messages to the
     *        base event class errors property or ignore it.
     *
     * This method is here just to remember you of the spec of listeners
     */
    abstract public function doesNothing();
}