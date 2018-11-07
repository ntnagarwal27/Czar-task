<?php 

$url = explode('/', echo getcwd());
array_pop($url);
echo implode('/', $url);die;


?>