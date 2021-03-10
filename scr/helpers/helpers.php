<?php

use Automasites\Log;

function dd($v){
	echo "<pre>";
	var_dump($v);
	exit;
}

function url($uri = null){
	if ($uri == null || $uri == '/') {
		return PATH;
	}else{
		return PATH.'/'.$uri;
	}
}

function redirect($uri = null, $msgTitle = null,$msg = null){

	if ($msgTitle) {
		$_SESSION['msgTitle'] = $msgTitle;
	}

	if ($msg) {
		$_SESSION['msg'] = $msg;
	}

	//IMPORTANTE PARA MANTER A SESSION NO REDIRECT
	session_write_close();

	//var_dump(strpos($uri, 'http'));exit;

	if (strstr($uri,'http')) {
		header('location:'.$uri);
	}
	else{
		if ($uri == null || $uri == '/') {
			header('location:'.PATH);
		}else{
			header('location:'.PATH.'/'.$uri);
		}
	}
}

function setMsg($msgTitle,$msg = null){

	$_SESSION['msgTitle'] = $msgTitle;

	if ($msg) {
		$_SESSION['msg'] = $msg;
	}
}

function getMsgTitle(){
	if (isset($_SESSION['msgTitle'])) {
		echo $_SESSION['msgTitle'];
		unset($_SESSION['msgTitle']);
	}else{
		return false;
	}
}

function deleteMsg(){
	unset($_SESSION['msgTitle']);
	unset($_SESSION['msg']);
}

function getMsg(){
	if (isset($_SESSION['msg'])) {
		echo $_SESSION['msg'];
		unset($_SESSION['msg']);
	}else{
		return false;
	}
}

function msg(){
	if (isset($_SESSION['msgTitle']) || isset($_SESSION['msg'])) {
		return true;
	}else{
		return false;
	}
}

function img($path){
	return PATH.'/img/'.$path;
}

// First image on array
function fImg($imagem)
{
	if ($imagem)
	{
		$imagem = explode(';', $imagem);

		return PATH.'/img/'.$imagem[0];
	}
	else
	{
		return false;
	}
}

function css($path)
{
	return PATH.'/css/'.$path;
}

function js($path)
{
	return PATH.'/js/'.$path;
}

function media($path)
{
	return PATH.'/media/'.$path;
}

function view($path){

	$path = str_replace('\\', DS,$path);
	$path = str_replace('/', DS, $path);
	
	require ROOT.DS.$path.".php";
}

function json($var = null){
	if ($var) {
		header("Content-type: application/json; charset=utf-8");
		return json_encode($var);
	}else{
		return false;
	}
}

function data($date){
	return date('d/m/Y à\s\ H:i:s',strtotime($date));
}

function reais($float){
	$string = number_format($float, 2, ',', '.');
	
	return $string;
}

function stringToUrl($campo) {

	$campo = (string)strtolower($campo); // Transforma tudo pra minúsculo

	$padraoreplace = "[^a-zA-Z0-9_]"; // Determina que apenas letras e números e underlines poderão existir

	$array_s = array("á" => "a", "à" => "a", "â" => "a", "ã" => "a", "ä" => "a", "é" => "e", "è" => "e", "ê" => "e", "ë" => "e", "í" => "i", "î" => "i", "ì" => "i", "ï" => "i", "ô" => "o", "õ" => "o", "ó" => "o", "ò" => "o", "ö" => "o", "ú" => "u", "ù" => "u", "û" => "u", "ü" => "u", "ñ" => "n", "ç" => "c", " " => "_"); // array de substituição

	$campo = strtr($campo, $array_s); // Substitui acentos e espaços

	$campo = preg_replace($padraoreplace, "", $campo); // Substitui caracteres especiais por caractere vazio

	return $campo; // Retorna campo
}

function stringToFloat($campo) {

	$filter1 = array("." => "");
	$filter2 = array("," => "."); // array de substituição

	$campo = strtr($campo, $filter1);
	$campo = strtr($campo, $filter2); // Substitui acentos e espaços

	return $campo; // Retorna campo
}

function remove_acentos($string){
	$map = array(
		'á' => 'a',
		'à' => 'a',
		'ã' => 'a',
		'â' => 'a',
		'é' => 'e',
		'ê' => 'e',
		'í' => 'i',
		'ó' => 'o',
		'ô' => 'o',
		'õ' => 'o',
		'ú' => 'u',
		'ü' => 'u',
		'ç' => 'c',
		'Á' => 'A',
		'À' => 'A',
		'Ã' => 'A',
		'Â' => 'A',
		'É' => 'E',
		'Ê' => 'E',
		'Í' => 'I',
		'Ó' => 'O',
		'Ô' => 'O',
		'Õ' => 'O',
		'Ú' => 'U',
		'Ü' => 'U',
		'Ç' => 'C'
	);

	return strtr($string, $map);
}