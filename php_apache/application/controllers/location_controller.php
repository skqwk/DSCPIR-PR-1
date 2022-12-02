<?php
include_once "../application/service/location_service.php";
include_once "../application/domain/location.php";
include_once '../application/core/controller.php';

class LocationController extends Controller {

    private $service;
    
    public function __construct() {
        parent::__construct();
        $this->service = new LocationService();
    }

    public function delete_method() {
        
    }

    public function get_method($request, $start) {
        if (empty($request[$start])) {
            $response = $this->service->readAll();
        } else {
            $response = $this->service->readOne(intval($request[$start]));
        }
        return $response;
    }

    public function put_method() {

    }

    public function post_method() {

    }


    public function main_action($method, $request, $start) {
        $method = strtolower($method) . "_method";
        try {
            $response = $this->$method($request, $start);
            $code = 200;
        } catch (Exception $e) {
            $code = 404;
            $response = array("message" => $e->getMessage());
        }
        $this->view->json($code, $response);
        

        switch ($method) {
            case 'PUT':
              if (empty($request[$start])) {
                $code = 400;
                $response = array("message" => "Id not specified");
              } else {
                $body = json_decode(file_get_contents('php://input'));
                if (is_not_valid($body)) {
                  $code = 400;
                } else {
                  $weatherReport = $this->exclude($body);
                  try {
                    $response = $this->service->update(intval($request[$start]), $weatherReport);
                    $code = 200;
                  } catch (Exception $e) {
                    $code = 404;
                    $response = array("message" => $e->getMessage());
                  }
                }
              }
          
              $this->view->json($code, $response);
              break;
            case 'POST':
              $body = json_decode(file_get_contents('php://input'));
              if (is_not_valid($body)) {
                $this->view->json(400);
              } else {
                $weatherReport = $this->exclude($body);
                $created = $this->service->create($weatherReport);
                $this->view->json(201, $created);
              }
              break;
            case 'GET':
              if (empty($request[$start])) {
                $response = $this->service->readAll();
                $code = 200;
              } else {
                try {
                  $response = $this->service->readOne(intval($request[$start]));
                  $code = 200;
                } catch (Exception $e) {
                  $code = 404;
                  $response = array("message" => $e->getMessage());
                }
              }
              $this->view->json($code, $response);
              break;
              case 'DELETE':
              if (empty($request[$start])) {
                $code = 400;
                $response = array("message" => "Id not specified");
              } else {
                try {
                  $response = $this->service->delete(intval($request[$start]));
                  $code = 200;
                } catch (Exception $e) {
                  $code = 404;
                  $response = array("message" => $e->getMessage());
                }
              }
          
              $this->view->json($code, $response);
              break;
              
            default:
              $this->view->json(404);
              break;
          }
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