<?php
error_reporting(0);
include_once('./class/base.php');
include_once('./class/vid.php');
if(!isset($_GET['u'])){
	die('no url!');
}
$url= base64_decode($_GET['u']);
if(preg_match("/^[a-zA-Z0-9-_]{4,41}\.[a-z0-9]{2,12}$/",$url)){
	$arr=explode('.',$url);
	$data['id'] = $arr[0];
	$data['type'] = $arr[1];
}else{
	$data = getvideoid($url);
	if($data['status']<0){
		echo json_encode($data);
		die;
	}
}
if($data['type']){
	$filename = './class/'.$data['type'].'.php';
	if(file_exists($filename)){
		include_once($filename);
	}else{
		include_once('./class/url.php');
	}
	
}
$t = getvideo($data['id']);
echo get_xml($t,$data['type']);