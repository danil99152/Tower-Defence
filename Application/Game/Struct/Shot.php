<?php

require_once "Unit.php";

class Shot extends Unit {
    public $towerId;
    public $status;
    public $speed;

    public function __construct($options) {
        parent::__construct($options);
        $this->towerId = $options->towerId;
        $this->status  = $options->status;
        $this->speed   = $options->speed;
    }
}