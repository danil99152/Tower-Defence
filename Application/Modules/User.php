<?php

class User {

    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function login($options = null) {
        if ($options && isset($options->login) && isset($options->password)) {
            $user = $this->db->getUser($options->login, $options->password);
            if ($user) {
                $token = md5($user->login . rand(0, 50000));
                $this->db->updateUserToken($user->id, $token);
                return $token;
            }
        }
        return false;
    }
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 4417a0fdc068f54311761b911d24b6a252f37bc3

    public function logout($options = null) {
        if ($options && isset($options->token)) {
            $user = $this->db->getUserByToken($options->token);
            if ($user) {
                return $this->db->updateUserToken($user->id, '');
            }
        }
        return false;
    }
<<<<<<< HEAD
=======
=======
>>>>>>> 117f5ac3e0306a2fa148f904e3067e860101d9ee
>>>>>>> 4417a0fdc068f54311761b911d24b6a252f37bc3
}