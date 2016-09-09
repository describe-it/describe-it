<?php namespace Describe\Common;

use Describe\Contracts\IEvents;
use Expective\Contracts\IBinding;

/**
 * Class Binding
 * @package Describe\Common
 */
class Binding implements IBinding
{
    /** @var IEvents */
    protected $events;

    /**
     * Binding constructor.
     *
     * @param IEvents $events
     */
    public function __construct(IEvents $events)
    {
        $this->events = $events;
    }

    /** @inheritdoc */
    public function onBeforeAssertion()
    {
        $this->events->emmit(IEvents::BEFORE);
    }

    /** @inheritdoc */
    public function onAssertionSuccess()
    {
        $this->events->emmit(IEvents::SUCCESS);
    }

    /** @inheritdoc */
    public function onAssertionFailure($message)
    {
        $this->events->emmit(IEvents::FAILURE, [$message]);
    }
}
