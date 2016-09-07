<?php namespace Describe\Common;

use Describe\Contracts\IEvents;
use Describe\Contracts\IOptions;
use Describe\Contracts\IParameters;
use Describe\Contracts\IRunner;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

abstract class Runner implements IRunner
{
    /** @var  IEvents */
    protected $events;

    /** @var IParameters */
    protected $parameters;

    /** @var IOptions */
    protected $options;

    /**
     * Runner constructor.
     *
     * @param IEvents     $events
     * @param IParameters $parameters
     * @param IOptions    $options
     */
    public function __construct(IEvents $events, IParameters $parameters, IOptions $options)
    {
        $this->events = $events;
        $this->parameters = $parameters;
        $this->options = $options;
    }

    /** @inheritdoc */
    public abstract function run();

    /** @inheritdoc */
    public abstract function bind();

    protected function files($folder, $pattern)
    {
        $files = [];
        $iterator = new RecursiveDirectoryIterator($folder);

        foreach (new RecursiveIteratorIterator($iterator) as $file)
        {
            if (strpos($file, $pattern) !== false)
            {
                $files[] = $file->getPathName();
            }
        }

        return $files;
    }
}