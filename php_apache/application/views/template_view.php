<html>
<head>
<?php
    $page_title = ((isset($_COOKIE['name'])) ? $_COOKIE['name'] : "User") . " " . $title;
    $routes = array(
        array(
            "title" => "About",
            "href" => "/about.html"
        ),
        array(
            "title" => "Main",
            "href" => "/about.html"
        ),
        array(
            "title" => "Weather",
            "href" => "weather"
        ),
        array(
            "title" => "Documents",
            "href" => "documents"
        ),
        array(
            "title" => "Stats",
            "href" => "stats"
        ),
        array(
            "title" => "Profile",
            "href" => "/control/content/"
        )

    );

?>
<title><?php echo $page_title?></title>
<link rel="stylesheet" href="../css/style.css" type="text/css"/>
<link rel="stylesheet" href="../css/<?php echo (isset($_COOKIE['theme'])) ? $_COOKIE['theme'].'-style.css' : 'light-style.css'; ?>" type="text/css">
<link rel="icon" type="image/x-icon" href="../icon/<?php echo (isset($_COOKIE['icon']) ? $_COOKIE['icon'] : 'cloud.png')?>">
</head>
<body class="wrapper">
<h1><?php echo $page_title?></h1>
<ul>
    <?php
        foreach($routes as $route) {
            if ($route['title'] != $title) {
                echo "<a href=\"{$route['href']}\">{$route['title']}</a>";
            }
        }
    ?>
</ul>
<?php include '../application/views/'.$content_view; ?>
<br>
<br>
<br>
<!-- <form method="post" action="./do_logout.php">
    <button type="submit" class="btn btn-primary">Logout</button>
</form> -->
</body>
</html>