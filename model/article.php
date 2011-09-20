<?php

class Model_Article {

	private static $prefixe = 'articles/';

	public static function getArticlesIds(){
		$articles = glob(self::$prefixe.'art-*');
		foreach($articles as $id => $article){
			$articles[$id] = substr($article, strlen(self::$prefixe));
		}
		return $articles;
	}

	public static function getArticle($article){
		$result = array();
		$result['articleid'] = $article;
		$files = glob(self::$prefixe.$article.'/*');
		foreach($files as $file){
			$key = substr($file, strlen(self::$prefixe.$article.'/'));
			$type = substr($key, 0, 3);
			$fn = pathinfo(substr($key, 4));
			$fn = $fn['filename'];
			switch($type){
				case 'txt' :
					$result[$fn] = file_get_contents($file);
					break;
				case 'img' :
					$result[$fn] = $file;
					break;
				case 'art' :
					if(!isset($result['articles'])){
						$result['articles'] = array();
					}
					array_push($result['articles'], self::getArticle($article.'/'.$key));
					break;
			}
		}
		return $result;
	}

}

