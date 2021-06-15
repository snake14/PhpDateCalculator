<?php
	require __DIR__ . '/../vendor/autoload.php';
	$f3 = \Base::instance();
	$f3->set('AUTOLOAD', __DIR__ . '/../src/');
	$f3->set('UI', __DIR__ . '/../views/');
	$f3->set('timeZones', \DateTimeZone::listIdentifiers(\DateTimeZone::ALL));
	$f3->set('defaultTimeZone', date_default_timezone_get());
	$f3->route('GET /', 'Controllers\DateCalculator->getMainPage');
	$f3->route('POST /calculate-from-date', 'Controllers\DateCalculator->calculateFromDate');
	$f3->route('POST /calculate-from-time', 'Controllers\DateCalculator->calculateFromTime');
	$f3->route('POST /calculate-diff-date', 'Controllers\DateCalculator->calculateDiffDate');
	$f3->route('POST /calculate-diff-time', 'Controllers\DateCalculator->calculateDiffTime');
	$f3->route('POST /convert-time-zone', 'Controllers\DateCalculator->convertTimeZone');
	$f3->set('TEMP', __DIR__ . '/tmp/');
	$f3->run();
?>
