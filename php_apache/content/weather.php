<html lang="en">
<head>
<title><?php echo (isset($_COOKIE['name'])) ? $_COOKIE['name'] : "User" ?> Weather Report</title>
    <?php include 'theme.php';?>
</head>
<body class="wrapper">
<h1><?php echo (isset($_COOKIE['name'])) ? $_COOKIE['name'] : "User" ?> Weather Report</h1>
<ul>
                <a href="/about.html">About</a>
                <a href="/index.html">Main</a>
                <a href="index.php">Profile</a>
                <a href="documents.php">Documents</a>
</ul>

<table>
    <tr><th>Id</th><th>Temperature</th><th>Pressure</th><th>Timestamp</th><th>Wind speed</th></tr>
    <?php

include_once "boot.php";

$query = "select id, timestamp, temperature, wind_speed, pressure from weather_report;";

$result = db()->query($query);
foreach ($result as $row){
    echo "<tr>
        <td>{$row['id']}</td>
        <td>{$row['temperature']}</td>
        <td>{$row['pressure']}</td>
        <td>{$row['timestamp']}</td>
        <td>{$row['wind_speed']}</td>
    </tr>";
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