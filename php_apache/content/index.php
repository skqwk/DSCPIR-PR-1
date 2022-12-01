<?php
session_start();
if(array_key_exists('switch', $_POST)) {
    switchTheme();
} else if (array_key_exists('setname', $_POST)) {
    setName($_POST['username']);
} else if (array_key_exists('icon', $_POST)) {
    setIcon($_POST['icon']);
}

function switchTheme() {
        if (!isset($_COOKIE["theme"])) {
            setcookie("theme", "dark");
        } else if ($_COOKIE["theme"] === "dark") {
            unset($_COOKIE['theme']); 
            setcookie("theme", "light");
        } else if ($_COOKIE["theme"] === "light") {
            unset($_COOKIE['theme']); 
            setcookie("theme", "dark");
        } else {
            unset($_COOKIE['theme']); 
        }
        HEADER('Location: index.php');
}

function setName($name) {
    if (isset($_COOKIE["name"])) {
        unset($_COOKIE["name"]);
    }
    setcookie("name", $name);
    HEADER('Location: index.php');
}

function setIcon($icon) {
    if (isset($_COOKIE["icon"])) {
        unset($_COOKIE["icon"]);
    }
    setcookie("icon", $icon);
    HEADER('Location: index.php');
}

?>
<head>
<title><?php echo (isset($_COOKIE['name'])) ? $_COOKIE['name'] : "User" ?> Page</title>
    <?php include 'theme.php';?>
</head>
<body class="wrapper">
<h1><?php echo (isset($_COOKIE['name'])) ? $_COOKIE['name'] : "User" ?> Profile</h1>
<ul>
                <a href="/about.html">About</a>
                <a href="/index.html">Main</a>
                <a href="weather.php">Weather</a>
                <a href="documents.php">Documents</a>
                <a href="faker/stats.php">Stats</a>
</ul>

<table>
    <tr><th>Id</th><th>Login</th></tr>
<?php

include_once "boot.php";



$stmt = db()->prepare("SELECT * FROM account WHERE login = ?");
$stmt->bind_param("s", $_SERVER['PHP_AUTH_USER']);
$stmt->execute();
$result = $stmt->get_result();

foreach ($result as $row){
    echo "<tr><td>{$row['id']}</td><td>{$row['login']}</td></tr>";
}
?>
</table>

<hr>
<form method="post">
<input type="submit" name="switch"
                class="button" value="Theme switch" />
</form>

<form method="post">
<input type="text" name="username" value="<?php echo (isset($_COOKIE['name'])) ? $_COOKIE['name'] : "" ?>"/>
<input type="submit" name="setname"
                class="button" value="Set name" />
</form>

<form method="post">
<label for="selected-favicon">Select weather</label>
<select name="icon" id="selected-favicon">
  <option value="cloud.png">Cloud</option>
  <option value="sun.png">Sun</option>
  <option value="snow.png">Snow</option>
  <option value="rain.png">Rain</option>
</select>
<input type="submit" value="Set icon">
</form>

<br>
<br>
<br>
<form method="post" action="./do_logout.php">
    <button type="submit" class="btn btn-primary">Logout</button>
</form>
</body>
</html>