<?php

require_once 'BaseElement.php';

class GoOut {

    public $Output;

    public function __construct($options) {
        parent::__construct($options);
        $this->Output = $options->Output;
    }
}


