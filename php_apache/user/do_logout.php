<?php


setcookie("auth", "no", time() - 3600, "/control");
header('Location: /login.html');
die;


?>