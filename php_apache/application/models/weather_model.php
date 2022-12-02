<?php
include_once '../application/details/boot.php';
include_once '../application/core/model.php';
class WeatherModel extends Model {

    public function get_data() {
        $query = "select id, timestamp, temperature, wind_speed, pressure from weather_report;";
        $result = db()->query($query);
        return $result;
    }


}
?>