<?php namespace Describe\Runner;

use Describe\Common\Initializable;
use Describe\Contracts\DescribeException;
use Describe\Contracts\IEvents;
use Describe\Contracts\IFiles;
use Describe\Contracts\ISuite;
use Describe\Contracts\ISyntax;
use Describe\Contracts\IWriter;

/**
 * Class TestSuite
 * @package Describe\Runner
 */
class TestSuite extends Initializable implements ISuite
{
    /** @var IEvents */
    protected $events;

    /** @var IFiles */
    protected $reader;

    /** @var IWriter */
    protected $writer;

    /** @var string */
    protected $name;

    /** @var string */
    protected $directory;

    /** @var string */
    protected $suffix;

    /**
     * TestSuite constructor.
     *
     * @param IEvents $events
     * @param IFiles  $reader
     * @param IWriter $writer
     * @param array   $options
     *
     * @throws DescribeException
     */
    public function __construct(
        IEvents $events,
        IFiles $reader,
        IWriter $writer,
        array $options
    )
    {
        parent::__construct($options);
        $this->events = $events;
        $this->reader = $reader;
        $this->writer = $writer;
    }

    /** @inheritdoc */
    public function execute()
    {
        $this->bind();
        $this->writer->suiteStart($this->name);
        $files = $this->reader->find($this->directory, $this->suffix);

        if (!count($files))
        {
            echo "No test files detected for {$this->name} test suite.\n";
        }

        foreach ($files as $file)
        {
            $this->reader->execute($file);
        }

        $this->writer->suiteEnd($this->name);
        $this->unbind();
    }

    /**
     * Bind event listeners.
     */
    protected function bind()
    {
        $this->events->register(IEvents::SYNTAX, [$this, 'syntax']);
        $this->events->register(IEvents::BEFORE, [$this, 'before']);
        $this->events->register(IEvents::SUCCESS, [$this, 'success']);
        $this->events->register(IEvents::FAILURE, [$this, 'failure']);
    }

    /**
     * Remove event listeners.
     */
    protected function unbind()
    {
        $this->events->remove(IEvents::SYNTAX, [$this, 'syntax']);
        $this->events->remove(IEvents::BEFORE, [$this, 'before']);
        $this->events->remove(IEvents::SUCCESS, [$this, 'success']);
        $this->events->remove(IEvents::FAILURE, [$this, 'failure']);
    }

    /**
     * Process syntax statement.
     *
     * @param string $statement
     * @param string $message
     */
    public function syntax($statement, $message)
    {
        switch ($statement)
        {
            case ISyntax::DESCRIBE_START:
                $this->writer->describeStart($message);
                break;

            case ISyntax::DESCRIBE_END:
                $this->writer->describeEnd($message);
                break;

            case ISyntax::CONTEXT_START:
                $this->writer->contextStart($message);
                break;

            case ISyntax::CONTEXT_END:
                $this->writer->contextEnd($message);
                break;

            case ISyntax::IT_START:
                $this->writer->itStart($message);
                break;

            case ISyntax::IT_END:
                $this->writer->itEnd($message);
                break;
        }
    }

    /**
     * Process before assertion.
     */
    public function before()
    {
        $this->writer->onBefore();
    }

    /**
     * Process assertion success.
     */
    public function success()
    {
        $this->writer->onSuccess();
    }

    /**
     * Process assertion failure.
     *
     * @param string $message
     */
    public function failure($message)
    {
        $this->writer->onFailure($message);
    }
}
