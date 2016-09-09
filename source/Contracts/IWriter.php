<?php namespace Describe\Contracts;

/**
 * Interface IWriter
 * @package Describe\Contracts
 */
interface IWriter
{
    /**
     * Output suite opening.
     *
     * @param string $name
     */
    public function suiteStart($name);

    /**
     * Output suite closing.
     *
     * @param string $name
     */
    public function suiteEnd($name);

    /**
     * Output describe opening.
     *
     * @param string $message
     */
    public function describeStart($message);

    /**
     * Output describe closing.
     *
     * @param string $message
     */
    public function describeEnd($message);

    /**
     * Output context opening.
     *
     * @param string $message
     */
    public function contextStart($message);

    /**
     * Output context closing.
     *
     * @param string $message
     */
    public function contextEnd($message);

    /**
     * Output it opening.
     *
     * @param string $message
     */
    public function itStart($message);

    /**
     * Output it closing.
     *
     * @param string $message
     */
    public function itEnd($message);

    /**
     * Output before assertion.
     */
    public function onBefore();

    /**
     * Output assertion success.
     */
    public function onSuccess();

    /**
     * Output assertion failure.
     *
     * @param string $message
     */
    public function onFailure($message);
}
