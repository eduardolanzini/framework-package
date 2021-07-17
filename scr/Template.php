<?php

namespace EduardoLanzini\Framework;

use EduardoLanzini\Framework\Log;
use EduardoLanzini\Framework\Auth;

Class Template{

	private static $data;

	private static $path;

	private static $section;

	private static $layout;

	function __construct($path){
		$this->path = $path;
	}

	static function setPath($var){
		self::$path = $var;
	}

	static function setData($name,$data){
		self::$data[$name] = $data;
	}

	static function render($file,$data = null){

		//VIEW INJECTION
		$auth = new Auth;

		//self::$data = $data;
		
		if ($data) {
			extract($data);
		}

		if (file_exists(self::$path . DS . $file . '.php')) {
			require self::$path . DS . $file . '.php';
		}else{
			exit('View não existe');
		}
		

		if (self::$layout && !isset(self::$section['content'])) {
			self::$section['content'] = ob_get_contents();
			ob_end_clean();
		}

		if (self::$section) {
			extract(self::$section);
		}

		if (self::$layout) {
			require self::$layout;
		}
		
	}

	static function template($file){

		if (file_exists(self::$path . DS. $file . '.php')) 
		{

			self::$layout = self::$path . DS. $file . '.php' ;

			ob_start();

		}
		else
		{
			Log::error('Template não existente');	
		}
	}

	static function section($var){
		ob_start();
	}

	static function end($var){
		self::$section[$var] = ob_get_contents();
		ob_end_clean();
	}
}