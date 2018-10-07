<?php

require_once 'Tile.php';
require_once 'Tower.php';
require_once 'Mob.php';
require_once 'Shot.php';

class Struct {

    const TOWER_DAMAGE = 500;
    const TOWER_ANGLE = 0;
    const MOB_LIFE = 1500;
    const MOB_SPEED = 5;
  
    public $towers; // список башен
    public $mobs;   // список мобов
    public $shots;  // список летящих выстрелов
    public $map;    // карта

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
        //задать летящие выстрелы
        $this->shots = [];
        if (isset($options->shots)) {
            foreach ($options->shots as $shot) {
                $this->shots[] = new Shot($shot);
            }
        }
    }
    
        public function addMob($options) {
        // выбрать новый идентификатор
        //...
        $options->id = 55;
        $options->life = self::MOB_LIFE ;
        $options->speed = self::MOB_SPEED;
        $this->towers[] = new Mob($options);
    }


        public function addMob($options) {
        // выбрать новый идентификатор
        //...
        $options->id = 55;
        $options->life = self::MOB_LIFE ;
        $options->speed = self::MOB_SPEED;
        $this->towers[] = new Mob($options);
    }

    
    public function addTower($options) {
        // выбрать новый идентификатор
        //...
        $options->id = 123;
        $options->damage = self::TOWER_DAMAGE;
        $options->angle = self::TOWER_ANGLE;
        $this->towers[] = new Tower($options);
    }

    public function addShot($options) {
        $this->shots[] = new Shot($options);
    }
}
