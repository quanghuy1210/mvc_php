<?php 

define('_DIR_ROOT', __DIR__);

//xử lý http root
if(!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on'){
	$webroot = 'https://'.$_SERVER['HTTP_HOST'];
}else{
	$webroot = 'http://'.$_SERVER['HTTP_HOST'];
}


//get url root
$dirRoot = str_replace('\\','/',_DIR_ROOT);
$documentRoot = str_replace('\\','/',$_SERVER['DOCUMENT_ROOT']);
$folder = str_replace(strtolower($documentRoot), '', strtolower($dirRoot));
$webroot = $webroot.$folder;


define('_WEB_ROOT',$webroot);

//require tự động file config
$configs_dir = scandir('config');
if(!empty($configs_dir)){
	foreach($configs_dir as $item){
		if($item != '.' && $item !='..' && file_exists('config/'.$item)){
			require_once 'config/'.$item;
		}
	}
}

// require_once 'config/routers.php';//load route config
require_once 'core/Route.php';//load route class
require_once 'app/App.php';//load các app

//kiem tra config va load DB
if(!empty($config['database'])){
	$db_config = array_filter($config['database']);
	if(!empty($db_config)){
		require_once 'core/Connection.php';
	}
}
// echo "<pre>";
// print_r($db_config);
// echo "</pre>";


require_once 'core/Controller.php';//load base controller 



?>