<?php namespace Describe\Runner;

use Describe\Contracts\IRunner;
use Describe\Contracts\ISuite;
use Describe\Contracts\IWriter;

/**
 * Class TestRunner
 * @package Describe\Runner
 */
class TestRunner implements IRunner
{
    /** @var IWriter */
    protected $writer;

    /** @var ISuite[] */
    protected $suites = [];

    /**
     * TestRunner constructor.
     *
     * @param IWriter $writer
     */
    public function __construct(IWriter $writer)
    {
        $this->writer = $writer;
    }

    /** @inheritdoc */
    public function schedule(ISuite $suite)
    {
        $this->suites[] = $suite;
    }

    /** @inheritdoc */
    public function run()
    {
        foreach ($this->suites as $suite)
        {
            $suite->execute();
        }
    }
}
