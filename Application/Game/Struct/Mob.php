<?php

require_once 'Unit.php';

class Mob extends Unit {
    public $life;
    public $speed;

    public function __construct($options) {
        parent::__construct($options);
        $this->life = $options->life;
        $this->speed = $options->speed;
    }
}