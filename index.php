<?php 
session_start();

require_once 'lib.php';

require_once 'core/Response.php';
use Core\Response;

$response = new Response();

$response->setHeader('Access-Control-Allow-Origin: *');
$response->setHeader('Content-type: application/json');
// $response->setHeader("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

$app = new App();

?>