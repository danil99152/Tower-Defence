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

    private function addTower($userId) {
        // удалить все старые башни пользователя из БД (и из структуры)
        $this->db->deleteTower($userId);
        $this->logic->delTower($userId);
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
        $this->db->deleteMob($userId);
       // print_r("1");
        $this->logic->killMob($userId);
      //  print_r("2");
        // создать нового моба
        $this->logic->addMob($userId);//внутри добавить моба в структуру
      //  print_r("3");
        // добавить моба в БД
        foreach ($this->struct->mobs as $mob) {
            $this->db->addMob($mob);
         //   print_r("4");
        }

        return true;
    }

    private function addShot($userId){/*
        // удалить все старые выстрелы пользователя из БД (и из структуры)
        $this->db->deleteShot($userId);
        $this->struct->deleteShot($this->db->getShotByUserId($userId));
        // создать новый выстрел
        $options = new StdClass();
        $options = $this->struct->addShot($userId);
        // добавить выстрел в структуру
        $this->struct->setShots($options);        
        // добавить выстрел в БД
        $this->db->setShot($options);
        return true;*/
    }

    public function getCommand() {
        return $this->input->getCommand();
    }

    public function executeCommand($name, $options = null) {
        $COMMANDS = $this->input->getCommand();
        switch ($name) {
            case $COMMANDS->ADD_TOWER: return $this->addTower($options->userId);
            case $COMMANDS->ADD_MOB  : return $this->addMob  ($options->userId);
            case $COMMANDS->SHOTING  : return $this->addShot ($options->userId);
        }
        return $this->input->executeCommand($name, $options);
    }

    public function getStruct() {
        return $this->struct;
        print_r($this->struct);
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
                $this->db->updateTowers($mapId, $this->struct->towers);
                // записать города
                $this->db->updateMobs($mapId, $this->struct->mobs);
                // записать выстрелы
                $this->db->updateShots($mapId, $this->struct->shots);
                return true;
            }
        }
        return false;
    }
}