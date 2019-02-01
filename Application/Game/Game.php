<?php

require_once 'Struct\Struct.php';
require_once 'Logic\Logic.php';
require_once 'Input\Input.php';

class Game {

    private $db;
    private $struct;
    private $logic;
    private $input;

    public function __construct($db) {
        $this->db = $db;
        $this->struct = new Struct();
        $this->logic  = new Logic($this->struct);
        $this->input  = new Input($this->logic);
    }

    private function delOld($userId){
        $this->db->deleteTower($userId);
        $this->logic->delTower($userId);
        $this->db->deleteMob($userId);
        $this->logic->killMob($userId);
    }

    private function addTower($userId) {
        // удалить все старые башни пользователя из БД (и из структуры)
        $this->delOld($userId);
        // создать новую башню
        $this->logic->addTower($userId);//внутри добавить башню в структуру
        // добавить башню в БД
        foreach ($this->struct->towers as $tower) {
            $this->db->addTower($tower);
        }
        return true;
    }

    private function addMob($userId) {
        // удалить всех старых мобов пользователя из БД (и из структуры)
        $this->delOld($userId);
        // создать нового моба
        $this->logic->addMob($userId);//внутри добавить моба в структуру
        // добавить моба в БД
        foreach ($this->struct->mobs as $mob) {
            $this->db->addMob($mob);
        }

        return true;
    }

    private function addShot($userId, $id){
        // удалить все старые выстрелы пользователя из БД (и из структуры)
        $this->db->deleteShot($userId);
        $this->logic->delShot($userId);
        //выстрелить
        $this->logic->shoting($id);
        // добавить выстрел в БД
        foreach ($this->struct->shots as $shot) {
            $this->db->addShot($shot);
        }

        return true;
    }

    public function getCommand() {
        return $this->input->getCommand();
    }

    public function executeCommand($name, $options = null) {
        $COMMANDS = $this->input->getCommand();
        switch ($name) {
            case $COMMANDS->ADD_TOWER    : return $this->addTower($options->userId);
            case $COMMANDS->ADD_MOB      : return $this->addMob  ($options->userId);
            case $COMMANDS->SHOTING      : return $this->addShot ($options->userId);
            case $COMMANDS->MOVE_MOB     : return $this->moveMob ($options);
            case $COMMANDS->CHANGE_TOWER : return $this->changeTower($options);
        }
        return $this->input->executeCommand($name, $options);
    }

    public function changeTower($options){
        $tower = $this->db->getTowerByUserId($options->userId);
        if($options->change == 38) {
            $this->addShot($options->userId, $tower->id);
        } else {
            $this->logic->rotateTower($options->change, $tower->id);
        }
        return true;
    }
    public function moveMob($options) {
        $mob = $this->db->getMobByUserId($options->userId);
        $this->logic->moveMob($options->move, $mob->id);
        return true;
    }

    public function getStruct() {
        return $this->struct;
    }

    public function init($mapId) {
        $map = $this->db->getMap($mapId);
        $tiles = $this->db->getTiles($map->id);
        $this->struct->setMap($tiles, $map->size_x, $map->size_y);
        $mobs = $this->db->getMobs();
        $this->struct->setMobs($mobs);
        $shots = $this->db->getShots();
        $this->struct->setShots($shots);
        $towers = $this->db->getTowers();
        $this->struct->setTowers($towers);
    }

    // записать измененные данные в БД
    public function update($mapId) {
        if ($mapId) {
            $map = $this->db->getMap($mapId);
            if ($map) {
                // записать башни
                foreach ($this->struct->towers as $tower) {
                    $this->db->updateTowers($mapId, $tower);
                }
                // записать города
                foreach ($this->struct->mobs as $mob) {
                    $this->db->updateMobs($mapId, $mob);
                }
                // записать выстрелы
                foreach ($this->struct->shots as $shot) {
                    $this->db->updateShots($mapId, $shot);
                }

                return true;
            }
        }
        return false;
    }
}