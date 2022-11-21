<head>
<title><?php echo (isset($_COOKIE['name'])) ? $_COOKIE['name'] : "User" ?> Documents</title>
    <?php include 'theme.php';?>
</head>
<body class="wrapper">
<h1><?php echo (isset($_COOKIE['name'])) ? $_COOKIE['name'] : "User" ?> Documents</h1>
<ul>
                <a href="/about.html">About</a>
                <a href="/index.html">Main</a>
                <a href="index.php">Profile</a>
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
$login = $_SERVER['PHP_AUTH_USER'];
foreach ($result as $row){
    echo "<tr><td>{$row['id']}</td><td>{$row['login']}</td></tr>";
}
echo "</table>";

if(!s3()->doesBucketExist($login)) {
    s3()->createBucket(array(
        'ACL' => 'public-read',
        'Bucket' => $login 
    ));
}



echo "<br><div>Files in your bucket:</div>";
$results = s3()->getPaginator('ListObjects', [
    'Bucket' => $login
]);

foreach ($results as $result) {
    if (!is_null($result['Contents'])) {
        echo "<table>";
        echo  "<tr><th>Filename</th><th>Date</th></tr>";
        foreach ($result['Contents'] as $object) {
                    echo "<tr><td><a class='card-body' href='".
                    "http://localhost:".getenv("MINIO_SERVER_PORT")."/".$login."/".$object['Key']."'>".
                    $object['Key'].
                    "</a></td>"."<td>".$object['LastModified']."</td>";
                    //echo $object['Key'] . " " . $object['Size'] . "\n";
            }
        echo "</table>";
        } else {
            echo 'Your bucket is empty';
        }
}



?>
<br>
<br>
<br>
<form enctype="multipart/form-data" action="loader.php" method="POST">
    <div>
    <input type="hidden" name="MAX_FILE_SIZE" value="2000000"/>
    <input class="custom-file-input" id="file_field" name="fileToUpload" type="file" value="Upload"/>
    </div>
    <br>
    <input class="btn btn-primary" type="submit" value="Send file"/>
</form>
</body>
</html>