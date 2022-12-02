<?php

    include_once "../application/dao/weather_report_dao.php";
    class WeatherReportService {

        private WeatherReportDAO $dao;

        public function __construct() {
            $this->dao = new WeatherReportDAO();
        }

        function readAll() {
            $query_result = $this->dao->readAll();
            $reports = array("reports" => array());
            foreach($query_result as $weather_report) {
                $weather_report_obj = $this->format($weather_report);
                $reports["reports"][] = $weather_report_obj;
            }
            return $reports;
        }

        function create(WeatherReport $weatherReport) {
            $created_id = $this->dao->create($weatherReport);
            return $this->readOne($created_id);
        }

        function update(int $id, WeatherReport $weatherReport) {
            $this->readOne($id);
            $updatedId = $this->dao->update($id, $weatherReport);
            return $this->readOne($updatedId);
        }

        function delete(int $id) {
            $this->readOne($id);
            $deletedId = $this->dao->delete($id);
            return array("message" => "WeatherReport with id = ".$id." is deleted");
        }

        function readOne(int $id) {
            $weather_report = $this->dao->readOne($id);
            if (is_null($weather_report)) {
                throw new Exception("WeatherReport with id = ".$id." not found");
            }
            $weather_report_obj = $this->format($weather_report);
            return array("report" => $weather_report_obj);
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