<?php

namespace EduardoLanzini\Framework;

use EduardoLanzini\Framework\Config;
use EduardoLanzini\Framework\Log;
use EduardoLanzini\Framework\View;
use EduardoLanzini\Router;
use EduardoLanzini\DB;
use EduardoLanzini\Acl;

Final Class App{

	private $config;

	public function run()
	{	
		session_start();

		define('DS', DIRECTORY_SEPARATOR);
		define('ROOT', substr(__DIR__,0,-44));

		$config = new Config;
		
		require_once ROOT.DS.'config.php';

		$this->config = $config;

		if($this->config->getDb()){
			DB::connect($this->config->getDB());
		}

		define('PATH', $this->config->getPath());
		define('LAST_URL', isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '' );

		require_once 'helpers/helpers.php';
		require_once 'helpers/customHelpers.php';

		$router = new Router();

		$router->setBasePath($this->config->getPath());
		$router->setControllerPath(ROOT.DS.'app'.DS.'controllers');
		$router->setViewPath(ROOT.DS.'app'.DS.'views');

		include_once ROOT.'/app/Routes.php';

		if (!$router->route())
		{
			http_response_code(404);
			View::render('404');
		}
	}

}