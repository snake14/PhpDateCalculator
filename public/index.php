<?php
    require __DIR__ . '/../vendor/autoload.php';
    $f3 = \Base::instance();
    $f3->set('AUTOLOAD', __DIR__ . '/../src/');
    $f3->route('GET /', 'Controllers\DateCalculator->getMainPage');
	$f3->route('POST /calculate-from-date', 'Controllers\DateCalculator->calculateFromDate');
	$f3->route('POST /calculate-from-time', 'Controllers\DateCalculator->calculateFromTime');
	$f3->route('POST /calculate-diff-date', 'Controllers\DateCalculator->calculateDiffDate');
	$f3->route('POST /calculate-diff-time', 'Controllers\DateCalculator->calculateDiffTime');
    $f3->run();
?>