<?php
function getvideo($id){
	$id=explode('-',$id);
	$url = "http://pan.baidu.com/share/link?shareid=".$id[0]."&uk=".$id[1];
	$contents = get_curl_contents($url);
	$tzurl = inter($contents,'dlink\":\"','\"');
	$urllist[0]['url'] =stripslashes(stripslashes($tzurl));
	$urllist[0]['sec'] = '';
	$urllist[0]['size'] = '';
	return $urllist;
}
?>