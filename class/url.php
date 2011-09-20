<?php

class Class_Url {

	public static function getPage(){
		return isset($_GET['_p'])?$_GET['_p']:'home';
	}

	public static function getUrl($page){
		return '?_p='.$page;
	}

}

