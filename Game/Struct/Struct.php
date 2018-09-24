<?php

require_once 'Tile.php';
require_once 'Tower.php';
require_once 'Mob.php';

class Struct {

    public $towers; // список башен
    public $mobs; // список мобов
    public $shots; // список летящих выстрелов
    public $map; // карта

    public function __construct($options) {

        // задать карту
        $this->map = [];
        if (isset($options->map)) {
            foreach ($options->map as $lineMap) {
                $this->map[] = [];
                foreach ($lineMap as $tile) {
                    $this->map[count($this->map) - 1][] = new Tile($tile);
                }
            }
        }
        // задать башни
        $this->towers = [];
        if (isset($options->towers)) {
            foreach ($options->towers as $tower) {
                $this->towers[] = new Tower($tower);
            }
        }
        // задать мобов
        $this->mobs = [];
        if (isset($options->mobs)) {
            foreach ($options->mobs as $mob) {
                $this->mobs[] = new Mob($mob);
            }
        }
    }
}