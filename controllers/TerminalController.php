<?php

namespace Controller;

use Library\TerminalLibrary;

class TerminalController
{
    private $terminal;

    public function __construct(TerminalLibrary $terminal)
    {
        $this->terminal = $terminal;
    }

    public function terrminal()
    {
        $this->terminal->setPricing();
        $this->terminal->scanProduct("A");
        $this->terminal->scanProduct("B");
        $this->terminal->scanProduct("C");
        $this->terminal->scanProduct("D");
        $this->terminal->scanProduct("A");
        $this->terminal->scanProduct("B");
        $this->terminal->scanProduct("A");

        $this->terminal->calculateTotalPrice();
    }
}
 
?>