<html lang="en">
<head>
<title>Hello world page</title>
    <link rel="stylesheet" href="style.css" type="text/css"/>
</head>
<body class="wrapper">
<h1>User Profile</h1>
<ul>
                <a href="/about.html">About</a>
                <a href="/index.html">Main</a>
                <a href="/control/user/weather.php">Weather</a>
</ul>

<table>
    <tr><th>Id</th><th>Login</th><th>Password</th></tr>
<?php
include_once "boot.php";

$stmt = db()->prepare("SELECT * FROM user WHERE id = ?");
$stmt->bind_param("s", $_COOKIE['user']);
$stmt->execute();
$result = $stmt->get_result();

foreach ($result as $row){
    echo "<tr><td>{$row['id']}</td><td>{$row['login']}</td><td>{$row['password']}</td></tr>";
}
?>
</table>
<br>
<br>
<br>
<form method="post" action="./do_logout.php">
    <button type="submit" class="btn btn-primary">Logout</button>
</form>
</body>
</html>