<?php

/** @noinspection PhpIncludeInspection */
require 'vendor/autoload.php';

use Describe\Common\Events;
use Describe\Common\Options;
use Describe\Common\Outputs;
use Describe\Common\Parameters;
use Describe\Contracts\IEvents;
use Describe\Contracts\IOptions;
use Describe\Contracts\IParameters;

/* ---------------------------------- */
// Creating events
/* ---------------------------------- */

/** @var IEvents $events */
$events = new Events();

/* ---------------------------------- */
// Preparing environment
/* ---------------------------------- */

/** @var IParameters $parameters */
$parameters = new Parameters($argv, [
    'options' => 'describe-it',
]);

/** @var IOptions $options */
$options = new Options(getcwd(), $parameters->get('options'), [
    'formatter' => [
        'type' => 'list',
    ],
    'outputs'   => [
    ],
    'suites'    => [
        [
            'name'      => 'Default',
            'directory' => 'test',
            'suffix'    => 'test',
        ],
    ],
]);

/* ---------------------------------- */
// Creating outputs
/* ---------------------------------- */

$outputs = new Outputs();
$outputs->create($options->get('formatter'));


/* ---------------------------------- */
// Test runner & execution
/* ---------------------------------- */

