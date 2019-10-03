<?php


namespace BFMD\Parser;

/**
 * Anchor HTML Tag Parser
 * Class LinkParser
 * @package BFMD\Parser
 */
class LinkParser extends Parser
{
    /**
     * LinkParser constructor.
     */
    public function __construct()
    {
        /**
         * Regular Expression to Parse [linked text](URL)=<a href="URL">linked text</a>
         * @var string
         */

        $this->_pattern = '\[(.+)\]\((.+)\)';
    }

    /**
     * Process Anchor URL: [linked text](URL)=<a href="URL">linked text</a>
     * @param $line string
     * @return string
     */
    public function parse(&$line)
    {
        //preg_match_all("/{$this->linkedURL}/", $line, $matches);
        $line = preg_replace("/{$this->_pattern}/", '<a href="$2">$1</a>', $line);
        return $line;
    }
}