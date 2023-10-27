<?php

require __DIR__ . '../../../../../vendor/autoload.php';

use Patterns\behavioral\observer\structural\Pupil;
use Patterns\behavioral\observer\structural\Teacher;
use Patterns\behavioral\observer\structural\Watchman;

$observer = new Teacher();
$observer2 = new Pupil();

$observable = new Watchman();
$observable->attach($observer);
$observable->attach($observer2);

$observable->clickOnButton();
