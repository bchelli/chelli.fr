<?php

class View_Header {

	public static function version(){
		return '1.2';
	}

	public static function getMenu(){
		return '
					<ul>
						<li class="first'.self::isSelected('home').'">
							<a href="'.Class_Url::getUrl('home').'"><span>Home</span></a>
						</li>
						<li class="'.self::isSelected('portfolio').'">
							<a href="'.Class_Url::getUrl('portfolio').'"><span>Portfolio</span></a>
						</li>
						<li class="'.self::isSelected('resume').'">
							<a href="'.Class_Url::getUrl('resume').'"><span>Resume</span></a>
						</li>
						<li class="last'.self::isSelected('contact').'">
							<a href="'.Class_Url::getUrl('contact').'"><span>Contact</span></a>
						</li>
					</ul>
';
	}
	
	private static function isSelected($page){
		return (Class_Url::getPage()==$page)?' selected':'';
	}
	
}
