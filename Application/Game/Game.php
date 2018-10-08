<?php

require_once 'Struct\Struct.php';
require_once 'Logic\Logic.php';
require_once 'Input\Input.php';

class Game {

    private $struct;
    private $logic;
    private $input;

    public function __construct($options) {
        $this->struct = new Struct($options);
        $this->logic  = new Logic($this->struct);
        $this->input  = new Input($this->logic);
    }

    public function getCommand() {
        return $this->input->getCommand();
    }

    public function executeCommand($name, $options = null) {
        return $this->input->executeCommand($name, $options);
    }
}