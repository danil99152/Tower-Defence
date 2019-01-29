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
  
    public $towers; // список башен
    public $mobs;   // список мобов
    public $shots;  // список летящих выстрелов
    public $map;    // карта

    public function __construct($db) {
        // задать карту
        $this->map = $db->getMap(1);
        // задать башни
        $this->towers = $db->getTowers();
        //задать мобов
        $this->mobs = $db->getMobs();
        //задать летящие выстрелы
        $this->shots = $db->getShots();
    }

    public function addMob($userId) {
        $options = new StdClass();
        $options->user_id = $userId;
        $options->life = self::MOB_LIFE ;
        $options->x = 0; //rand(1, 3);
        $options->y = 0; //rand(1, 3);
        $options->speed = self::MOB_SPEED;
        $options->type = 0;
        return $options;
    }

    public function addTower($userId) {
        $options = new StdClass();
        $options->user_id = $userId;
        $options->damage = self::TOWER_DAMAGE;
        $options->x = rand(1, 3);
        $options->y = rand(1, 3);
        $options->angle = self::TOWER_ANGLE;
        return $options;
    }

    public function addShot($userId, $towerId) {
        $options = new StdClass();
        $options->angle = self::TOWER_ANGLE;
        $options->x = rand(1, 3);
        $options->y = rand(1, 3);
        $options->speed = rand(100, 200);
        $options->user_id = $userId;
        $options->user_id = $towerId;
        //$options->status = ?;
        return $options;
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

    public function deleteTower($towers){
        $this->towers = [];
        foreach ($towers as $tower) {
            $tower->gamerId = $tower->user_id;
            unset($tower);
        }
    }

    public function deleteMob($mobs){
        $this->mobs = [];
        foreach ($mobs as $mob) {
            $mob->gamerId = $mob->user_id;
            unset($mob);
        }
    }

    public function deleteShot($shots){
        $this->shots = [];
        foreach ($shots as $shot) {
            $shot->gamerId = $shot->user_id;
            unset($shot);
        }
    }
}
