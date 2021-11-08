<?php 

class App 
{
	private $__controller,$__action,$__param,$__route;


	public function __construct(){
		global $router;
		global $config;

		if(!empty($router['default_controller'])){
			$this->__controller = $router['default_controller'];
		}
		$this->__action = 'index';
		$this->__param = [];
		$this->__route = new Route();
		$this->handleUrl();

	}

	public function getUrl()
	{
		if(!empty($_SERVER['PATH_INFO'])){
			$url = $_SERVER['PATH_INFO'];
		}else{
			$url ='/';
		}
		return $url;
	}

	public function handleUrl()
	{

		$url = $this->getUrl();

		$url = $this->__route->handleRoute($url);
		
		$urlArr = array_values(array_filter(explode('/', $url)));

		$urlCheck = '';
		if(!empty($urlArr)){
			foreach($urlArr as $key=>$item){
				$urlCheck.= $item.'/';
				$fileCheck = rtrim($urlCheck , '/');
				$fileArr = explode('/', $fileCheck);
				$fileArr[count($fileArr) -1] = ucfirst($fileArr[count($fileArr) -1]);
				$fileCheck = implode('/', $fileArr);

				if(!empty($urlArr[$key-1])){
					unset($urlArr[$key-1]);
				}

				if(file_exists('app/Controllers/'.($fileCheck).'.php')){
					$urlCheck = $fileCheck;
					break;
				}
			}
			$urlArr = array_values($urlArr);
		}
		

		//xử lý controller
		if(!empty($urlArr[0])){
			$this->__controller = ucfirst($urlArr[0]);
		}else{
			$this->__controller = ucfirst($this->__controller);
		}
		//truong hop urlcheck rong /
		if(empty($urlCheck)){
			$urlCheck = $this->__controller;
		}


		//kiểm tra controller tồn tại
		if(file_exists('app/Controllers/'.$urlCheck.'.php')){
			require_once 'app/Controllers/'.$urlCheck.'.php';

			//kiểm tra class controller tồn tại tránh trường hợp tên class khác tên file 
			if(class_exists($this->__controller)){
				$this->__controller = new $this->__controller;
				unset($urlArr[0]);
			}else{
				$this->showError();
			}
		}else{
			$this->showError('404');
		}
		
		// sử lý action
		if(!empty($urlArr[1])){
			$this->__action = ucfirst($urlArr[1]);
			unset($urlArr[1]);
		}	

		// xử lý param
		$this->__param = array_values($urlArr);


   		//kiểm tra tồn tại và gọi hàm
		if(method_exists($this->__controller, $this->__action)){
			call_user_func_array([$this->__controller,$this->__action], $this->__param);
		}else{
			$this->showError();
		}
		


		// echo "<pre>";
		// print_r($this->__param);
		// echo "</pre>";


	}

	public function showError($error = '404')
	{
		require_once 'app/Views/Errors/'.($error).'.php';
	}


}






?>