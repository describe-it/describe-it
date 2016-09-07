<?php namespace Describe\Common;

use Describe\Contracts\IEvents;
use Evenement\EventEmitter;

class Events implements IEvents
{
    protected $emitter;

    /**
     * Events constructor.
     */
    public function __construct()
    {
        $this->emitter = new EventEmitter();
    }

    /** @inheritdoc */
    public function register($name, $handler)
    {
        $this->emitter->on($name, $handler);
    }

    /** @inheritdoc */
    public function emmit($name, $argument)
    {
        $this->emitter->emit($name, [$argument]);
    }
}