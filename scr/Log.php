<?php

namespace EduardoLanzini\Framework;

Class Log{

	public static function exception(\Exception $e){

		$msgFinal = 'Exception: ' . $e->getMessage() . "\nArquivo: ".$e->getFile()."\nLinha ".$e->getLine()."\n".date('d/m/Y h:i:s')."\n\n" ;

		self::record("Error",$msgFinal);

		return true;
	}

	public static function error(string $msg){

		$msgFinal = 'ERROR: ' . $msg . ' | '.date('d/m/Y h:i:s') ."\n\n";

		self::record("Error",$msgFinal);

		exit($msgFinal);
	}

	public static function alert(string $msg){

		$msgFinal = "ALERT: " . $msg . ' - '.date('d/m/Y h:i:s') ."\n\n";

		self::record("Alert",$msgFinal);

	}

	public static function securityAlert(string $msg){

		$msgFinal = 'Security Alert: ' . $msg . ' | '.date('d/m/Y h:i:s')."\n\n";

		self::record("Error",$msgFinal);

		exit($msgFinal);
	}

	public static function record($arquivo,$text){

		    $arquivo = __DIR__.DS.'..'.DS.'logs'.DS.$arquivo.'.txt';

            $file = fopen($arquivo, 'a');

            fwrite($file, $text);

            fclose($file);
	}
}