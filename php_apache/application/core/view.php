<?php
class View
{
	//public $template_view; // здесь можно указать общий вид по умолчанию.
	
	function show($content_view, $template_view, $data = null) {
        extract($data);
		if(!is_null($template_view)) {
            include '../application/views/'.$template_view;
		} else {
            include '../application/views/'.$content_view;
        }
	}

    function json($code, $response = null) {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        http_response_code($code);
        if (!is_null($response)) {
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
        }

    }
}

?>