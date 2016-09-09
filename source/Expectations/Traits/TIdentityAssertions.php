<?php namespace Describe\Expectations\Traits;

/**
 * Class TIdentityAssertions
 * @package Describe\Expectations\Traits
 */
trait TIdentityAssertions
{
    /**
     * Assert equal to.
     *
     * @param mixed $o
     */
    public function equal_to($o)
    {
        $this->assert(
            $this->subject == $o,
            "Expected {$this->e($this->subject)} to be",
            "equal to {$this->e($o)}."
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
            $this->subject === $o,
            "Expected {$this->e($this->subject)} to be",
            "the same as {$this->e($o)}."
        );
    }

    /**
     * Assert type of.
     *
     * @param mixed $t
     */
    public function type_of($t)
    {
        $this->assert(
            gettype($this->subject) == $t || $this->statement instanceof $t,
            "Expected {$this->e($this->subject)} to have",
            "type of {$this->e($t)}."
        );
    }
}
