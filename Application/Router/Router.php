<?php

require_once '..\Application\Modules\DB.php';
require_once '..\Application\Modules\User.php';
require_once '..\Application\Game\Game.php';

class Router {

    private $db;
    private $user;
    private $game;

    public function __construct() {
        $this->db = new DB();
        $this->user = new User($this->db);
        $this->game = new Game($this->db);
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
            if ($method === 'login') {
                $result = $this->user->login($options);
                return ($result) ? $this->good($result) : $this->bad('authorization fail');
            }
            if ($method === 'logout') {
                $result = $this->user->logout($options);
                return ($result) ? $this->good($result) : $this->bad('logout fail');
            }
            $userId = $this->user->checkToken($options);
            //$userId = true;
            if ($userId) {
                $options->userId = $userId;
                $this->game->init(1);
                if ($method === 'getStruct') {
                    return $this->good($this->game->getStruct());
                }
                $COMMAND = $this->game->getCommand();
                foreach ($COMMAND as $command) {
                    if ($method === $command) {
                        unset($options->method);
                        if ($this->game->executeCommand($command, $options)) {
                            $this->game->update(1);
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