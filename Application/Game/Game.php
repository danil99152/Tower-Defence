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

        /*$options = new stdClass();
        $options->map = [
            [
                (object) array('id' => 1, 'type' => 'mount', 'passability' => 0),
                (object) array('id' => 2, 'type' => 'grass', 'passability' => 1),
                (object) array('id' => 1, 'type' => 'grass', 'passability' => 1)
            ],
            [
                (object) array('id' => 1, 'type' => 'grass', 'passability' => 1),
                (object) array('id' => 2, 'type' => 'mount', 'passability' => 0),
                (object) array('id' => 1, 'type' => 'grass', 'passability' => 1)
            ],
            [
                (object) array('id' => 1, 'type' => 'grass', 'passability' => 1),
                (object) array('id' => 1, 'type' => 'grass', 'passability' => 1),
                (object) array('id' => 2, 'type' => 'mount', 'passability' => 0)
            ]
        ];
        $options->towers = [
            (object) array('id' => 1, 'gamerId' => 2, 'x' => 1, 'y' => 1, 'damage' => 123,'speed' => 0)
        ];
        $options->mobs = [
            (object) array('id' => 1, 'gamerId' => 1, 'x' => 0, 'y' => 0, 'life' => 1500,'speed' => 1)
        ];
        $options->shots = [
            //(object) array('id' => 1, 'gamerId' => 2, 'x' => 1, 'y' => 1, 'speed' => 1)
        ];
*/

        $this->struct = new Struct();
        $this->logic  = new Logic($this->struct);
        $this->input  = new Input($this->logic);
    }

    public function getCommand() {
        return $this->input->getCommand();
    }

    public function executeCommand($name, $options = null) {
        return $this->input->executeCommand($name, $options);
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

    public function update() {

    }
}