<html lang="en">
<head>
<title>Admin Panel</title>
<link rel="stylesheet" href="style.css" type="text/css"/>
</head>
<body class="wrapper">
        <h1>
            Admin Panel
        </h1><br>
<?php
 include 'admin.php';
 
 $commands = array("hostname", "ls", "ps", "whoami", "id", "date");
 
 show_admin_info($commands)
 
 ?>
</body>
</html>