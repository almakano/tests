<?php 
	namespace Php;
	// simple global function
	function one($arg = []) {

	}
	// simple abstract class
	abstract class Two {
	}
	// Pattern singleton
	// Using: Classname::self()->property
	class Singleton {
		//
		static $instances = [];
		//
		static function self($arg = []) {
			$classname = get_called_class();
			if(!isset(static::$instances[$classname])) {
				static::$instances[$classname] = new $classname($arg);
			}
			return static::$instances[$classname];
		}
	}
	// Class controller
	// Using: Controller::run([ 'page' => 1 ])
	class Controller extends Singleton {
		//
		static $data;
		//
		static function run($arg = []) {
			
		}
		//
		static function get_response($arg = []) {
			
		}
	}
	// Class view
	// Using: View::render('path/to/template', [ 'list' => [] ])
	class View extends Singleton {
		// render template
		static function render($__template = 'index', $__arg = []) {

			extract($__arg);
			ob_start();
			if(file_exists($__file = DIR_SITE.'/'.$__template.'.php'))
				include $__file;
			$res = ob_get_clean();
			return $res;
		}
	}
?>