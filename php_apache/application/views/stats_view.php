<?php
foreach($images as $image) {
    echo "<img src=\"{$image['path']}\" alt=\"{$image['name']}\"><br>";
}
?>
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