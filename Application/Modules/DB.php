<?php

class DB {

    private $db;

    public function __construct() {
        $host = 'localhost';
        $dbName = 'tower_of_is';
        $user = 'root';
        $password = '';
        $this->db = new PDO('mysql:host='.$host.';dbname=' . $dbName, $user, $password);
    }

    public function getUser($login, $password) {
        $query = 'SELECT * FROM user WHERE login="' . $login . '" AND password="' . $password . '"';
        return $this->db->query($query)->fetchObject('stdClass');
    }

    public function getUserByToken($token) {
        $query = 'SELECT * FROM user WHERE token="' . $token . '"';
        return $this->db->query($query)->fetchObject('stdClass');
    }

    public function updateUserToken($id, $token) {
        $query = 'UPDATE user SET token="' . $token . '" WHERE id=' . $id;
        return (bool) $this->db->query($query);
    }

	public function getUsers() {
        $query = 'SELECT * FROM user';
        return $this->db->query($query)->fetchAll(PDO::FETCH_CLASS);
    }

    public function getMap($id) {
        $query = 'SELECT * FROM map WHERE id=' . $id;
        return $this->db->query($query)->fetchObject('stdClass');
    }

    public function getTiles($id) {
        $query = 'SELECT * FROM tile WHERE map_id=' . $id;
        return $this->db->query($query)->fetchAll(PDO::FETCH_CLASS);
    }

    public function getMobs() {
        $query = 'SELECT * FROM mob';
        return $this->db->query($query)->fetchAll(PDO::FETCH_CLASS);
    }

    public function getTowers() {
        $query = 'SELECT * FROM tower';
        return $this->db->query($query)->fetchAll(PDO::FETCH_CLASS);
    }

    public function getShots() {
        $query = 'SELECT * FROM shot';
        return $this->db->query($query)->fetchAll(PDO::FETCH_CLASS);
    }

    public function getTowerByUserId($user_id) {
        $query = 'SELECT * FROM tower WHERE user_id="' . $user_id . '"';
        return $this->db->query($query)->fetchObject('stdClass');
    }

    public function getTowerByToken($token){
        $query = 'SELECT id FROM user WHERE token="' . $token . '"';
        $user_id = $this->db->query($query)->fetchObject('stdClass');
        return $this->getTowerByUserId($user_id);
    }

    public function getMobByUserId($user_id) {
        $query = 'SELECT * FROM mob WHERE user_id="' . $user_id . '"';
        return $this->db->query($query)->fetchObject('stdClass');
    }

    public function getMobByToken($token){
        $query = 'SELECT id FROM user WHERE token="' . $token . '"';
        $user_id = $this->db->query($query)->fetchObject('stdClass');
        return $this->getMobByUserId($user_id);
    }

    public function getShotByUserId($user_id) {
        $query = 'SELECT * FROM shot WHERE user_id="' . $user_id . '"';
        return $this->db->query($query)->fetchObject('stdClass');
    }

    public function addTower($options){
        //print_r($options);
        $query = 'INSERT INTO tower (user_id, damage, x, y, angle, type) VALUES (
            '.$options->gamerId.',
            '.$options->damage.',
            '.$options->x.',
            '.$options->y.',
            '.$options->angle.',
            '.$options->type.'
        ) ';
        return $this->db->query($query);
    }

    public function  deleteTower($user_id){
        $query = 'DELETE FROM tower WHERE  user_id= "'.$user_id.'" ';
        return $this->db->query($query);
    }

    public function addMob ($options){
        $query = 'INSERT INTO mob (user_id, life, x, y, speed, type) VALUES (
            '.$options->gamerId.',
            '.$options->life.',
            '.$options->x.',
            '.$options->y.',
            '.$options->speed.',
            '.$options->type.'
        )';
        return $this->db->query($query);
    }

    public function deleteMob($user_id){
        $query = 'DELETE FROM mob WHERE  user_id= "'.$user_id.'" ';
        return $this->db->query($query);
    }

    public function addShot ($shot){
        $query = 'INSERT INTO shot (angle, x, y, speed, user_id, tower_id, status, type) VALUES (
            ' . $shot->angle . ',
            ' . $shot->x . ',
            ' . $shot->y . ',
            ' . $shot->speed . ',
            ' . $shot->gamerId . ',
            ' . $shot->towerId . ',
            ' . $shot->status . ',
            ' . $shot->type . '
        )';
        return $this->db->query($query);
    }

    public function deleteShot($user_id){
        $query = 'DELETE FROM shot WHERE  user_id= "'.$user_id.'" ';
        return $this->db->query($query)->fetchObject('stdClass');
    }

    public function updateTowers($tower){
        $query = 'UPDATE tower SET angle="' . $tower->angle . '" WHERE user_id=' . $tower->gamerId;
        return $this->db->query($query);
    }

    public function updateMobs($mob){
        $query = 'UPDATE mob SET
            life = ' . $mob->life . ',
            x = ' . $mob->x . ',
            y = ' . $mob->y . '
            WHERE user_id=' . $mob->gamerId;
        return $this->db->query($query);
    }

    public function updateShots($shot){
        $query = 'UPDATE shot SET
            angle = ' . $shot->angle . ',
            status = ' . $shot->status . ',
            x = ' . $shot->x . ',
            y = ' . $shot->y . '
            WHERE tower_id=' . $shot->towerId;
        return $this->db->query($query);
    }
}