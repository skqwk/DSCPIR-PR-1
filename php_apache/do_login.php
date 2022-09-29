<?php

include_once 'user/boot.php';

// проверяем наличие пользователя с указанным юзернеймом
$stmt = db()->prepare("SELECT * FROM user WHERE login = ?");
$stmt->bind_param("s", $_POST['login']);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows < 1) {
    flash('Пользователь с такими данными не зарегистрирован');
    header('Location: /login.html');
    die;
}

$user = $result->fetch_assoc();
// проверяем пароль
if ($_POST['password'] === $user['password']) {
    setcookie("auth", "yes");
    setcookie("user", $user['id']);
    $_SESSION['user_id'] = $user['id'];
    header('Location: /control/user/index.php');
    die;
}

flash('Пароль неверен');
header('Location: /login.html');