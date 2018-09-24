<?php

require_once 'Struct\Struct.php';

class Game {

    private $struct;

    public function __construct($options) {
        $this->struct = new Struct($options);
    }

}