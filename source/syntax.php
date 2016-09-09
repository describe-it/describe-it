<?php

use Describe\Common\Binding;
use Describe\Common\Node;
use Describe\Contracts\INode;
use Describe\Contracts\ISyntax;
use Expective\Expectation;

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

    $events->emmit(ISyntax::DESCRIBE, new Node(
        ISyntax::DESCRIBE,
        INode::OPENING,
        $message
    ));

    $closure->__invoke();

    $events->emmit(ISyntax::DESCRIBE, new Node(
        ISyntax::DESCRIBE,
        INode::CLOSING
    ));
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

    $events->emmit(ISyntax::CONTEXT, new Node(
        ISyntax::CONTEXT,
        INode::OPENING,
        $message
    ));

    $closure->__invoke();

    $events->emmit(ISyntax::CONTEXT, new Node(
        ISyntax::CONTEXT,
        INode::CLOSING
    ));
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

    $events->emmit(ISyntax::IT, new Node(
        ISyntax::IT,
        INode::OPENING,
        $message
    ));

    $closure->__invoke();

    $events->emmit(ISyntax::IT, new Node(
        ISyntax::IT,
        INode::CLOSING
    ));
}

/**
 * Create new expectation.
 *
 * @param mixed $subject
 *
 * @return Expectation
 */
function expect($subject)
{
    global $events;

    return new Expectation($subject, new Binding($events));
}
