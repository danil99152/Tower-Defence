<?php

require_once "Unit.php";

class Shot extends Unit {
    public $towerId;
    public $status;
    public $angle;
    public $speed;

    public function __construct($options) {
        parent::__construct($options);
        $this->towerId = $options->towerId;
        $this->status  = $options->status;
        $this->angle   = $options->angle;
        $this->speed   = $options->speed;
    }
}