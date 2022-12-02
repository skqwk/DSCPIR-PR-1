<?php
class Route {
	static function start() {
		$routes = explode('/', $_SERVER['REQUEST_URI']);
		$start = 2;
		// print_r($routes);

		if (!empty($routes[$start])) {
			if ($routes[$start] == "api") {
				Route::processApiMethod($routes, $start + 1);
			} else {
				Route::processMethod($routes, $start);
			}
		} else {
			Route::ErrorPage404();
		}

	
	}

	static function processMethod($routes, $start) {
		$controller_name = 'Main';
		$action_name = 'main';
		
		// получаем имя контроллера
		if (!empty($routes[$start])) {	
			$controller_name = $routes[$start];
		}
		
		// получаем имя экшена
		if (!empty($routes[$start + 1])) {
			$action_name = $routes[$start + 1];
		}

		// добавляем префиксы
		$controller_class_name = ucfirst($controller_name).'Controller';
		$controller_name = $controller_name.'_controller';
		$action_name = $action_name.'_action';
		
		// подцепляем файл с классом контроллера
		$controller_file = strtolower($controller_name).'.php';
		$controller_path = "../application/controllers/".$controller_file;
		if(file_exists($controller_path)) {
			include "../application/controllers/".$controller_file;
		}
		else {
			Route::ErrorPage404();
		}
		
		// создаем контроллер
		$controller = new $controller_class_name;
		$action = $action_name;
		
		if(method_exists($controller, $action)) {
			// вызываем действие контроллера
			$controller->$action();
		}
		else {
			// здесь также разумнее было бы кинуть исключение
			Route::ErrorPage404();
		}
	}

	static function processApiMethod($routes, $start) {
		$controller_name = 'Main';
		$action_name = 'main';
		
		// получаем имя контроллера
		if (!empty($routes[$start])) {	
			$controller_name = $routes[$start];
		}

		// добавляем префиксы
		$controller_class_name = ucfirst($controller_name).'Controller';
		$controller_name = $controller_name.'_controller';
		$action_name = $action_name.'_action';
		
		// подцепляем файл с классом контроллера
		$controller_file = strtolower($controller_name).'.php';
		$controller_path = "../application/controllers/".$controller_file;
		if(file_exists($controller_path)) {
			include "../application/controllers/".$controller_file;
		}
		else {
			Route::ErrorPage404();
		}
		
		// создаем контроллер
		$controller = new $controller_class_name;
		$action = $action_name;
		
		
        $method = $_SERVER['REQUEST_METHOD'];
        $request = $routes;
		if(method_exists($controller, $action)) {
			// вызываем действие контроллера
			$controller->$action($method, $request, 4);
		}
		else {
			// здесь также разумнее было бы кинуть исключение
			Route::ErrorPage404();
		}
	}
	
	static function ErrorPage404() {
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
		header("Status: 404 Not Found");
		header('Location:'.$host.'404');
    }
}
?>