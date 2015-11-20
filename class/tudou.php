<?php
function getvideo($id){
	$content=get_curl_contents('http://v2.tudou.com/v?vn=02&st=1%2C2&it='.str_replace(' ','',$id));
	$urllist[0]['url'] = inter($content,'brt="2">','<');
	$urllist[0]['sec'] = '';
	$urllist[0]['size'] = '';
	return $urllist;
}
?>