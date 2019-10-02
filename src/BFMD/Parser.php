<?php
namespace BFMD;
class Parser
{

    // A blank line is any line that looks like a blank line — a line containing nothing but spaces or tabs is considered blank.
    /**
     * Line Separator
     * @var string
     */
    protected $lineSeparator = "\n";

    /**
     * Break Separator
     * @var string
     */
    protected $breakSeparator = "\n";

    /**
     * Hash Tag separator
     * # = H1, ## = H2, ## = H3 .... ###### = H6
     * @var string
     */
    protected $hash = "#";

    /**
     * Magic Constant
     * @var array
     */
    protected $magicConstants = array(
        '___EAT___' => '<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/03/Broccol i_and_cross_sec tion_edit.jpg/320px-Broccoli_and_cross_section_edit.jpg" title="Broccoli is yummy!" alt="A lovely picture of broccoli" />'
    );

    /**
     * Regular Expression to Parse [linked text](URL)=<a href="URL">linked text</a>
     * @var string
     */
    protected $linkedURL = '\[(.+)\]\((.+)\)';

    /**
     * @var string
     */
    protected $html;

    /**
     * @var string
     */
    protected $contents;

    /**
     * @var array
     */
    protected $lines;

    /**
     * Process Anchor URL
     * @param $line string
     * @return string
     */
    protected function replaceLinkURL($line)
    {
        //preg_match_all("/{$this->linkedURL}/", $line, $matches);
        $line = preg_replace("/{$this->linkedURL}/", '<a href="$2">$1</a>', $line);
        return $line;
    }

    /**
     * Replace Magic Constant key by Value
     * @param $line string
     * @return string
     */
    protected function replaceMagicConstant($line)
    {
        foreach ($this->magicConstants as $key => $magicConstant) {
            $line = str_replace($key, $magicConstant, $line);
        }

        return $line;
    }

    /**
     * Replace # by HASH Tag
     * @param $line
     * @return string
     */
    protected function hashTagSeparator(&$line)
    {
        // Get All Matches Pattern for Hash Tag
        preg_match_all(
            "/{$this->hash}+(.*)/",
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

    /**
     * Replace \n by <br />
     * @param $line
     * @return string
     */
    protected function breakSeparator($line)
    {
        return preg_replace("/{$this->breakSeparator}/", "<br />", $line);
    }

    /**
     * Line Separator
     */
    protected function linesSeparator()
    {
        $this->lines = preg_split("/({$this->lineSeparator})/", $this->contents, -1, PREG_SPLIT_OFFSET_CAPTURE);
        foreach ($this->lines as &$line) {

            $currentLine = strval(trim($line[0]));

            // blank line
            if ($currentLine == '')
                continue;

            // [linked text](URL) that will be converted t Anchor URL
            $currentLine = $this->replaceLinkURL($currentLine);

            // Append Hash Tag
            $isHash = $this->hashTagSeparator($currentLine);

            // Replace Magic Constant by Value
            $currentLine = $this->replaceMagicConstant($currentLine);

            // Append break tag
            // $currentLine = $this->breakSeparator($currentLine);

            if (!$isHash && $line[1] > 1) {
                $currentLine = "<p>" . $currentLine . "</p>";
            }

            $line[0] = $currentLine;
            $this->html .= $currentLine;
        }
    }

    /**
     * Escape HTML
     * @param $html string
     * @return string
     */
    public function escape($html)
    {
        $this->html = str_replace('&', '&amp;', $html);
        $this->html = str_replace('<', '&lt;', $this->html);
        $this->html = str_replace('>', '&gt;', $this->html);
        return $this->html;
    }

    /**
     * Broccoli flavored MarkDown
     * @param $contents string
     * @return string
     */
    public function process($contents)
    {
        $this->html = '';
        $this->contents = $contents;
        $this->linesSeparator();
        return $this->html;
    }

}