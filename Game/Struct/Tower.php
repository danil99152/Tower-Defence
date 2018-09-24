<?php

require_once 'Unit.php';

class Tower extends Unit {
    public $damage;
    public $angle; // угол поворота башни

    public function __construct($options) {
        parent::__construct($options);
        $this->damage  = $options->damage;
        $this->angle   = $options->angle;
    }
}