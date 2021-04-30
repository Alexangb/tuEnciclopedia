<?php
class Core{
	public function __construct()
	{
		$url=isset($_GET['url'])? $_GET['url']:null;
		$url=rtrim($url,'/');
		$url=explode('/',$url);

		if (empty($url[0])) {
			require_once '../app/controllers/homeController.php';
			(new HomeController())->index();
			return false;
		}

		$path_controller = '../app/controllers/'. $url[0]. 'Controller.php';

		if(file_exists($path_controller)){
			require_once $path_controller;
			$controller_name=$url[0].'Controller';
			$controller=new $controller_name();
			$size=count($url);

			if($size>=2){
				if(method_exists($controller,$url[1])){
					if($size>=3){
						$param=[];
						for($i=2;$i<=$size-1;$i++){
							array_push($param,$url[$i]);
						}
						$controller->{$url[1]}($param);
					}else{
						$controller->{$url[1]}();
					}
				}else{
					echo"el metodo de accion {$url[1]} no existe";
				}
			}else{
				$controller->index();
			}
		}else{
			echo"el controlador {$url[0]} no existe";
		}
	}
}