<?php

namespace Enimiste\LaravelWebApp\Core\Jobs;


use Carbon\Carbon;
use Enimiste\LaravelWebApp\Core\Queue\DelayQueueHelper;
use Illuminate\Bus\Queueable;

abstract class BaseBusinessJob
{
    /*
    |--------------------------------------------------------------------------
    | Queueable Jobs
    |--------------------------------------------------------------------------
    |
    | This job base class provides a central location to place any logic that
    | is shared across all of your jobs. The trait included with the class
    | provides access to the "onQueue" and "delay" queue helper methods.
    |
    */

    use Queueable;

    /** @var Carbon */
    protected $jobCreatedOn;
    /** @var  string */
    protected $dispatchedByUserEmail;

    public function __construct()
    {
        $this->jobCreatedOn = Carbon::now();
        $this->dispatchedByUserEmail = app('authenticated_user_email');
    }

    /**
     * Delay in seconds to wait from now to the next [$from, $to] hours interval
     * Ex :
     *   - To process a job between 6 and 7 : $from=6, $to=7
     *   - To process a job between 23 and 00 of the same day : $from=23, $to=0
     *
     * @param int $from a value between 0 to 23 (Hours)
     * @param int $to a value between 0 to 23 (Hours)
     */
    public function shouldBeProcessedBetweenH($from, $to)
    {
        $this->delay(DelayQueueHelper::shouldBeProcessedBetweenH($from, $to));
    }

    /**
     * @return Carbon
     */
    public function getJobCreatedOn()
    {
        return $this->jobCreatedOn->copy();
    }

    /**
     * @return string
     */
    public function getDispatchedByUserEmail()
    {
        return $this->dispatchedByUserEmail;
    }
}