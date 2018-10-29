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

<<<<<<< HEAD
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
=======
    public function updateUserToken($id, $token) {
        $query = 'UPDATE user SET token="' . $token . '" WHERE id=' . $id;
        return $this->db->query($query);
    }

>>>>>>> 117f5ac3e0306a2fa148f904e3067e860101d9ee
}