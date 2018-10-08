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

    public function answer($options) {
        $method = $options->method;
        if ($method) {
            $COMMAND = $this->game->getCommand();
            foreach ($COMMAND as $command) {
                if ($method === $command) {
                    unset($options->method);
                    return $this->game->executeCommand($command, $options);
                }
            }
            return 'game has no have method ' . $method;
        }
        return 'has no method';
    }
}