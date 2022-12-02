<?php
include_once '../application/config/config.php';
include_once '../application/core/model.php';
class WeatherModel extends Model {

    private CrudRepo $weatherReportRepo;

    public function __construct() {
        $this->weatherReportRepo = weatherReportRepo();
    }

    public function get_data() {
        $result = $this->weatherReportRepo->readAll();
        return $result;
    }


}
?>