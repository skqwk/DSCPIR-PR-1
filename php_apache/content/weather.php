<html lang="en">
<head>
<title>User Weather Report</title>
    <link rel="stylesheet" href="style.css" type="text/css"/>
</head>
<body class="wrapper">
<h1>User Weather Report</h1>
<ul>
                <a href="/about.html">About</a>
                <a href="/index.html">Main</a>
                <a href="/control/user/index.php">Profile</a>
</ul>

<table>
    <tr><th>Id</th><th>Temperature</th><th>Pressure</th><th>Timestamp</th><th>Wind speed</th></tr>
    <?php
include_once "boot.php";

$stmt = db()->prepare("SELECT * from 
(select W.id, timestamp, temperature, wind_speed, pressure, login 
from weather_report W inner join account A on A.id = W.user_id) J 
                      where login = ?");
$stmt->bind_param("s", $_SERVER['PHP_AUTH_USER']);
$stmt->execute();
$result = $stmt->get_result();

foreach ($result as $row){
    echo "<tr><td>{$row['id']}</td><td>{$row['temperature']}</td><td>{$row['pressure']}</td><td>{$row['timestamp']}</td><td>{$row['wind_speed']}</td></tr>";
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