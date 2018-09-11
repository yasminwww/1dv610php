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

		return '<p>' . $current_date = "$year/$month/$date | $hour:$min" . '</p>';

	}
}
