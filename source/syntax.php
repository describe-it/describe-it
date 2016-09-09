<?php

use Describe\Contracts\IEvents;
use Describe\Contracts\ISyntax;
use Describe\Expectations\Expectation;

/**
 * Describe some component.
 *
 * @param string  $message
 * @param Closure $closure
 *
 * @return void
 */
function describe($message, Closure $closure)
{
    global $events;

    $events->emmit(IEvents::SYNTAX, [ISyntax::DESCRIBE_START, $message]);
    $closure->__invoke();
    $events->emmit(IEvents::SYNTAX, [ISyntax::DESCRIBE_END, $message]);
}

/**
 * Create new context.
 *
 * @param string  $message
 * @param Closure $closure
 *
 * @return void
 */
function context($message, Closure $closure)
{
    global $events;

    $events->emmit(IEvents::SYNTAX, [ISyntax::CONTEXT_START, $message]);
    $closure->__invoke();
    $events->emmit(IEvents::SYNTAX, [ISyntax::CONTEXT_END, $message]);
}

/**
 * Create test case.
 *
 * @param string  $message
 * @param Closure $closure
 *
 * @return void
 */
function it($message, Closure $closure)
{
    global $events;

    $events->emmit(IEvents::SYNTAX, [ISyntax::IT_START, $message]);
    $closure->__invoke();
    $events->emmit(IEvents::SYNTAX, [ISyntax::IT_END, $message]);
}

/**
 * Make an expectation.
 *
 * @param mixed $subject
 *
 * @return Expectation
 */
function expect($subject)
{
    global $events;

    return new Expectation($subject, $events);
}
