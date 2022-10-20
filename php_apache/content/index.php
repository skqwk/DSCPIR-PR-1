<head>
<title>User Page</title>
    <link rel="stylesheet" href="style.css" type="text/css"/>
</head>
<body class="wrapper">
<h1>User Profile</h1>
<ul>
                <a href="/about.html">About</a>
                <a href="/index.html">Main</a>
                <a href="weather.php">Weather</a>
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
<br>
<br>
<br>
<form method="post" action="./do_logout.php">
    <button type="submit" class="btn btn-primary">Logout</button>
</form>
</body>
</html>