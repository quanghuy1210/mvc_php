<?php 
class Route{

	public function handleRoute($url)
	{
		global $router;
		unset($router['default_controller']);
		$url = trim($url , '/');

		if(empty($url)){
			$url = '/';
		}
		
		$handleUrL =$url;

		if(!empty($router)){
			foreach ($router as $key => $value) {
				if(preg_match('~'.$key.'~is',$url)){
					$handleUrL = preg_replace('~'.$key.'~is',$value,$url);
				}
			}
		}
		return $handleUrL;
	}
}

?>