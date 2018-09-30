<?php

require_once 'BaseElement.php';

class Unit extends BaseElement {
    public $gamerId;
    public $x;
    public $y;
    public $speed;
    public $angle; //угол поворота

    public function __construct($options) {
        parent::__construct($options);
        $this->gamerId = $options->gamerId;
        $this->x       = $options->x;
        $this->y       = $options->y;
        $this->speed  = $options->speed;
<<<<<<< HEAD
        $this->angle   = $options->angle;
=======
>>>>>>> c40d8b7de0a0e1db45964285d2724227c5a729b8
    }
}
