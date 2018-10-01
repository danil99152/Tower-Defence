<?php

require_once 'Struct\Struct.php';
require_once 'Logic\Logic.php';

class Game {

    private $struct;
    private $logic;

    public function __construct($options) {
        $this->struct = new Struct($options);
        $this->logic  = new Logic($this->struct);

        $this->logic->addTower(2);
        $this->logic->delTower(1);

        //$this->logic->rotateTower(3, 0.5);
        //$this->logic->shoting(3);

        print_r($this->struct);
    }
}