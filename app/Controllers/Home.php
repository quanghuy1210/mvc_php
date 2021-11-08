<?php 
require_once "./core/Controller.php";
require_once "./core/Response.php";
use Core\Controller;
use Core\View;
use Core\Response;


class Home extends Controller{

	public function index()
	{
		$data = [ 'ten'=> 'huy',
			'tuoi' => 21,
			'diachi' => 'abc'
		];

		// $data = $this->send(200,$data);

		return $this->view('home/index',$data,200);
	}

	
}



?>
