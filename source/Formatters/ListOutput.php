<?php namespace Describe\Formatters;

use Describe\Common\Initializable;
use Describe\Contracts\IWriter;

/**
 * Class ListOutput
 * @package Describe\Formatters
 */
class ListOutput extends Initializable implements IWriter
{
    const GREEN = 'green';
    const RED = 'red';

    /** @var integer */
    protected $indentation = 0;

    /** @var integer */
    protected $indent = 4;

    /** @var boolean */
    protected $passed = true;

    /** @var string */
    protected $success = '+';

    /** @var string */
    protected $failure = '-';

    /** @var integer */
    protected $assertionsCount = 0;

    /** @var integer */
    protected $assertionsSucceeded = 0;

    /** @var string */
    protected $currentStatement;

    /** @var array */
    protected $currentErrors = [];

    /** @inheritdoc */
    public function closeContext($message)
    {
        $this->indentation--;
    }

    /** @inheritdoc */
    public function closeDescribe($message)
    {
        $this->indentation--;
    }

    /** @inheritdoc */
    public function closeIt($message)
    {
        $status = ($this->assertionsSucceeded == $this->assertionsCount);

        if (!$status || $status && $this->passed)
        {
            $icon = $status ? $this->success : $this->failure;
            $color = $status ? self::GREEN : self::RED;
            $counter = "({$this->assertionsSucceeded}/{$this->assertionsCount})";
            $this->output("{$icon} {$message} {$counter}", $color);

            foreach ($this->currentErrors as $index => $error)
            {
                $number = $index + 1;
                ($number == 1) ? $this->output() : null;
                $this->output("  {$number}). {$error['message']}", $color);
                $this->output("      line: {$error['line']} in {$error['file']}", $color);
                $this->output("       {$this->line()}");
                ($number == count($this->currentErrors)) ? $this->output() : null;
            }

        }

        $this->reset();
    }

    /** @inheritdoc */
    public function closeSuite($message)
    {
    }

    /** @inheritdoc */
    public function openContext($message)
    {
        $this->output("{$message}:");
        $this->output();
        $this->indentation++;
    }

    /** @inheritdoc */
    public function openDescribe($message)
    {
        $this->output("{$message}:");
        $this->output();
        $this->indentation++;
    }

    /** @inheritdoc */
    public function openIt($message)
    {
        $this->reset();
    }

    /** @inheritdoc */
    public function openSuite($name)
    {
        $this->output();
        $this->output($this->separator());
        $this->output("// Suite: {$name}");
        $this->output($this->separator());
        $this->output();
    }

    /** @inheritdoc */
    public function outputBefore()
    {
        //
    }

    /** @inheritdoc */
    public function outputFailure(array $error)
    {
        $this->currentErrors[] = $error;
        $this->assertionsCount++;
    }

    /** @inheritdoc */
    public function outputSuccess(array $success)
    {
        $this->assertionsCount++;
        $this->assertionsSucceeded++;
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
     * Get prettified line.
     *
     * @param integer $length
     *
     * @return string
     */
    protected function line($length = 3)
    {
        return str_repeat('-', $length);
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
     * Get indentation string.
     *
     * @return string
     */
    protected function tabs()
    {
        return str_repeat(' ', $this->indentation * $this->indent);
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
