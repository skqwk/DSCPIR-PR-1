<?php
include_once '../application/config/config.php';
include_once '../application/core/model.php';
class IndexModel extends Model {


    private UserRepo $userRepo;

    public function __construct() {
        $this->userRepo = userRepo();
    }


    public function get_data() {
        $login = $_SERVER['PHP_AUTH_USER'];
        $user = $this->userRepo->findByLogin($login);
        return $user;
    }

    public function get_icons() {
        $icons = array("cloud", "sun", "snow", "rain");
        $result = array();
        foreach($icons as $icon) {
            $result[] = array(
                "file" => $icon . ".png",
                "name" => ucfirst($icon)
            );
        }
        return $result;
    }

    public function update_cookies() {
        if(array_key_exists('switch', $_POST)) {
            $this->switchTheme();
        } else if (array_key_exists('setname', $_POST)) {
            $this->setName($_POST['username']);
        } else if (array_key_exists('icon', $_POST)) {
            $this->setIcon($_POST['icon']);
        }

    }

            
    function switchTheme() {
            if (!isset($_COOKIE["theme"])) {
                setcookie("theme", "dark", time()+3600 , '/');
            } else if ($_COOKIE["theme"] === "dark") {
                unset($_COOKIE['theme']); 
                setcookie("theme", "light", time()+3600 , '/');
            } else if ($_COOKIE["theme"] === "light") {
                unset($_COOKIE['theme']); 
                setcookie("theme", "dark", time()+3600 , '/');
            } else {
                unset($_COOKIE['theme']); 
            }
    }

        function setName($name) {
            if (isset($_COOKIE["name"])) {
                unset($_COOKIE["name"]);
            }
            setcookie("name", $name, time()+3600 , '/');
        }

        function setIcon($icon) {
            if (isset($_COOKIE["icon"])) {
                unset($_COOKIE["icon"]);
            }
            setcookie("icon", $icon, time()+3600 , '/');
        }


}
?>