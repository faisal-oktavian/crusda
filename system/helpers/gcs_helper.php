<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require BASEPATH.'../vendor/autoload.php';
use Google\Cloud\Storage\StorageClient;

if (!function_exists('gcs_get_files')) {
	function gcs_get_files($gcs_bucket,$gcs_path = '')
	{
		$storage = new StorageClient([
			'keyFile' => json_decode(file_get_contents(BASEPATH.'../assets/gcs_auth.json'),true),
			'projection' => 'noAcl',
		]);
		$bucket = $storage->bucket($gcs_bucket);
		return $bucket->objects(['prefix' => $gcs_path]);
	}
}

if (!function_exists('gcs_upload_file')) {
	function gcs_upload_file(){
		$storage = new StorageClient([
			'keyFile' => json_decode(file_get_contents(BASEPATH.'../assets/gcs_auth.json'),true),
			'projection' => 'noAcl',
		]);
		$bucket = $storage->bucket('webtoprint');
		echo "<pre>";
		$options = array(
			'name' => 'testing/subdir/new.png',
		);
		// var_dump($bucket->upload(fopen(APPPATH.'assets/images/logo.png', 'r'),$options));
		$upload = $bucket->upload(fopen(APPPATH.'assets/images/logo.png', 'r'),$options);
		// print_r($upload);
		// echo '<img src="'.azarr($upload->info(),'mediaLink').'"/>';
		$total_usage = 0;
		foreach($bucket->objects(['prefix' => 'testing/']) as $object){
			printf('Object: %s' . PHP_EOL, $object->name());
			$this_info = $object->info();
			print_r($object->info());
			$total_usage += azarr($this_info,'size');
		}

		echo "size : <br>";
		echo round($total_usage/1024).'KB<br>';
		echo round($total_usage/(1024*1024)).'MB<br>';
		echo ($total_usage/(1024*1024*1024)).'GB<br>';
		$gb = substr(($total_usage/(1024*1024*1024)),0,4);
		$last = substr($gb,-1);
		if($last == 0){
			$last = 1;
		}
		$result = substr($gb,0,3).$last;
		echo $result;
		// echo ceil(($total_usage/(1024*1024*1024))/10).'%<br>';
	}
}

if (!function_exists('gcs_get_file_size')) {
	function gcs_get_file_size($prefix='',$type_size = 'kb')
	{
		$storage = new StorageClient([
			'keyFile' => json_decode(file_get_contents(BASEPATH.'../assets/gcs_auth.json'),true),
			'projection' => 'noAcl',
		]);
		$bucket = $storage->bucket('webtoprint');
		$total_usage = 0;
		foreach($bucket->objects(['prefix' => 'testing/']) as $object){
			$this_info = $object->info();
			$total_usage += azarr($this_info,'size');
		}
		//always turn on Byte, not bit
		if (in_array($type_size,array('kb','mb','gb'))) {
			$kb = ceil($total_usage/1024);
			switch ($type_size) {
				case 'kb':
					return $kb;
					break;
				case 'mb':
					return ($total_usage/(1024*1024));
					break;
				case 'gb':
					return ($total_usage/(1024*1024*1024));
					break;
				
				default:
					return ceil($total_usage/1024);
					break;
			}
		}
	}
}