<?php

class Logic {

    private $struct;

    public function __construct($struct) {
        $this->struct = $struct;
    }

    private function getMob($id){
        if ($id){
            $mobs = $this->struct->mobs;
            foreach ($mobs as $mob){
                if ($mob->id === $id){
                    return $mob;
                }
            }
        }
        return null;
    }

    // добавить нового моба
    public function addMob($gamerId) {
        $map = $this->struct->map;
        $mobs = $this->struct->mobs;
        // проверить, что место для моба ещё имеется
        $passCount = 0;
        foreach ($map as $line) {
            foreach ($line as $tile) {
                if ($tile->passability == 1) {
                    $passCount++;
                }
            }
        }
        if ($passCount > count($mobs)) { // место для моба ещё есть
            while (true) {
                $y = rand(4, 5);
                $x = rand(4, 6);
                if ($map[$x][$y]->passability == 1) {
                    $canAdd = true;
                    foreach ($mobs as $mob) {
                        if ($mob->x == $x && $mob->y == $y) {
                            $canAdd = false;
                            break;
                        }
                    }
                    if ($canAdd) {
                        $this->struct->addMob(
                            (object) array(
                                'gamerId' => $gamerId,
                                'x' => $x,
                                'y' => $y)
                        );
                        return false;
                    }
                }
            }
        }
        return false;
    }

    // умереть моба
    public function killMob($id) {
        $mob = $this->getMob($id);
        if ($mob) {
            foreach ($this->struct->mobs as $key => $mob) {
                if ($mob->id === $id) {
                    unset($this->struct->mobs[$key]);
                    return true;
                }
            }
        }
        return false;
    }

    // дойти мобом до точки выхода
    public function finishMob($options) {
        $id = intval($options->id);
        $mob = $this->getMob($id);
        if ($mob) {
            //todo допилить финишмоба
        }
    }

    // можно ли ходить
    public function canMove($x, $y)
    {
        $map = $this->struct->map;
        if ($map[$x][$y]->passability == 1) {
            return true;
        }
        return false;
    }

    // подвинуть моба на 1 клетку
    public function moveMob($move, $id) {
        $mapHeight  = count($this->struct->map)-1;
        $mapWidth = count($this->struct->map[0])-1;
        $mob = $this->getMob($id);
        $x = $mob->x;
        $y = $mob->y;
        if ($mob && $move) {
            switch ($move) {
                case 37: $x--; break;
                case 38: $y--; break;
                case 39: $x++; break;
                case 40: $y++; break;
            }
            if ($x <= $mapWidth && $x >= 0 && $y <= $mapHeight && $y >= 0){
                if ($this->canMove($x, $y)) {
                    $mob->x = $x;
                    $mob->y = $y;
                    return true;
                }
            } else {
                $this->killMob($id);
                //$this->finishMob();
            }
        }
        return false;
	}

    private function getTower($id) {
        if ($id) {
            $towers = $this->struct->towers;
            foreach ($towers as $tower) {
                if ($tower->id === $id) {
                    return $tower;
                }
            }
        }
        return null;
    }

    // добавить башню
    public function addTower($gamerId) {
        $map = $this->struct->map;
        $towers = $this->struct->towers;
        // проверить, что место для башни ещё имеется
        $passCount = 0;
        foreach ($map as $line) {
            foreach ($line as $tile) {
                if ($tile->passability == 0) {
                    $passCount++;
                }
            }
        }
        if ($passCount > count($towers)) { // место для башни ещё есть
            while (true) {
                $y = rand(0, count($map)-1);
                $x = rand(0, count($map[0])-1);
                if ($map[$x][$y]->passability == 0) {
                    $canAdd = true;
                    foreach ($towers as $tower) {
                        if ($tower->x == $x && $tower->y == $y) {
                            $canAdd = false;
                            break;
                        }
                    }
                    if ($canAdd) {
                        $this->struct->addTower(
                            (object) array(
                                'gamerId' => $gamerId,
                                'x' => $x,
                                'y' => $y)
                        );
                        return false;
                    }
                }
            }
        }
        return false;
    }

    public function rotateTower($change, $id) {
        $tower = $this->getTower($id);
        $angle = $tower->angle;
        if ($tower && $change) {
            switch ($change) {
                case 37: $angle += 45; break;
                case 39: $angle -= 45; break;
            }
            if($angle < 0) $angle = 360 + $angle;
            if($angle > 350) $angle = 0;
            $tower->angle = $angle;
            return true;
        }
        return false;
    }

    // удалить башню
    public function delTower($id) {
        $tower = $this->getTower($id);
        if ($tower) {
            foreach ($this->struct->towers as $key => $tower) {
                if ($tower->id === $id) {
                    unset($this->struct->towers[$key]);
                    return true;
                }
            }
        }
        return false;
    }

    private function getShot($id){
        if ($id){
            $shots = $this->struct->shots;
            foreach ($shots as $shot){
                if ($shot->id === $id){
                    return $shot;
                }
            }
        }
        return null;
    }

    // выстрелить башней
    public function shoting($id) {
        $tower = $this->getTower($id);
        if($tower) {
            $this->struct->addShot($tower);
            return true;
        }
        return false;
    }

    // лететь выстрелом
    public function shoot($id, $angle){
        if($id) {
            $shot = $this->getShot($id);
            $mapHeight  = count($this->struct->map)-1;
            $mapWidth = count($this->struct->map[0])-1;
            $x = $shot->x;
            $y = $shot->y;
            if($x <= $mapWidth && $x >= 0 && $y <= $mapHeight && $y >= 0) {
                if($angle >= 0 && $angle <= 180) {//правая сторона
                    if($angle >= 0 && $angle <= 90) {//верхняя часть
                        switch ($angle) {
                            case 0: $y--; break;
                            case 90: $x++; break;
                            default:
                                $x++;
                                $y--;
                            break;
                        }
                    } else {//нижняя часть
                        switch ($angle) {
                            case 180: $y++; break;
                            default:
                                $x++;
                                $y++;
                            break;
                        }
                    }
                } else {//левая сторона
                    if($angle >= 270 && $angle < 360) {//верхняя часть
                        switch ($angle) {
                            case 270: $x--; break;
                            default:
                                $x--;
                                $y--;
                            break;
                        }
                    } else {//нижняя часть
                        $x--;
                        $y++;
                    }
                }
                $shot->x = $x;
                $shot->y = $y;

                return true;
            }
        } else {
            $this->delShot($id);
        }
        return false;
    }

    public function delShot($id){
        $shot = $this->getShot($id);
        if ($shot) {
            foreach ($this->struct->shots as $key => $shot) {
                if ($shot->id === $id) {
                    unset($this->struct->shots[$key]);
                    return true;
                }
            }
        }
        return false;
    }

    // попасть выстрелом
    public function hit($options)
    {
        if ($options) {
            $mob = $this->getMob($options->id);
            $shot= $this->getShot($options->id);
            if ($mob->x == $shot->x && $mob->y == $shot->y){
                $this->delShot($options->id);
                $this->killMob($options->id);
                return true;
            }
            else {
                $this->shoot($options->id);
                return true;
            }
        }
    }

    // нанести какой-нибудь урон
    public function damage($options){
        if ($options){
            $mob = $this->getMob($options->id);
            if ($mob) {
                $mob->life = $options->life - 1;
                return true;
            }
        }
        return false;
    }
}