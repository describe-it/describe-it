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
     * Negate statement.
     *
     * @return Expectation
     */
    public function not()
    {
        $this->negated = !$this->negated;

        return $this;
    }

    /**
     * Assert equal to.
     *
     * @param mixed $o
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
            $this->binding->onAssertionSuccess();
        }
        else
        {
            $this->binding->onAssertionFailure($message);
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
     * Assert is empty.
     */
    public function is_empty()
    {
        $this->assert(
            empty($this->s),
            "Expected {$this->e($this->s)} to be empty.",
            "Expected {$this->e($this->s)} to not be empty."
        );
    }

    /**
     * Assert regex match.
     *
     * @param string $r
     */
    public function match_a($r)
    {
        $this->assert(
            preg_match($r, $this->s),
            "Expected {$this->e($this->s)} to match {$r}.",
            "Expected {$this->e($this->s)} to not match {$r}."
        );
    }

    /**
     * Assert smaller than.
     *
     * @param integer|float|double $n
     */
    public function smaller_than($n)
    {
        $this->assert(
            $this->s < $n,
            "Expected {$this->e($this->s)} to be smaller than {$this->e($n)}.",
            "Expected {$this->e($this->s)} to not be smaller than {$this->e($n)}."
        );
    }

    /**
     * Assert bigger than.
     *
     * @param integer|float|double $n
     */
    public function bigger_than($n)
    {
        $this->assert(
            $this->s > $n,
            "Expected {$this->e($this->s)} to be bigger than {$this->e($n)}.",
            "Expected {$this->e($this->s)} to not be bigger than {$this->e($n)}."
        );
    }

    /**
     * Assert within a range.
     *
     * @param integer|float|double $n1 from
     * @param integer|float|double $n2 to
     */
    public function within_a_range($n1, $n2)
    {
        $r = "{$n1}...{$n2}";

        $this->assert(
            $this->s >= $n1 && $this->s <= $n2,
            "Expected {$this->e($this->s)} to be in {$r} range.",
            "Expected {$this->e($this->s)} to not be in {$r} range."
        );
    }

    /**
     * Assert same as.
     *
     * @param mixed $o
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