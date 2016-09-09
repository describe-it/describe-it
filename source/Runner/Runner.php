<?php namespace Describe\Runner;

use Describe\Contracts\IEvents;
use Describe\Contracts\IOptions;
use Describe\Contracts\IRunner;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

abstract class Runner implements IRunner
{
    /** @var  IEvents */
    protected $events;

    /** @var IOptions */
    protected $options;

    /**
     * Runner constructor.
     *
     * @param IEvents  $events
     * @param IOptions $options
     */
    public function __construct(IEvents $events, IOptions $options)
    {
        $this->events = $events;
        $this->options = $options;
    }

    /** @inheritdoc */
    public function execute($suiteName = null)
    {
        foreach ($this->options->get('suites') as $suite)
        {
            if (empty($suiteName) || $suiteName == $suite['name'])
            {
                $this->executeSuite($suite);
            }
        }
    }

    /**
     * Execute test cases from suite.
     *
     * @param array $suite
     */
    protected abstract function executeSuite(array $suite);

    /** @inheritdoc */
    public abstract function bind();

    /**
     * Get test files for suite.
     *
     * @param array $suite
     *
     * @return array
     */
    protected function files(array $suite)
    {
        $directory = "{$this->options->get('cwd')}/{$suite['directory']}/";
        $pattern = ".{$this->options->get('suffix')}.php";

        $files = [];
        $iterator = new RecursiveDirectoryIterator($directory);

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
