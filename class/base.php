<?php
function urldebug($url,$off = 0){//如果不希望往服务器回传数据，请自己把$off的值改为1
	$data['status'] = -1;
	$data['msg'] = '该地址不能正常解析，已经记录，会在最短的时间内解决该问题';
	$data['url'] = $url;
	if($off == 0){
		$url= 'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		$out = 'http://pic.tucao.cc/dll/urldebug.php?url='.base64_encode($url);
		if($out != '1'){
		$data['msg'] = '该地址不能正常解析，地址记录无法正常记入数据库';
		}
	}
	echo json_encode($data);
	die;
}
function inter($str,$start,$end){
	$wd2='';
	if($str && $start){
		$arr=explode($start,$str);
		if(count($arr)>1){
			$wd=$arr[1];
			if($end){
				$arr2=explode($end,$wd);
				if(count($arr2)>1){
					$wd2=$arr2[0];
				}
				else{
					$wd2=$wd;
				}
			}
			else{
				$wd2=$wd;
			}
		}
	}
	return $wd2;
}

function DeleteHtml($str){ 
	$str = trim($str); 
	$str = strip_tags($str,""); 
	$str = ereg_replace("\t","",$str); 
	$str = ereg_replace("\r\n","",$str); 
	$str = ereg_replace("\r","",$str); 
	$str = ereg_replace("\n","",$str); 
	$str = ereg_replace(" "," ",$str); 
	$str = ereg_replace("'","",$str);
	$str = ereg_replace("\"","",$str);
	$str = ereg_replace("\|",",",$str); 
	return trim($str); 
}

function get_curl_contents($url,$bm='utf-8', $second = 20){
    if(!function_exists('curl_init')) die('php.ini未开启php_curl.dll');
    $c = curl_init();
    curl_setopt($c,CURLOPT_URL,$url);
    $UserAgent=$_SERVER['HTTP_USER_AGENT'];
    curl_setopt($c,CURLOPT_USERAGENT,$UserAgent);
    curl_setopt($c,CURLOPT_HEADER,0);
    curl_setopt($c,CURLOPT_TIMEOUT,$second);
    curl_setopt($c,CURLOPT_RETURNTRANSFER, true);
    $cnt = curl_exec($c);
    $cnt=mb_check_encoding($cnt,$bm)?iconv('gbk','utf-8//IGNORE',$cnt):$cnt; //字符编码转换
    curl_close($c);
    return $cnt;
}
function get_xml($data,$data_type){
	switch ($data_type){
		case 'tudou':
		$q='{h->3}{q->tflvbegin}';
		break;
		case 'ku6':
		$q='{h->3}{q->rate}';
		break;
		case 'youku':
		$q='{h->2}';
		break;
		default:
		$q='{h->3}';
		break;
	}
	$urllist='';
	foreach($data as $key=>$value){
		$urllist.='		<video>'.chr(13);
		$urllist.="			<file><![CDATA[".$data[$key]['url']."]]></file>".chr(13);
		if(!$data[$key]['size'])$data[$key]['size']=0;
		$urllist.="			<size>".$data[$key]['size']."</size>".chr(13);
		$urllist.="			<seconds>".$data[$key]['sec']."</seconds>".chr(13);
		$urllist.='		</video>'.chr(13);
	}
	$urllist2 = '';
	$urllist2.='<?xml version="1.0" encoding="utf-8"?>'.chr(13);
	$urllist2.='	<player>'.chr(13);
	$urllist2.='	<flashvars>'.chr(13);
	$urllist2.='		'.$q.''.chr(13);
	$urllist2.='	</flashvars>'.chr(13);
	$urllist2.=$urllist;
	$urllist2.='	</player>';
	echo $urllist2;
}
?>