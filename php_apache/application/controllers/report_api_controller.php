<?php
include_once "../application/service/weather_report_service.php";
include_once "../application/domain/weather_report.php";
include_once '../application/core/api_controller.php';

class ReportApiController extends ApiController {

    public function __construct() {
        parent::__construct(new WeatherReportService());
    }

    function is_not_valid($body) {
        return empty($body->timestamp) 
        || empty($body->temperature) 
        || empty($body->windSpeed) 
        || empty($body->pressure);
      }
      
      function exclude($body) {
        $weatherReport = new WeatherReport();
        $weatherReport->timestamp = $body->timestamp;
        $weatherReport->temperature = $body->temperature;
        $weatherReport->windSpeed = $body->windSpeed;
        $weatherReport->pressure = $body->pressure;
        return $weatherReport;
      }
}


?>