<?php
function getvideo($id){
	$content=get_curl_contents('http://vxml.56.com/json/'.$id.'/?src=out');
	$data=json_decode($content);
	$wd2=$data->info->rfiles;
	for($i==0;$i<count($wd2);$i++){
		$type=$wd2[$i]->type;
		if($type=='normal'){
			$wd3=$wd2[$i]->url;
			break;
		}
	}
	if(!$wd3){
		$wd3=$wd2[0]->url;
	}
	$urllist[0]['url'] = $wd3;
	$urllist[0]['sec'] = '';
	$urllist[0]['size'] = '';
	return $urllist;
}
?>