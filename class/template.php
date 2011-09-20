<?php

class Class_Template {

	public static function process($template){
		$content = '[##t:__top]'.self::getTemplate($template).'[##t:__bottom]';
		$result = '';
		while(($start = strpos($content, '[##'))!==false){
			// recopy processed string
			$result .= substr($content, 0, $start);

			// get the key
			$content = substr($content, $start+3);
			$start = strpos($content, ']');
			$key = substr($content, 0, $start);
			$content = substr($content, $start+1);

			// push result
			$content = self::processKey($key).$content;
		}
		$result .= $content;
		return $result;
	}

	public static function processKey($key){
		$type = strtolower(substr($key, 0, 1));
		$action = substr($key, 2);
		$result = '';
		switch($type){
			case 't' : // template
				$result = self::getTemplate($action);
				break;
			case 'e' : // eval
				eval('$result = '.$action.';');
				break;
		}
		return $result;
	}
	
	private static function getTemplate($template){
		// PROTECT INJECTION PATH
		$template = str_replace('/', '', $template);
		$template = str_replace('\\', '', $template);

		// GET THE TEMPLATE IF EXISTS
		$path = 'template/'.$template.'.html';
		if(!file_exists($path)){
			if($template=='error404'){
				return 'ERROR 404';
			}
			return self::getTemplate('error404');
		} else {
			return file_get_contents($path);
		}
	}

}