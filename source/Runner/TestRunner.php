<?php namespace Describe\Runner;

use Describe\Common\Runner;
use Describe\Contracts\IEvents;

class TestRunner extends Runner
{
    /** @inheritdoc */
    public function run()
    {
        foreach ($this->options->get('suites') as $suite)
        {
            $this->events->emmit(IEvents::SUITE, $suite['name']);

            $files = $this->files(
                "{$this->options->get('cwd')}/{$suite['directory']}/",
                ".{$this->options->get('suffix')}.php"
            );

            foreach ($files as $file)
            {
                /** @noinspection PhpIncludeInspection */
                require($file);
            }
        }
    }

    public function bind()
    {

    }
}