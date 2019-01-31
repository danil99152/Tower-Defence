<?php

require_once 'Tile.php';
require_once 'Tower.php';
require_once 'Mob.php';
require_once 'Shot.php';
//require_once 'GoOut.php';

class Struct {

    const TOWER_DAMAGE = 500;
    const TOWER_ANGLE = 0;
    const MOB_LIFE = 1500;
    const MOB_SPEED = 5;
    const SHOT_STATUS = 1; //1-летит, 0-не летит (на случай подсчета выстрелов)
  
    public $towers; // список башен
    public $mobs;   // список мобов
    public $shots;  // список летящих выстрелов
    public $map;    // карта

    public function __construct() {
    }

    public function addMob($options) {
        $this->mobs = [];
        $options->life = self::MOB_LIFE;
        $options->speed = self::MOB_SPEED;
        $options->type = 0;
        $this->mobs[] = new Mob($options);
    }

    public function addTower($options) {
        $this->towers = [];
        $options->damage = self::TOWER_DAMAGE;
        $options->angle = self::TOWER_ANGLE;
        $options->type = rand(0, 3);
        $this->towers[] = new Tower($options);
    }

    public function addShot($options) {
        $this->shots = [];
        $options->status = self::SHOT_STATUS;
        $options->type = 0;
        $this->shots[] = new Shot($options);
    }

    public function setMap($map, $sizeX, $sizeY) {
        $this->map = [];
        if ($map) {
            $num = 0;
            for ($i = 0; $i < $sizeX; $i++) {
                $this->map[$i] = [];
                for ($j = 0; $j < $sizeY; $j++) {
                    $this->map[$i][$j] = new Tile($map[$num]);
                    $num++;
                }
            }
        }
    }

    public function setMobs($mobs){
        $this->mobs = [];
        foreach ($mobs as $mob) {
            $mob->gamerId = $mob->user_id;
            $this->mobs[] = new Mob($mob);
        }
    }

    public function setTowers($towers){
        $this->towers = [];
        foreach ($towers as $tower) {
            $tower->gamerId = $tower->user_id;
            $this->towers[] = new Tower($tower);
        }
    }

    public function setShots($shots){
        $this->shots = [];
        foreach ($shots as $shot) {
            $shot->gamerId = $shot->user_id;
            $this->shots[] = new Shot($shot);
        }
    }
}
