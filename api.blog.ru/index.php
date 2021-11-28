<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Methods: *');
header('Access-Control-Allow-Creditials: true');
header('Content-type: json/application');
require 'connect.php';
require 'functions.php';

$method = $_SERVER['REQUEST_METHOD'];

// file_put_contents('debug.html', print_r($method,1), FILE_APPEND | LOCK_EX);
$q = $_GET['q'];
$params = explode('/', $q);

$type = $params[0];
$id = $params[1];
// die($type);
if($method === 'GET')
{
	if($type === 'posts')
	{
		if (isset($id)) {
			getPost($connect, $id);
		}
		else getPosts($connect);
	}
}
elseif($method === 'POST')
{
	if($type === 'posts')
	{
		addPost($connect, $_POST);
	}
}
elseif($method === 'PATCH')
{
	if($type === 'posts')
	{
		if(isset($id)){
			$data = file_get_contents('php://input');
			$data = json_decode($data, true);
			// die(print_r($data));
			updatePost($connect, $id, $data);
		}
	}
}
elseif($method === 'DELETE')
{
	if($type === 'posts')
	{
		if(isset($id)){
			deletePost($connect, $id);
		}
	}
}