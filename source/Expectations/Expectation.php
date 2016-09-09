<?php namespace Describe\Expectations;

use Describe\Contracts\DescribeException;
use Describe\Contracts\IEvents;
use Describe\Expectations\Traits\TIdentityAssertions;

/**
 * Class Expectation
 *
 * @property Expectation $to_be
 * @property Expectation $to_be_not
 * @property Expectation $to_have
 * @property Expectation $to_have_not
 *
 * @package Describe\Expectations
 */
class Expectation
{
    use TIdentityAssertions;

    /** @var IEvents */
    protected $events;

    /** @var mixed */
    protected $subject;

    /** @var boolean */
    protected $statement = true;

    /**
     * Expectation constructor.
     *
     * @param mixed   $subject
     * @param IEvents $events
     */
    public function __construct($subject, IEvents $events)
    {
        $this->subject = $subject;
        $this->events = $events;
    }

    /**
     * Virtual grammar fields.
     *
     * @param string $name
     *
     * @throws DescribeException
     * @return Expectation
     */
    public function __get($name)
    {
        switch ($name)
        {
            case 'to_be':
                return $this->toBe();
            case 'to_have':
                return $this->toBe();
            case 'to_be_not':
                return $this->toBeNot();
            case 'to_have_not':
                return $this->toBeNot();
            default:
                $message = "{$name} is not a valid statement grammar.";
                throw new DescribeException($message);
        }
    }

    /**
     * Affirmative statement.
     *
     * @return Expectation
     */
    protected function toBe()
    {
        $this->statement = true;

        return $this;
    }

    /**
     * Negative statement.
     *
     * @return Expectation
     */
    protected function toBeNot()
    {
        $this->statement = false;

        return $this;
    }

    /**
     * Make an assertion.
     *
     * @param boolean $t truth representation
     * @param string  $b before `not` word
     * @param string  $a after `not` word
     */
    protected function assert($t, $b, $a)
    {
        $this->events->emmit(IEvents::BEFORE);

        $message = $this->statement ? "{$b} {$a}" : "{$b} not {$a}";
        $result = $this->statement ? $t : !$t;

        if ($result)
        {
            $this->events->emmit(IEvents::SUCCESS);
        }
        else
        {
            $this->events->emmit(IEvents::FAILURE, [$message]);
        }
    }

    /**
     * Get human-readable object representation.
     *
     * @param mixed $o
     *
     * @return string
     */
    protected function e($o)
    {
        return var_export($o, true);
    }
}
