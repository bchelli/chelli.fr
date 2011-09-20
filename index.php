<?php

function __autoload($class_name) {
    require_once str_replace('_', '/', strtolower($class_name)) . '.php';
}

echo(
	Class_Template::process(
		Class_Url::getPage()
	)
);

