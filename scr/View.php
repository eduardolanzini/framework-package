<?php

namespace EduardoLanzini\Framework;

use EduardoLanzini\Framework\Log;
use EduardoLanzini\Framework\Auth;
use EduardoLanzini\Framework\Template;

Class View{

	private static $template;

	public static $cache = false;

	public static $cacheTime = 60; //seconds

	public static function render($file, $data = null)
	{
		$arquivoCache = ROOT.DS.'vendor'.DS.'automasites'.DS.'cache'.DS.$file.".html";

		if (self::$cache)
		{
			if 
				(
					file_exists($arquivoCache) &&
					filemtime($arquivoCache) > time() - self::$cacheTime

				)
			{
				$conteudo = file_get_contents($arquivoCache);

				echo $conteudo;

			}
			else
			{
				ob_start();

				Template::setPath(ROOT.DS.'app'.DS.'views');
				Template::render($file,$data);

				$conteudo = ob_get_contents();
				ob_end_clean();

				file_put_contents($arquivoCache, $conteudo);

				echo $conteudo;
			}
		}
		else
		{
			Template::setPath(ROOT.DS.'app'.DS.'views');
			Template::render($file,$data);
		}
	}

}