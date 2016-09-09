<?php namespace Describe\Runner;

use Describe\Contracts\IEvents;

class TestRunner extends Runner
{
    /** @inheritdoc */
    protected function executeSuite(array $suite)
    {
        $this->events->emmit(IEvents::SUITE_CHANGED, $suite['name']);

        foreach ($this->files($suite) as $file)
        {
            /** @noinspection PhpIncludeInspection */
            require($file);
        }
    }

    /** @inheritdoc */
    public function bind()
    {

    }
}
