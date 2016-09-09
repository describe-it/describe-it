<?php namespace Describe\Formatters;

use Describe\Common\Initializable;
use Describe\Contracts\DescribeException;
use Describe\Contracts\IErrorFactory;
use Describe\Contracts\IWriter;
use Describe\Utils\ErrorFactory;

/**
 * Class ListFormatter
 * @package Describe\Formatters
 */
class ListFormatter extends Initializable implements IWriter
{
    const GREEN = 'green';
    const RED = 'red';

    /** @var IErrorFactory */
    protected $errorFactory;

    /** @var integer */
    protected $indentation = 0;

    /** @var integer */
    protected $indent = 4;

    /** @var integer */
    protected $assertionsCount = 0;

    /** @var integer */
    protected $assertionsSucceeded = 0;

    /** @var string */
    protected $currentStatement;

    /** @var array */
    protected $currentErrors = [];

    /**
     * ListFormatter constructor.
     *
     * @param array         $options
     * @param IErrorFactory $errorFactory
     *
     * @throws DescribeException
     */
    public function __construct(
        array $options,
        IErrorFactory $errorFactory = null
    )
    {
        parent::__construct($options);
        $this->errorFactory = $errorFactory ? $errorFactory : new ErrorFactory();
    }

    /** @inheritdoc */
    public function contextEnd($message)
    {
        $this->indentation--;
    }

    /** @inheritdoc */
    public function contextStart($message)
    {
        $this->output($message);
        $this->indentation++;
    }

    /** @inheritdoc */
    public function describeEnd($message)
    {
        $this->indentation--;
    }

    /** @inheritdoc */
    public function describeStart($message)
    {
        $this->output($message);
        $this->indentation++;
    }

    /** @inheritdoc */
    public function itEnd($message)
    {
        $status = ($this->assertionsCount == $this->assertionsSucceeded);

        $icon = $status ? '*' : 'x';
        $color = $status ? self::GREEN : self::RED;
        $counter = "({$this->assertionsSucceeded}/{$this->assertionsCount})";

        $this->output("{$icon} {$message} {$counter}", $color);
        $this->reset();
    }

    /** @inheritdoc */
    public function itStart($message)
    {
        $this->reset();
    }

    /** @inheritdoc */
    public function onBefore()
    {
        //
    }

    /** @inheritdoc */
    public function onFailure($message)
    {
        $this->assertionsCount++;
    }

    /** @inheritdoc */
    public function onSuccess()
    {
        $this->assertionsCount++;
        $this->assertionsSucceeded++;
    }

    /** @inheritdoc */
    public function suiteEnd($message)
    {
    }

    /** @inheritdoc */
    public function suiteStart($name)
    {
        $this->output();
        $this->output($this->separator());
        $this->output("// Suite: {$name}");
        $this->output($this->separator());
        $this->output();
    }

    /**
     * Print text to console.
     *
     * @param string|null $text
     * @param string|null $color
     */
    protected function output($text = null, $color = null)
    {
        $output = $text;

        switch ($color)
        {
            case self::GREEN:
                $output = "\033[32m {$text} \033[0m";
                break;

            case self::RED:
                $output = "\033[31m {$text} \033[0m";
                break;
        }

        echo $this->tabs() . $output . "\n";
    }

    /**
     * Get indentation string.
     *
     * @return string
     */
    protected function tabs()
    {
        return str_repeat(
            ' ',
            (integer)$this->indentation * (integer)$this->indent
        );
    }

    /**
     * Reset current statement counters.
     */
    protected function reset()
    {
        $this->assertionsCount = 0;
        $this->assertionsSucceeded = 0;
        $this->currentStatement = '';
        $this->currentErrors = [];
    }

    /**
     * Get prettified separator.
     *
     * @return string
     */
    protected function separator()
    {
        return '/* ' . str_repeat('-', 60) . ' */';
    }
}
