<?php namespace Describe\Assertion;

use Describe\Contracts\IBinding;
use Describe\Contracts\IEvents;

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
    public function emmitAssertionSuccess()
    {
        $this->events->emmit(IEvents::ASSERTION_SUCCESS);
    }

    /** @inheritdoc */
    public function emmitAssertionFailure($message)
    {
        $this->events->emmit(IEvents::ASSERTION_FAILURE, $message);
    }
}