<?php

require_once '..\Application\Modules\DB.php';
require_once '..\Application\Modules\User.php';
require_once '..\Application\Game\Game.php';

class Router {

    private $db;
    private $user;
    private $game;

    public function __construct() {
<<<<<<< HEAD
        $this->db = new DB();
        $this->user = new User($this->db);
        $this->game = new Game($this->db);
=======
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

        $this->db = new DB();
        $this->user = new User($this->db);
        $this->game = new Game($options);
>>>>>>> a708a937b73539abead501b7a1ff3968627b57ff
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
<<<<<<< HEAD
=======

>>>>>>> a708a937b73539abead501b7a1ff3968627b57ff
            if ($method === 'login') {
                $result = $this->user->login($options);
                return ($result) ? $this->good($result) : $this->bad('authorization fail');
            }
<<<<<<< HEAD
            if ($method === 'logout') {
                $result = $this->user->logout($options);
                return ($result) ? $this->good($result) : $this->bad('logout fail');
=======

            if ($method === 'logout') {
                $result = $this->user->logout($options);
                return ($result) ? $this->good($result) : $this->bad('logout fail');
            }

            if ($method === 'getStruct') {
                return $this->good($this->game->getStruct());
>>>>>>> a708a937b73539abead501b7a1ff3968627b57ff
            }
            $userId = $this->user->checkToken($options);
            //$userId = true;
            if ($userId) {
                $this->game->init();
                if ($method === 'getStruct') {
                    return $this->good($this->game->getStruct());
                }
                $COMMAND = $this->game->getCommand();
                foreach ($COMMAND as $command) {
                    if ($method === $command) {
                        unset($options->method);
                        if ($this->game->executeCommand($command, $options)) {
                            $this->game->update();
                            return $this->good($this->game->getStruct());
                        } else {
                            return $this->bad('fail to execute command ' . $method);
                        }
                    }
                }
                return $this->bad('game has no have method ' . $method);
            }
            return $this->bad('invalid token');
        }
        return $this->bad('has no method');
    }
}