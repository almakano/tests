<?php
	function autoload($name) {
		$classname = trim(strtolower(strtr($name, '\\', '/')), '/');
		if(file_exists($file = DIR_SITE.'/lib/'.$classname.'.php'))
			include $file;
	}

	ini_set('display_errors', 'on');
	error_reporting(E_ALL);

	define ('DIR_SITE', dirname(__FILE__));
	spl_autoload_register('autoload');

	\Php\Controller::run();
	echo \Php\Controller::get_response();
?>