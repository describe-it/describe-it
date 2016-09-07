<?php

use Describe\Common\Node;
use Describe\Contracts\ISyntax;

function describe($message, Closure $closure)
{
    global $events;

    $events->emmit(ISyntax::DESCRIBE, new Node(
        ISyntax::DESCRIBE,
        ISyntax::OPENING,
        $message
    ));

    $closure->__invoke();

    $events->emmit(ISyntax::DESCRIBE, new Node(
        ISyntax::DESCRIBE,
        ISyntax::CLOSING
    ));
}

function context($message, Closure $closure)
{
    global $events;

    $events->emmit(ISyntax::CONTEXT, new Node(
        ISyntax::CONTEXT,
        ISyntax::OPENING,
        $message
    ));

    $closure->__invoke();

    $events->emmit(ISyntax::CONTEXT, new Node(
        ISyntax::CONTEXT,
        ISyntax::CLOSING
    ));
}

function it($message, Closure $closure)
{
    global $events;

    $events->emmit(ISyntax::IT, new Node(
        ISyntax::IT,
        ISyntax::OPENING,
        $message
    ));

    $closure->__invoke();

    $events->emmit(ISyntax::IT, new Node(
        ISyntax::IT,
        ISyntax::CLOSING
    ));
}