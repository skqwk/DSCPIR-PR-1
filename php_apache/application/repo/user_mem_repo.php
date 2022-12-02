<?php

include_once 'user_repo.php';

class UserMemRepoImpl implements UserRepo {

    public function findByLogin($login) {
        return array(
            array(
            "id" => 200,
            "login" => $login
        ));
    }
}
?>