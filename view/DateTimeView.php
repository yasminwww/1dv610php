<?php

class DateTimeView {


	public function time() {

		$timeString = date_default_timezone_set('Europe/Stockholm');

		$info = getDate();
		$date = $info['mday'];
		$month = $info['mon'];
		$year = $info['year'];
		$hour = $info['hours'];
		$min = $info['minutes'];

		return '<p>' . date("l") . ', the '. date("jS \of F Y"). ', The time is' . " $hour:$min" . '</p>';
		// return '<p>' . $current_date = "   $year/$month/$date | $hour:$min" . '</p>';

	}
}
