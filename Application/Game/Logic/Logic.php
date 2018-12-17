<?php

class Logic {

    private $struct;

    public function __construct($struct) {
        $this->struct = $struct;
    }

    private function getTower($id) {
        if ($id) {
            $towers = $this->struct->towers;
            foreach ($towers as $tower) {
                if ($tower->id === $id - 0) {
                    return $tower;
                }
            }
        }
        return null;
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
                if ($tile->passability === 1) {
                    $passCount++;
                }
            }
        }
        if ($passCount > count($mobs)) { // место для мода ещё есть
            while (true) {
                $y = rand(0, count($map)-1);
                $x = rand(0, count($map[0])-1);
                if ($map[$y][$x]->passability === 0) {
                    $canAdd = true;
                    foreach ($mobs as $mob) {
                        if ($mob->x === $x && $mob->y === $y) {
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
                        return true;
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


    // подвинуть моба на 1 клетку
    public function moveMob($options)
    {
        //мобы двигаться
    }



    // добавить башню
    public function addTower($gamerId) {
        $map = $this->struct->map;
        $towers = $this->struct->towers;
        // проверить, что место для башни ещё имеется
        $passCount = 0;
        foreach ($map as $line) {
            foreach ($line as $tile) {
                if ($tile->passability === 0) {
                    $passCount++;
                }
            }
        }
        if ($passCount > count($towers)) { // место для башни ещё есть
            while (true) {
                $y = rand(0, count($map)-1);
                $x = rand(0, count($map[0])-1);
                if ($map[$y][$x]->passability === 0) {
                    $canAdd = true;
                    foreach ($towers as $tower) {
                        if ($tower->x === $x && $tower->y === $y) {
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
                        return true;
                    }
                }
            }
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

    // выстрелить башней
    public function shoting($id) {
        $tower = $this->getTower($id);
        if ($tower) {
            $this->struct->addShot((object) $tower);
            return true;
        }
        return false;
    }

    // лететь выстрелом
  /*  public function shoot($id){
        $mob = $this->getMob($id);
        if ($mob){
            $this->damage($id)->$mob($id);
            return true;
        }
        return false;
    }
  */

    // повернуть башню на угол
    public function rotateTower($options) {
        if ($options) {
            $tower = $this->getTower($options->id);
            if ($tower) {
                $tower->angle = $options->angle;
                return true;
            }
        }
        return false;
    }

    // попасть выстрелом
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
