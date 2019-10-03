<?php


namespace BFMD;

use BFMD\Parser\ParagraphParser;
use BFMD\Parser\LinkParser;
use BFMD\Parser\HashParser;
use BFMD\Parser\MagicConstantsParser;

/**
 * Parser for BFMD (Broccoli flavored MarkDown
 * Create a parser that takes a given input and converts it to some output using some of the standard MarkDown components and some special flavor.
 * Class BroccoliMarkDown
 * @package BFMD
 */
class BroccoliMarkDown
{
    /**
     * BFMD constructor.
     */
    public function __construct()
    {
        $this->paragraphParser = new ParagraphParser();
        $this->linkParser = new LinkParser();
        $this->hashParser = new HashParser();
        $this->magicConstantsParser = new MagicConstantsParser();
    }

    /**
     * Process INput Test and Parse
     * @param $input
     * @return string
     */
    public function parse($input)
    {

        $this->paragraphParser->process($input);

        if (count($this->paragraphParser->lines) > 0) {
            foreach ($this->paragraphParser->lines as &$line) {

                $currentLine = strval(trim($line[0]));

                // blank line
                if ($currentLine == '')
                    continue;

                // [linked text](URL) that will be converted t Anchor URL
                $this->linkParser->parse($currentLine);

                // Append Hash Tag
                $isHash = $this->hashParser->parse($currentLine);


                // Replace Magic Constant by Value
                $this->magicConstantsParser->parse($currentLine);

                // Append break tag
                // $currentLine = $this->breakSeparator($currentLine);

                if (!$isHash && $line[1] > 1) {
                    $this->paragraphParser->parse($currentLine);
                }

                $this->paragraphParser->html .= $currentLine;
            }
        }

        return $this->paragraphParser->html;
    }

}