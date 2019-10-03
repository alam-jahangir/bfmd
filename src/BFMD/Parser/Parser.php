<?php

namespace BFMD\Parser;

/**
 * Parser for BFMD (Broccoli flavored MarkDown )
 * Class Parser
 * @package BFMD
 */
abstract class Parser
{
    // A blank line is any line that looks like a blank line — a line containing nothing but spaces or tabs is considered blank.

    /**
     * @var string
     */
    public $html;

    /**
     * @var array
     */
    public $lines;

    /**
     * @var string|array|mixed
     */
    protected $_pattern = null;

    /**
     * @param string $line
     * @return string
     */
    abstract protected function parse(&$line);

    /**
     * Escape HTML
     * @return string
     */
    public function getString()
    {
        $this->html = str_replace('&', '&amp;', $this->html);
        $this->html = str_replace('<', '&lt;', $this->html);
        $this->html = str_replace('>', '&gt;', $this->html);
        return $this->html;
    }

    /**
     * Broccoli flavored MarkDown
     * @param $contents string
     * @return string
     */
    protected function processText($contents, $pattern)
    {
        $this->lines = preg_split("/({$pattern})/", $contents, -1, PREG_SPLIT_OFFSET_CAPTURE);
    }

    /**
     * Get Html
     * @return string
     */
    public function getHtml()
    {
        return $this->html;
    }

}