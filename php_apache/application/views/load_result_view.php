<html>
<header>
<link rel="stylesheet" href="../css/style.css" type="text/css"/>
<link rel="stylesheet" href="../css/<?php echo (isset($_COOKIE['theme'])) ? $_COOKIE['theme'].'-style.css' : 'light-style.css'; ?>" type="text/css">
<link rel="icon" type="image/x-icon" href="../icon/<?php echo (isset($_COOKIE['icon']) ? $_COOKIE['icon'] : 'cloud.png')?>">
</header>
<body>
<?php
echo '<div><pre>';
echo $message;
echo '</pre></div>';
?>
<a href="../documents">К списку</a>
</body>
</html>