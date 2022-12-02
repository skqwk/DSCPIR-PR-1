<?php

include_once "../application/config/config.php";
include_once "abstract_service.php";

class WeatherReportService extends AbstractService {

    public function __construct() {
        parent::__construct(weatherReportRepo(), "report", "reports");
    }

    function format($weather_report) {
        return array(
            "id" => $weather_report["id"],
            "timestamp" => $weather_report["timestamp"],
            "windSpeed" => $weather_report["wind_speed"],
            "temperature" => $weather_report["temperature"]
        );
    }

}

?>