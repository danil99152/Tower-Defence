<?php

require_once '..\Application\Game\Game.php';

class Router {

    private $game;

    public function __construct() {
        $options = new stdClass();
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
        $this->game = new Game($options);
    }

    private function good($data) {
        return (object) [
            'result' => true,
            'data' => $data
        ];
    }

    private function bad($text) {
        return (object) [
            'result' => false,
            'error' => $text
        ];
    }

    public function answer($options) {
        $method = $options->method;
        if ($method) {
            if ($method === 'getStruct') {
                return $this->good($this->game->getStruct());
            }
            $COMMAND = $this->game->getCommand();
            foreach ($COMMAND as $command) {
                if ($method === $command) {
                    unset($options->method);
                    if ($this->game->executeCommand($command, $options)) {
                        return $this->good($this->game->getStruct());
                    } else {
                        return $this->bad('fail to execute command ' . $method);
                    }
                }
            }
            return $this->bad('game has no have method ' . $method);
        }
        return $this->bad('has no method');
    }
}