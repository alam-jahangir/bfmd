<?php


namespace BFMD\Parser;

/**
 * Paragraph Parser based on Pattern
 * Class ParagraphParser
 * @package BFMD\Parser
 */
class ParagraphParser extends Parser
{
    /**
     * ParagraphParser constructor.
     */
    public function __construct()
    {
        /**
         * Line Separator
         * @var string
         */
        $this->_pattern = "\n";
    }

    /**
     * Add p tag
     * @param string $line
     * @return string
     */
    public function parse(&$line)
    {
        $line = "<p>" . $line . "</p>";
        return $line;
    }

    /**
     * Separate Full Input text into Paragraph Pattern
     * @param string $contents
     * @return string|void
     */
    public function process($contents)
    {
        $this->processText($contents, $this->_pattern);
    }

}