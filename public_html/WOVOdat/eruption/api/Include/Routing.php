<?php
	class Routing {
		private static $controllers = array();

		public static function route() {

			$request = $_REQUEST['data'];
			foreach (self::$controllers as $controller) {

				foreach ($controller["routing"] as $routing) {

					if($routing["request"] == $request) {

						$params = array();
						foreach ($routing["params"] as $param) {

							array_push($params, $_REQUEST[$param]);
							// var_dump($params);
						}
						return call_user_func_array($controller["controller"] . "::" . $routing["method"], $params);
					}
				}
			}
		}

		public static function register($controller) {
			array_push(self::$controllers, $controller);
		} 
	}
