<?php

class BaseElement {
    public $id;
    public $type;
    public $sprite;

    public function __construct($options) {
        $this->id = $options->id;
        $this->type = $options->type;
        $this->sprite = $options->sprite;
    }
}