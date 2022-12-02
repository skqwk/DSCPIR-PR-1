<?php

include_once 'user_repo.php';

class UserDBRepoImpl implements UserRepo {

    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function findByLogin($login) {
        $stmt = $db->prepare("SELECT * FROM account WHERE login = ?");
        $stmt->bind_param("s", $login);
        $stmt->execute();
        $result = $stmt->get_result();
    }
}
?>