<?php

class View_Portfolio {

	public static function getArticles(){

		$navigation = '';
		$scroll = '';

		$articles = Model_Article::getArticlesIds();
		$first = ' class="first"';
		foreach($articles as $article){
			$ar = Model_Article::getArticle($article);
			$navigation .= '
		<li>
			<a href="#'.$article.'"'.$first.'>
					<table><tr>
						<td><img src="'.$ar['icon'].'" /></td>
						<td>'.$ar['title'].'</td>
					</tr></table>
			</a>
		</li>
';

			$scroll .= '
			<div class="panel" id="'.$article.'">'.self::getArticle($ar).'</div>
';
			$first = '';
		}

		return '
<div id="slider">
	<ul class="navigation">
		'.$navigation.'
	</ul>

	<div class="scroll">
		<div class="scrollContainer">
			'.$scroll.'
		</div>
	</div>
</div>
';
	}

	private static function getArticle($ar){
		$content = '';
		if(isset($ar['picture'])) {
			$content .= '
				<img src="'.$ar['picture'].'" class="img-principale" />
';
		}
		if(isset($ar['body'])) {
			$content .= '
				<span class="description">'.$ar['body'].'</span>
';
		}
		if($content!=''){
			$content .= '
				<div class="cl"></div>
';
		}
		if(isset($ar['articles'])){
			$top = '';
			foreach($ar['articles'] as $article){
				if($content!=''){
					$top = '<br /><br /><br />';
				}
				$content .= $top.self::getArticle($article);
			}
		}
		return $content;
	}

}