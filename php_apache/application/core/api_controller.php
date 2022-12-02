<?php

include_once 'view.php';

abstract class ApiController  {
    
    protected $service;
    private $view;
    public function __construct($service) {
      $this->service = $service;
      $this->view = new View();
    }

  public function delete_method($request, $start) {
    $this->check_id_specified($request[$start]);
    $response = $this->service->delete(intval($request[$start]));
  }

  public function get_method($request, $start) {
      if (empty($request[$start])) {
          $response = $this->service->readAll();
      } else {
          $response = $this->service->readOne(intval($request[$start]));
      }
      return $response;
  }

  public function put_method($request, $start) {
    $this->check_id_specified($request[$start]);
    $body = json_decode(file_get_contents('php://input'));
    $this->check_valid($body);
    $request_body = $this->exclude($body);
    $response = $this->service->update(intval($request[$start]), $request_body);
    return $response;
  }

  public function post_method($request, $start) {
      $body = json_decode(file_get_contents('php://input'));
      $this->check_valid($body);
      $request_body = $this->exclude($body);
      $created = $this->service->create($request_body);
      return $created;
  }


  public function handle($method, $request, $start) {
      $method = strtolower($method) . "_method";
      try {
          $response = $this->$method($request, $start);
          $code = 200;
      } catch (ApiException $e) {
          $code = $e->getCode();
          $response = array("message" => $e->getMessage());
      }
      $this->view->json($code, $response);
  }

  
  function check_valid($body) {
      if ($this->is_not_valid($body)) {
          throw new BadRequestException("Invalid request body");
        }
    }
    
    function check_id_specified($body) {
        if (empty($request[$start])) {
            throw new BadRequestException("Id not specified");
        }
    }
    
    abstract protected function is_not_valid($body);
    
    abstract protected function exclude($body);
}


?>