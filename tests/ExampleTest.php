<?php
require __DIR__ . '\..\library\TerminalLibrary.php';

use PHPUnit\Framework\TestCase;
use library\TerminalLibrary;

class ExampleTest extends TestCase
{
    public function makeTerminalLibrary()
    {
        return new TerminalLibrary();
    }

    public function test_setPricing_dataGiven_expected()
    {
        $expected = (object) [
            "A" => (object) [
                "unit_price" => 1.25,
                "bulk" => (object) [
                    "limit" => 3,
                    "price" => 3
                ]
            ],
            "B" => (object) [
                "unit_price" => 4.25,
                "bulk" => (object) [
                    "limit" => 0,
                    "price" => 0
                ]
            ],
            "C" => (object) [
                "unit_price" => 1,
                "bulk" => (object) [
                    "limit" => 6,
                    "price" => 5
                ]
            ],
            "D" => (object) [
                "unit_price" => 0.75,
                "bulk" => (object) [
                    "limit" => 0,
                    "price" => 0
                ]
            ],
        ];

        $terminalLibrary = $this->makeTerminalLibrary();

        $result = $terminalLibrary->setPricing();

        $this->assertEquals($expected, $result);
    }

    public function test_scanProduct_dataExist_expected()
    {
        $product_code = "A";

        $product_list = (object) [
            "A" => (object) [
                "unit_price" => 1.25,
                "bulk" => (object) [
                    "limit" => 3,
                    "price" => 3
                ]
            ],
            "B" => (object) [
                "unit_price" => 4.25,
                "bulk" => (object) [
                    "limit" => 0,
                    "price" => 0
                ]
            ],
            "C" => (object) [
                "unit_price" => 1,
                "bulk" => (object) [
                    "limit" => 6,
                    "price" => 5
                ]
            ],
            "D" => (object) [
                "unit_price" => 0.75,
                "bulk" => (object) [
                    "limit" => 0,
                    "price" => 0
                ]
            ],
        ];

        $expected = $product_code . " : " . $product_list->$product_code->unit_price . "<br>";

        $terminalLibrary = $this->makeTerminalLibrary();

        $terminalLibrary->setPricing();

        $result = $terminalLibrary->scanProduct($product_code);

        $this->assertEquals($expected, $result);
    }

    public function test_scanProduct_dataNotExist_expected()
    {
        $product_code = "E";

        $expected = $product_code . " is not included on the list of available products. <br>";

        $terminalLibrary = $this->makeTerminalLibrary();

        $terminalLibrary->setPricing();

        $result = $terminalLibrary->scanProduct($product_code);

        $this->assertEquals($expected, $result);
    }

    public function test_calculateTotalPrice_dataGiven_expected()
    {
        $product_code = "A";

        $product_list = (object) [
            "A" => (object) [
                "unit_price" => 1.25,
                "bulk" => (object) [
                    "limit" => 3,
                    "price" => 3
                ]
            ],
            "B" => (object) [
                "unit_price" => 4.25,
                "bulk" => (object) [
                    "limit" => 0,
                    "price" => 0
                ]
            ],
            "C" => (object) [
                "unit_price" => 1,
                "bulk" => (object) [
                    "limit" => 6,
                    "price" => 5
                ]
            ],
            "D" => (object) [
                "unit_price" => 0.75,
                "bulk" => (object) [
                    "limit" => 0,
                    "price" => 0
                ]
            ],
        ];

        $expected = 13.25;

        $terminalLibrary = $this->makeTerminalLibrary();

        $terminalLibrary->setPricing();
        $terminalLibrary->scanProduct("A");
        $terminalLibrary->scanProduct("B");
        $terminalLibrary->scanProduct("C");
        $terminalLibrary->scanProduct("D");
        $terminalLibrary->scanProduct("A");
        $terminalLibrary->scanProduct("B");
        $terminalLibrary->scanProduct("A");

        $result = $terminalLibrary->calculateTotalPrice();

        $this->assertEquals($expected, $result);
    }
}
