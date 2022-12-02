<?php
include_once '../application/details/boot.php';

class WeatherReportDAO {


    function readAll() {
        $query = "select id, timestamp, temperature, wind_speed, pressure from weather_report;";
        $stmt = db()->query($query);
        return $stmt;
    }

    function create(WeatherReport $weatherReport) {
        $query = "insert into weather_report(timestamp, temperature, wind_speed, pressure) VALUES(?, ?, ?, ?);";
        $stmt = db()->prepare($query);
        $stmt->bind_param("sddi", 
            $weatherReport->timestamp, 
            $weatherReport->temperature, 
            $weatherReport->windSpeed, 
            $weatherReport->pressure);

        $stmt->execute();
        $result = db()->insert_id;
        return $result;
    }

    function readOne(int $id) {
        $query = "select id, timestamp, temperature, wind_speed, pressure from weather_report where id = ?;";
        $stmt = db()->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result;
    }

    function update(int $id, WeatherReport $weatherReport) {
        $query = "update weather_report set timestamp = ?, temperature = ?, wind_speed = ?, pressure = ? where id = ?;";
        $stmt = db()->prepare($query);
        $stmt->bind_param("sddii", 
            $weatherReport->timestamp, 
            $weatherReport->temperature, 
            $weatherReport->windSpeed, 
            $weatherReport->pressure,
            $id
        );

        $stmt->execute();
        return $id;
    }

    function delete(int $id) {
        $query = "delete from weather_report where id = ?;";
        $stmt = db()->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $id;
    }

}

?>