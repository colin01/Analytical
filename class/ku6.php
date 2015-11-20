<?php
function getvideo($id){
	$content2=get_curl_contents('http://v.ku6.com/fetchVideo4Player/'.$id.'.html');
	$data=json_decode($content2);
	$wd2=$data->data->f;
	$wd5=$data->data->vtime;
	$wd3=explode(',',$wd2);
	$wd6=explode(',',$wd5);
	$wd4='';
	for($i=0,$j=count($wd3);$i<$j;$i++){
		$urllist[$i]['url'] = $wd3[$i];
		$urllist[$i]['sec'] = $wd6[$i];
	}
	if(!$urllist[0]['url']){
		$urllist[0]['url'] =$wd2;
		$urllist[0]['sec'] = $wd5;
	}
	return $urllist;
}
?>