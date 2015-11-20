<?php
function getvideoid($url){
	$data['status'] = 0;
	if(strpos($url,'youku.com')){
		$data['type'] = 'youku';
		if(strpos($url,'html')){
			$data['id']=inter($url,'id_','.html');
		}
		elseif(strpos($url,'swf')){
			$data['id']=inter($url,'/sid/','/');
		}else{
			urldebug($url);
		}
	}elseif(strpos($url,'tudou.com')||strpos($url,'tudouui.com')){
		$data['type'] = 'tudou';
		$data['id']='';
		if(strpos($url,'swf')){
			$wd=inter($url,'iid=','/');
			if(strpos($wd,'swf')){
				$wd=inter($url,'iid=','&');
			}
			if(!$wd){
				$url1=inter($url,'v/','/');
				$url="http://www.tudou.com/programs/view/".$url1."/";
			}
			$data['id'] = $wd;
		}
		if(!$data['id']){
			$content=get_curl_contents($url);
			$wd=inter($content,'vcode:"','"');
			if(!$wd){
				$wd=inter($content,'vcode: \'','\'');	
			}
			if ($wd){
				$data['type'] = 'youku';
				$data['id'] = $wd;
			}else{
				$data['id'] = DeleteHtml(inter($content,'iid:',','));
			}
		}
		if(!$data['id']){
			urldebug($url);
		}
	}elseif(strpos($url,'letv.com')){
		$data['type'] = 'letv';
		if(strpos($url,'swf')){
			$wd=inter($url,'swf?id=','&');
			$data['id'] = $wd;
		}else{
				$content=get_curl_contents($url);
				$wd=inter($content,'vid:',',');
				if($wd){
					$data['id'] = $wd;
				}elseif($wd == 0){
					$data['id']=inter($content,'vid=','&');
				}else{
					urldebug($url);
				}
		}
	}elseif(strpos($url,'56.com')){
		$data['type'] = '56';
		if(strpos($url,'v_')){
			$wd=inter($url,'v_','.');
		}elseif(strpos($url,'vid-')){
			$wd=inter($url,'vid-','.');
		}elseif(strpos($url,'open_')){
			$wd=inter($url,'open_','.');
		}elseif(strpos($url,'redian/')){
			$wd=explode('redian/',$url);
			$wd2 = explode('/',$wd[1]);
			$wd = '';
			$wd = $wd2[0];
			if($wd2[1]){
				$wd = $wd2[1];
			}
		}
		if($wd){
			$data['id'] = $wd;
		}else{
			urldebug($url);
		}
	}elseif(strpos($url,'pan.baidu')){
		$data['type'] = 'baidu';
		$wd=explode('shareid=',$url);
		$arrr = array("&uk=" => "-");
		$wd=strtr($wd[1],$arrr);
		if($wd){
			$data['id'] = $wd;
		}else{
			urldebug($url);
		}
	}elseif(strpos($url,'ku6.com')){
		$data['type'] = 'ku6';
		if(strpos($url,'html')){
			$arr=explode('/',$url);
			$wd=$arr[count($arr)-1];
			$wd=str_replace('.html','',$wd);
		}elseif(strpos($url,'swf')){
			$arr=explode('/',$url);
			$wd=$arr[count($arr)-2];
		}else{
			urldebug($url);
		}
		if($wd){
			$data['id'] = $wd;
		}else{
			urldebug($url);
		}
	}else{
		$data['type'] = 'url';
		$data['id'] = $wd;
	}
	return $data;
}
?>