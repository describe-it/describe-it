<?php

/** @noinspection PhpIncludeInspection */
require 'vendor/autoload.php';

use Describe\Common\Events;
use Describe\Common\Options;
use Describe\Common\Parameters;
use Describe\Contracts\IEvents;
use Describe\Contracts\IFormatter;
use Describe\Contracts\IOptions;
use Describe\Contracts\IParameters;
use Describe\Contracts\IRunner;
use Describe\Formatter\ListFormatter;
use Describe\Runner\TestRunner;

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
    'suffix'    => 'test',
    'formatter' => 'list',
    'suites'    => [
        [
            'name'      => 'Default',
            'directory' => 'test',
        ],
    ],
]);

/* ---------------------------------- */
// Creating formatter
/* ---------------------------------- */

/** @var IFormatter $formatter */
$formatter = new ListFormatter($events, $parameters, $options);
$formatter->bind();

/* ---------------------------------- */
// Test runner & execution
/* ---------------------------------- */

/** @var IRunner $runner */
$runner = new TestRunner($events, $parameters, $options);
$runner->bind();
$runner->run();