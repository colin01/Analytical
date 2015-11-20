<?php
function getvideo($id){
	$content=get_curl_contents('http://app.letv.com/v.php?id='.$id);
	$wd3=inter($content,'<mmsJson>','</mmsJson>');
	$wd3=inter($wd3,'<![CDATA[',']]>');
	$data=json_decode($wd3);
	$wd4=$data->bean->video;
	$wd5=$wd4[0]->url;
	$content2=get_curl_contents($wd5);
	$data2=json_decode($content2);
	$wd6=$data2->location;
	$urllist[0]['url']='http://'.inter($wd6,'http://','.letv').'.'.inter($wd6,'video_type=','&');
	$urllist[0]['sec'] = '';
	$urllist[0]['size'] = '';
	return $urllist;
}
?>