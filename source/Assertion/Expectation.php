<?php namespace Describe\Assertion;

use Describe\Contracts\IBinding;

class Expectation
{
    /** @var mixed */
    protected $subject;

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
        $this->subject = $subject;
        $this->binding = $binding;
    }

    /**
     * Assert equality.
     *
     * @param mixed $object
     *
     * @return void
     */
    public function equal_to($object)
    {
        $this->assert(
            $this->subject == $object,
            "Expected {$this->subject} to be equal to {$object}.",
            "Expected {$this->subject} to not be equal to {$object}."
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
}