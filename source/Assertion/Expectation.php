<?php namespace Describe\Assertion;

use Describe\Contracts\IBinding;

class Expectation
{
    /** @var mixed */
    protected $s;

    /** @var IBinding */
    protected $binding;

    /** @var boolean */
    protected $negated = false;

    /**
     * Expectation constructor.
     *
     * @param mixed    $subject
     * @param IBinding $binding
     */
    public function __construct($subject, IBinding $binding)
    {
        $this->s = $subject;
        $this->binding = $binding;
    }

    /**
     * Assert equal to.
     *
     * @param mixed $o
     *
     * @return void
     */
    public function equal_to($o)
    {
        $this->assert(
            $this->s == $o,
            "Expected {$this->e($this->s)} to be equal to {$this->e($o)}.",
            "Expected {$this->e($this->s)} to not be equal to {$this->e($o)}."
        );
    }

    /**
     * Make an assertion.
     *
     * @param boolean $condition
     * @param string  $normal  message
     * @param string  $negated message
     *
     * @return void
     */
    protected function assert($condition, $normal, $negated)
    {
        $message = $this->negated ? $negated : $normal;
        $result = $this->negated ? !$condition : $condition;

        if ($result)
        {
            $this->binding->emmitAssertionSuccess();
        }
        else
        {
            $this->binding->emmitAssertionFailure($message);
        }
    }

    /**
     * Get human-readable object representation.
     *
     * @param $o
     *
     * @return string
     */
    protected function e($o)
    {
        return var_export($o, true);
    }

    /**
     * Assert same as.
     *
     * @param mixed $o
     *
     * @return void
     */
    public function same_as($o)
    {
        $this->assert(
            $this->s === $o,
            "Expected {$this->e($this->s)} to be same as {$this->e($o)}.",
            "Expected {$this->e($this->s)} to not be same as {$this->e($o)}."
        );
    }
}