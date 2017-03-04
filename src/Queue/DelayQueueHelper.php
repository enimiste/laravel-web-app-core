<?php

namespace Enimiste\LaravelWebApp\Core\Queue;


use Carbon\Carbon;

class DelayQueueHelper {

	/**
	 * Calculate the delay in seconds to wait from now to the next [$from, $to] hours plage
	 * Ex :
	 *   - To process a job between 6 and 7 : $from=6, $to=7
	 *   - To process a job between 23 and 00 of the same day : $from=23, $to=0
	 *
	 * @param int $from a value between 0 to 23 (Hours)
	 * @param int $to   a value between 0 to 23 (Hours)
	 *
	 * @return int number of seconds to wait
	 */
	public static function shouldBeProcessedBetweenH( $from, $to ) {

		$now    = Carbon::now();
		$from_d = $now->copy()->hour( $from );
		$to_d   = $now->copy()->hour( $to );

		if ( $from == 23 && $to == 0 ) {
			//23:00
			$from_d = $from_d->minute( 00 );
			//23:59
			$to_d = $to_d->hour( 23 )->minute( 59 );
		}

		if ( $from_d->lte( $now ) ) {
			$from_d = $from_d->addDays( 1 );
			$to_d->addDays( 1 );
		}

		return $from_d->addMinutes( 1 )->diffInSeconds( $now );
	}
}