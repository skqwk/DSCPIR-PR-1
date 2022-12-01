<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Random Stat</title>
    <link rel="stylesheet" href="../style/style.css" type="text/css"/>
    <link rel="stylesheet" href="../style/<?php echo (isset($_COOKIE['theme'])) ? $_COOKIE['theme'].'-style.css' : 'light-style.css'; ?>" type="text/css">
    <link rel="icon" type="image/x-icon" href="../icon/<?php echo (isset($_COOKIE['icon']) ? $_COOKIE['icon'] : 'cloud.png')?>">

</head>
<body>
<?php
require_once "faker.php";

generateData();
?>
<?php
require_once "plot_bar.php";
require_once "plot_pie.php";
require_once "plot_graph.php";

$plotpie = drawPlotPie();
$plotgraph = drawPlotGraph();
$plotbar = drawPlotBar();
?>
<?php
require_once "watermark.php";

$images = array($plotpie, 
                $plotgraph, 
                $plotbar);

foreach ($images as $image) {
    addWatermark($image);
}


?>
<h1><?php echo (isset($_COOKIE['name'])) ? $_COOKIE['name'] : "User" ?> Stats</h1>
<ul>
                <a href="/about.html">About</a>
                <a href="/index.html">Main</a>
                <a href="../weather.php">Weather</a>
                <a href="../documents.php">Documents</a>
                <a href="../index.php">Profile</a>
</ul>

<img src="images/plot_pie.png" alt="plot_1.png"><br>
<img src="images/plot_graph.png" alt="plot_2.png"><br>
<img src="images/plot_bar.png" alt="plot_3.png"><br>
<?php
$labelsAndValues = getLabelsAndValues('getEmojiCount');
$labels = $labelsAndValues["labels"];
echo '<div style="display: flex; justify-content: space-between; width: 290px; margin-left: 20px;">';
foreach ($labels as $label) {
    echo '<div>' . $label . '</div>';
}
echo '</div>';
?>
<br>
<br>
<br>
<table class="table">
    <tr>
        <th>Location</th>
        <th>Temperature</th>
        <th>Pressure</th>
        <th>Wind speed</th>
        <th>Date</th>
        <th>Weather</th>
    </tr>
    <?php
    $data = getRawData();

    foreach ($data as $data_row) {
        echo "<tr>";
        echo "<td>".$data_row->name."</td>";
        echo "<td>".$data_row->temperature."</td>";
        echo "<td>".$data_row->pressure."</td>";
        echo "<td>".$data_row->windSpeed."</td>";
        echo "<td>".$data_row->date."</td>";
        echo "<td>".$data_row->emoji."</td>";
        echo "</tr>";
    }
    ?>
</table>
</body>
</html>