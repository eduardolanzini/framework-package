<?php

namespace EduardoLanzini\Framework;

use EduardoLanzini\Framework\Config;
use EduardoLanzini\Framework\Log;
use EduardoLanzini\Framework\View;
use EduardoLanzini\Router;
use EduardoLanzini\DB;

Final Class App{

	private $config;

	function __construct()
	{
		$config = new Config;
		require_once 'config/config.php';
		$this->config = $config;
	}

	public function run()
	{	
		if ($this->config->useDb) {
			DB::connect($this->config->getDb());
		}

		session_start();

		define('DS', DIRECTORY_SEPARATOR);
		define('ROOT', substr(__DIR__,0,-44));
		define('PATH', $this->config->getPath());
		define('ENVIRONMENT', $this->config->getEnvironment());
		define('LAST_URL', isset($_SERVER['HTTP_REFERER'])? $_SERVER['HTTP_REFERER'] : '' );

		require_once 'helpers/helpers.php';
		require_once 'helpers/customHelpers.php';

		$router = new Router();

		$router->setBasePath($this->config->getPath());
		$router->setControllerPath(ROOT.DS.'app'.DS.'controllers');

		require_once ROOT.'/app/Routes.php';

		if (!$router->route())
		{
			http_response_code(404);
			View::render(404);
		}
	}

}