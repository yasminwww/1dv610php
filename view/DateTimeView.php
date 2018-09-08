<?php

class DateTimeView {


	public function show() {

		$timeString = date_default_timezone_set('Europe/Stockholm');

		$info = getdate();
		$date = $info['mday'];
		$month = $info['mon'];
		$year = $info['year'];
		$hour = $info['hours'];
		$min = $info['minutes'];

		return '<p>' . $current_date = "$date/$month/$year | $hour:$min" . '</p>';

	}
}