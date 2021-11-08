<?php 
//dan vao controller
$router['default_controller'] = 'home';

$router['trang-chu'] = 'home';
$router['san-pham/(.+)'] = 'home/product/$1';
$router['tin-tuc/(.+)'] = 'news/category/$1';


?>