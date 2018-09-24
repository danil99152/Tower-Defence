<?php

require_once 'BaseElement.php';

class Tile extends BaseElement {
    public $passability;

    public function __construct($options) {
        parent::__construct($options);
        $this->passability = $options->passability;
    }
}