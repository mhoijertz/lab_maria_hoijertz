
<?php 
$url = $_SERVER['REQUEST_URI'];
$strings = explode('/', $url);
$current_page = end($strings);

$dbname = 'lab';
$dbuser = 'root';
$dbpass = 'root';
$dbserver = 'localhost';

?>