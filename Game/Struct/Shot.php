<?php

require_once "Unit.php";

class Shot extends Unit
{
    public $speed; //скорость полета
    public $angle; //угол полета

    public function __construct($options)
    {
        parent::__construct($options);
        $this->speed = $options->speed;
        $this->angle = $options->angle;
    }
}