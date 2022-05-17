<?php

namespace Library;
 
class TerminalLibrary
{
    public $product_list;
    public $product_scanned;
    public $total_price;

    public function setPricing()
    {
        $this->product_list = (object) [
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
                "unit_price" => 1.00,
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

        return $this->product_list;
    }

    public function scanProduct($product_code)
    {
        if(property_exists($this->product_list, $product_code)) {
            $this->product_scanned[] = $product_code;

            return $product_code . " : " . $this->product_list->$product_code->unit_price . "<br>"; 
        }

        return $product_code . " is not included on the list of available products. <br>";
    }

    public function calculateTotalPrice()
    {
        $product_count = (object) array_count_values($this->product_scanned);

        foreach($product_count as $product_code => $product_count) {

            
            
            $product = $this->product_list->$product_code;
            // print_r($product->bulk->limit);

            for ($ctr = $product_count; $ctr >= 1; $ctr--) {
                if($ctr >= $product->bulk->limit) {
                    $this->total_price += $product->bulk->price;
                    
                    $ctr -= $product->bulk->limit;
                } 
                
                if ($ctr != 0) {
                    $this->total_price += $product->unit_price;
                }
            }
        }

        return $this->total_price;
    }
}
 
?>