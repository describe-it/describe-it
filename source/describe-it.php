<?php

/** @noinspection PhpIncludeInspection */
require 'vendor/autoload.php';

use Describe\Common\Events;
use Describe\Common\Options;
use Describe\Common\Outputs;
use Describe\Common\Parameters;
use Describe\Contracts\IEvents;
use Describe\Contracts\IFiles;
use Describe\Contracts\IOptions;
use Describe\Contracts\IParameters;
use Describe\Contracts\IRunner;
use Describe\Contracts\IStackTracer;
use Describe\Runner\TestFiles;
use Describe\Runner\TestRunner;
use Describe\Runner\TestSuite;
use Describe\Utils\StackTracer;

/* ---------------------------------- */
// Creating helpers
/* ---------------------------------- */

/** @var IEvents $events */
$events = new Events();

/** @var IStackTracer $tracer */
$tracer = new StackTracer();

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

foreach ($options->get('outputs') as $output)
{
    $outputs->create($output);
}

/* ---------------------------------- */
// Create test runner
/* ---------------------------------- */

/** @var IFiles $files */
$files = new TestFiles(getcwd());

/** @var IRunner $runner */
$runner = new TestRunner($outputs);

/* ---------------------------------- */
// Schedule test suites
/* ---------------------------------- */

foreach ($options->get('suites') as $suite)
{
    if (
        !$parameters->has('suite')
        || strtolower($parameters->get('suite')) == strtolower($suite['name'])
    )
    {
        $runner->schedule(new TestSuite(
            $events,
            $files,
            $outputs,
            $tracer,
            $suite
        ));
    }
}

/* ---------------------------------- */
// Execute tests
/* ---------------------------------- */

$runner->run();
