<table>
    <tr><th>Id</th><th>Temperature</th><th>Pressure</th><th>Timestamp</th><th>Wind speed</th></tr>
    <?php
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
