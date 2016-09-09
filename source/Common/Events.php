<?php namespace Describe\Common;

use Describe\Contracts\IEvents;
use Evenement\EventEmitter;

/**
 * Class Events
 * @package Describe\Common
 */
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
    public function remove($name, $handler)
    {
        $this->emitter->removeListener($name, $handler);
    }

    /** @inheritdoc */
    public function emmit($name, $arguments = [])
    {
        $this->emitter->emit($name, $arguments);
    }
}
