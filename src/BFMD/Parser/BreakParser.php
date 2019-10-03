<?php


namespace BFMD\Parser;


/**
 * Break HTML TAG Parser
 * Class BreakParser
 * @package BFMD\Parser
 */
class BreakParser extends Parser
{
    public function __construct()
    {
        /**
         * Break Separator
         * @var string
         */
        $this->_pattern = "\n";
    }

    /**
     * Replace \n by <br />
     * @param $line
     * @return string
     */
    public function parse(&$line)
    {
        $line = preg_replace("/{$this->_pattern}/", "<br />", $line);
        return $line;
    }
}