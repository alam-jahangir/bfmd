<?php

namespace BFMD;

use PHPUnit\Framework\TestCase;

class BFMDTest extends TestCase
{
    private $broccoliMarkDown;

    protected function setUp(): void
    {
        $this->broccoliMarkDown = new BroccoliMarkDown();
    }

    protected function tearDown(): void
    {
        $this->broccoliMarkDown = NULL;
    }

    public function addDataProvider()
    {
        return array(
            array("# Broccoli", "<h1>Broccoli</h1>"),
            array("## Broccoli", "<h2>Broccoli</h2>"),
            array("## Some text #2", "<h2>Some text #2</h2>"),
            array("Some text #2", "Some text <h1>2</h1>"),
            array("Some ##text 2", "Some <h2>text 2</h2>"),
            array("[##here](https://en.wikipedia.org/wiki/Broccoli)", '<a href="https://en.wikipedia.org/wiki/Broccoli"><h2>here</h2></a>'),
            array("", ""),
            array("Asd", "Asd"),
            array("[here](https://en.wikipedia.org/wiki/Broccoli)", '<a href="https://en.wikipedia.org/wiki/Broccoli">here</a>'),
            array('___EAT___', '<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/03/Broccol i_and_cross_sec tion_edit.jpg/320px-Broccoli_and_cross_section_edit.jpg" title="Broccoli is yummy!" alt="A lovely picture of broccoli" />'),
            array("# Broccoli
            Broccoli is an edible green plant in the cabbage family whose large flowerhead is eaten as a vegetable.",
                "<h1>Broccoli</h1><p>Broccoli is an edible green plant in the cabbage family whose large flowerhead is eaten as a vegetable.</p>"),
            array('Hello World.___EAT___', 'Hello World.<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/03/Broccol i_and_cross_sec tion_edit.jpg/320px-Broccoli_and_cross_section_edit.jpg" title="Broccoli is yummy!" alt="A lovely picture of broccoli" />'),
            array('[##here ___EAT___](https://en.wikipedia.org/wiki/Broccoli)', '<a href="https://en.wikipedia.org/wiki/Broccoli"><h2>here <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/03/Broccol i_and_cross_sec tion_edit.jpg/320px-Broccoli_and_cross_section_edit.jpg" title="Broccoli is yummy!" alt="A lovely picture of broccoli" /></h2></a>')
        );
    }

    /**
     * @dataProvider addDataProvider
     */
    public function testParse($input, $expected): void
    {

        $result = $this->broccoliMarkDown->parse($input);
        $this->assertEquals($expected, $result);

    }

}