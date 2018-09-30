<?php
error_reporting(1);

require_once 'Game\Game.php';

$options = new stdClass();

$options->map = [
    [
        (object) array('id' => 1, 'type' => 'mount', 'passability' => 0),
        (object) array('id' => 2, 'type' => 'grass', 'passability' => 1)
    ],
    [
        (object) array('id' => 1, 'type' => 'grass', 'passability' => 1),
        (object) array('id' => 2, 'type' => 'mount', 'passability' => 0)
    ]
];

$options->towers = [
    (object) array('id' => 1, 'gamerId' => 2, 'x' => 1, 'y' => 1, 'damage' => 123)
];

$options->mobs = [
    (object) array('id' => 1, 'gamerId' => 1, 'x' => 0, 'y' => 0, 'life' => 1500,'speed' => 1)
];

$options->shots = [
    (object) array('id' => 1, 'gamerId' => 2, 'x' => 1, 'y' => 1, 'speed' => 1)
];

$game = new Game($options);

print_r($game);
