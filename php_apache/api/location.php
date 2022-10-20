<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$method = $_SERVER['REQUEST_METHOD'];
$request = explode("/", substr(@$_SERVER['PATH_INFO'], 1));

include_once "../service/location_service.php";
include_once "../domain/location.php";

function is_not_valid($body) {
  return empty($body->name) 
  || empty($body->latitude) 
  || empty($body->longitude);
}

function exclude($body) {
  $location = new Location();
  $location->name = $body->name;
  $location->latitude = $body->latitude;
  $location->longitude = $body->longitude;
  return $location;
}

$service = new LocationService();

switch ($method) {
  case 'PUT':
    if (empty($request[0])) {
      $code = 400;
      $response = array("message" => "Id not specified");
    } else {
      $body = json_decode(file_get_contents('php://input'));
      if (is_not_valid($body)) {
        $code = 400;
      } else {
        $weatherReport = exclude($body);
        try {
          $response = $service->update(intval($request[0]), $weatherReport);
          $code = 200;
        } catch (Exception $e) {
          $code = 404;
          $response = array("message" => $e->getMessage());
        }
      }
    }

    http_response_code($code);
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    break;
  case 'POST':
    $body = json_decode(file_get_contents('php://input'));
    if (is_not_valid($body)) {
      http_response_code(400);
    } else {
      $weatherReport = exclude($body);
      $created = $service->create($weatherReport);
      http_response_code(201);
      echo json_encode($created, JSON_UNESCAPED_UNICODE);
    }
    break;
  case 'GET':
    if (empty($request[0])) {
      $response = $service->readAll();
      $code = 200;
    } else {
      try {
        $response = $service->readOne(intval($request[0]));
        $code = 200;
      } catch (Exception $e) {
        $code = 404;
        $response = array("message" => $e->getMessage());
      }
    }
    http_response_code($code);
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    break;
    case 'DELETE':
    if (empty($request[0])) {
      $code = 400;
      $response = array("message" => "Id not specified");
    } else {
      try {
        $response = $service->delete(intval($request[0]));
        $code = 200;
      } catch (Exception $e) {
        $code = 404;
        $response = array("message" => $e->getMessage());
      }
    }

    http_response_code($code);
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    break;
    
  default:
    http_response_code(404);
    break;
}
?>