<?php

require_once 'Unit.php';

class Tower extends Unit {
    public $damage;

    public function __construct($options) {
        parent::__construct($options);
        $this->damage = $options->damage;
    }
}