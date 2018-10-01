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
                if ($tower->id === $id) {
                    return $tower;
                }
            }
        }
        return null;
    }

    // добавить нового моба
    // умереть моба
    // дойти мобом до точки выхода
    // подвинуть моба на 1 клетку

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

    // повернуть башню на угол
    public function rotateTower($id = null, $angle = 0) {
        $tower = $this->getTower($id);
        if ($tower) {
            $tower->angle = $angle;
            return true;
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
    // попасть выстрелом
    // нанести какой-нибудь урон
}