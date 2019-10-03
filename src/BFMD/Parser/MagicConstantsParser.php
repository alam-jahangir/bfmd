<?php


namespace BFMD\Parser;

/**
 * Convert Magic Constant to Pre-Defined Format
 * Class MagicConstantsParser
 * @package BFMD\Parser
 */
class MagicConstantsParser extends Parser
{
    /**
     * MagicConstantsParser constructor.
     */
    public function __construct()
    {
        /**
         * Magic Constants
         * @var array
         */
        $this->_pattern = array(
            '___EAT___' => '<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/03/Broccol i_and_cross_sec tion_edit.jpg/320px-Broccoli_and_cross_section_edit.jpg" title="Broccoli is yummy!" alt="A lovely picture of broccoli" />'
        );

    }

    /**
     * Replace Magic Constant key by Value
     * @param $line string
     * @return string
     */
    public function parse(&$line)
    {
        foreach ($this->_pattern as $key => $magicConstant) {
            $line = str_replace($key, $magicConstant, $line);
        }

        return $line;
    }

}