<?php
include_once "../application/service/location_service.php";
include_once "../application/domain/location.php";
include_once '../application/core/api_controller.php';

class LocationApiController extends ApiController {

    public function __construct() {
        parent::__construct(new LocationService());
    }

    function exclude($body) {
        $location = new Location();
        $location->name = $body->name;
        $location->latitude = $body->latitude;
        $location->longitude = $body->longitude;
        return $location;
      }

    function is_not_valid($body) {
    return empty($body->name) 
    || empty($body->latitude) 
    || empty($body->longitude);
    }
}


?>