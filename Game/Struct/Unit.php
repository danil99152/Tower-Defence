<?php

require_once 'BaseElement.php';

class Unit extends BaseElement {
    public $gamerId;
    public $x;
    public $y;
    public $speed;

    public function __construct($options) {
        parent::__construct($options);
        $this->gamerId = $options->gamerId;
        $this->x       = $options->x;
        $this->y       = $options->y;
        $this->speed  = $options->speed;
    }
}
