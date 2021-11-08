<?php 

class HomeModel{
	protected $_table = 'Home';

	public function getlist()
	{
		$data = ['1','2','3'];
		return $data;
	}
	public function getdataID($id)
	{
		$data = ['1','2','3'];
		return $data[$id];
	}
}

?>