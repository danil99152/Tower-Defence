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
    public  function addTower($user_id){
        $query = 'INSERT INTO tower (user_id) VALUES ("'.$user_id.'") ';
        return $this->db->query($query)->fetchObject('stdClass');
    }
    public  function  deleteTower($user_id){
        $query = 'DELETE FROM tower WHERE  user_id = "'.$user_id.'" ';
        return $this->db->query($query)->fetchObject('stdClass');
    }
    public function addMob ($user_id){
        $query = 'INSERT INTO mob (user_id) VALUES ("'.$user_id.'") ';
        return $this->db->query($query)->fetchObject('stdClass');
    }
    public  function  deleteMob($user_id){
        $query = 'DELETE FROM mob WHERE  user_id = "'.$user_id.'" ';
        return $this->db->query($query)->fetchObject('stdClass');
    }
}