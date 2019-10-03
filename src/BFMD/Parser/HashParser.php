<?php


namespace BFMD\Parser;


/**
 * Hash HTML Tag Parser
 * Class HashParser
 * @package BFMD\Parser
 */
class HashParser extends Parser
{
    /**
     * HashParser constructor.
     */
    public function __construct()
    {
        /**
         * Hash Tag separator
         * # = H1, ## = H2, ## = H3 .... ###### = H6
         * @var string
         */
        $this->_pattern = "#";
    }

    /**
     * Parse Hash Tag
     * # = H1, ## = H2, ## = H3 .... ###### = H6
     * @param string $line
     * @return bool|string
     */
    public function parse(&$line)
    {

        // Get All Matches Pattern for Hash Tag
        preg_match_all(
            "/{$this->_pattern}+(.*)/",
            $line,
            $matches
        // PREG_OFFSET_CAPTURE
        );

        if (!empty($matches[0])) {
            $hashArray = $matches[0];

            // Iterate Hash Tag Match Array
            foreach ($hashArray as $key => $match) {
                $count = 0;
                $idx = 0;
                // Remove space
                $hashString = trim($match);
                // Filter End Tag
                $hashString = preg_replace('/<\/.+>/', "", $hashString);

                // Count number of # exist
                while ($hashString[$idx] == '#') {
                    $count++;
                    $idx++;
                }

                // Generate H.. Tag
                if ($count > 0) {
                    $matches[1][$key] = preg_replace('/<\/.+>/', "", $matches[1][$key]);
                    $hashTag = '<h' . $count . '>' . trim($matches[1][$key]) . '</h' . $count . '>';
                    $line = preg_replace("/{$hashString}/", $hashTag, $line);
                }

            }
        }

        return !empty($matches[0]) ? true : false;
    }

}
