<?php 
/*
	by Jude <surftheair@gmail.com>
	http://jude.im/
	works with Icecast 2.3.2
*/

require('config.php');
$stream = getStreamInfo();
if($stream['info']['status'] == 'OFF AIR'){
	cacheVar($stream);
}
else{
	$last_song = @file_get_contents('last.txt');
	if($last_song != base64_encode($stream['info']['song'])){
		$stream = init($stream);
		$stream = getInfo($stream);
		file_put_contents('last.txt', base64_encode($stream['info']['song']));
		cacheVar($stream);
	}
	else{
		$stream = array_decode(json_decode(@file_get_contents('var/info.json'), TRUE));
	}
}
//print_r($stream);

function obj_to_array($obj){
	$array = (is_object) ? (array)$obj : $obj;
	foreach($array as $k=>$v){
		if(is_object($v) OR is_array($v))
			$array[$k] = obj_to_array($v);
	}
	return $array;
}

function getStreamInfo(){
	$str = @file_get_contents(SERVER.'/status.xsl?mount='.MOUNT);
	if(preg_match_all('/<td\s[^>]*class=\"streamdata\">(.*)<\/td>/isU', $str, $match)){
		$stream['info']['status'] = 'ON AIR';
		$stream['info']['title'] = $match[1][0]; 
		$stream['info']['description'] = $match[1][1]; 
		$stream['info']['type'] = $match[1][2]; 
		$stream['info']['start'] = $match[1][3]; 
		$stream['info']['bitrate'] = $match[1][4]; 
		$stream['info']['listeners'] = $match[1][5]; 
		$stream['info']['msx_listeners'] = $match[1][6]; 
		$stream['info']['genre'] = $match[1][7]; 
		$stream['info']['stream_url'] = $match[1][8];
		$stream['info']['artist_song'] = $match[1][9];
			$x = explode(" - ",$match[1][9]); 
		$stream['info']['artist'] = $x[0]; 
		$stream['info']['song'] = $x[1];
	}
	else{
		$stream['info']['status'] = 'OFF AIR';
	}
	return $stream;
}

function getInfo($stream){
	if(!$stream['info']['song']){
		$stream['info']['song'] == 'Not found';
		return $stream;
	}
	$stream['fetch_time'] = time();
	return $stream;
}

function array_encode($array){
	foreach($array as $key=>$value){
		if(is_array($value)){
			$array[$key] = array_encode($value);
		}
		else{
			$array[$key] = base64_encode($value);
		}
	}
	return $array;
}

function array_decode($array){
	foreach($array as $key=>$value){
		if(is_array($value)){
			$array[$key] = array_decode($value);
		}
		else{
			$array[$key] = base64_decode($value);
		}
	}
	return $array;
}

function cacheVar($stream){
	$stream = array_encode($stream);
	file_put_contents('var/info.json', json_encode($stream));
}

function init($stream){
	return $stream;
}

?>