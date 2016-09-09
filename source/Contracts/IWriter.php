<?php namespace Describe\Contracts;

interface IWriter
{
    /**
     * Output suite opening.
     *
     * @param string $name
     */
    public function startSUITE($name);

    /**
     * Output suite closing.
     */
    public function endSUITE();

    /**
     * Output describe opening.
     *
     * @param string $message
     */
    public function startDESCRIBE($message);

    /**
     * Output describe closing.
     */
    public function endDESCRIBE();

    /**
     * Output context opening.
     *
     * @param string $message
     */
    public function startCONTEXT($message);

    /**
     * Output context closing.
     */
    public function endCONTEXT();

    /**
     * Output it opening.
     */
    public function startIT();

    /**
     * Output it closing.
     */
    public function endIT();

    /**
     * Output it content.
     *
     * @param string $message
     */
    public function contentIT($message);

    /**
     * Output assertion success.
     */
    public function contentSUCCESS();

    /**
     * Output assertion failure.
     *
     * @param string $message
     */
    public function contentFAILURE($message);
}
