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
    public function openSuite($name);

    /**
     * Output suite closing.
     *
     * @param string $name
     */
    public function closeSuite($name);

    /**
     * Output describe opening.
     *
     * @param string $message
     */
    public function openDescribe($message);

    /**
     * Output describe closing.
     *
     * @param string $message
     */
    public function closeDescribe($message);

    /**
     * Output context opening.
     *
     * @param string $message
     */
    public function openContext($message);

    /**
     * Output context closing.
     *
     * @param string $message
     */
    public function closeContext($message);

    /**
     * Output it opening.
     *
     * @param string $message
     */
    public function openIt($message);

    /**
     * Output it closing.
     *
     * @param string $message
     */
    public function closeIt($message);

    /**
     * Output before assertion.
     */
    public function outputBefore();

    /**
     * Output assertion success.
     *
     * @param array $success success details
     */
    public function outputSuccess(array $success);

    /**
     * Output assertion failure.
     *
     * @param array $error failure details
     */
    public function outputFailure(array $error);
}
