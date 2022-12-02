<?php

    include_once "../application/config/config.php";
    include_once "abstract_service.php";

    class LocationService extends AbstractService {

        public function __construct() {
            parent::__construct(locationRepo(), "location", "locations");
        }

        function format($location) {
            return array(
                "id" => $location["id"],
                "name" => $location["name"],
                "latitude" => $location["latitude"],
                "longitude" => $location["longitude"]
            );
        }
    }
?>