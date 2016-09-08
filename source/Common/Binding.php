<?php namespace Describe\Common;

use Describe\Contracts\IEvents;
use Expective\Contracts\IBinding;

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
    }

    /** @inheritdoc */
    public function onAssertionSuccess()
    {
        $this->events->emmit(IEvents::ASSERTION_SUCCESS);
    }

    /** @inheritdoc */
    public function onAssertionFailure($message)
    {
        $this->events->emmit(IEvents::ASSERTION_FAILURE, $message);
    }
}
