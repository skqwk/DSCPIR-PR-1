<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$method = $_SERVER['REQUEST_METHOD'];
$request = explode("/", substr(@$_SERVER['PATH_INFO'], 1));

include_once "../service/weather_report_service.php";
include_once "../domain/weather_report.php";

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

$service = new WeatherReportService();

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