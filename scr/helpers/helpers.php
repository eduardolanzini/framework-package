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

function auth(){
	
	$auth = new EduardoLanzini\Framework\Auth;

	return $auth;
}

function middleware(){
	
	$middleware = new EduardoLanzini\Framework\Middleware;

	return $middleware;
}

function redirect($uri = null){

	//IMPORTANTE PARA MANTER A SESSION NO REDIRECT
	session_write_close();

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

	exit;
}

function back(){

	//IMPORTANTE PARA MANTER A SESSION NO REDIRECT
	session_write_close();

	header('location:'.LAST_URL);

	exit;
}

function toast($msg,$color = 'success'){
	$_SESSION['toast'] = $msg;
	$_SESSION['toastColor'] = $color;
}

function getToast(){

	if (isset($_SESSION['toast'])) {
		return $_SESSION['toast'];
	}

	return false;
}

function getToastColor(){

	if (isset($_SESSION['toastColor'])) {
		return $_SESSION['toastColor'];
	}

	return false;
}


function unsetToast(){
	unset($_SESSION['toast']);
	unset($_SESSION['toastColor']);
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
	}else{
		return false;
	}
}

function unsetMsg(){
	unset($_SESSION['msgTitle']);
	unset($_SESSION['msg']);
}

function getMsg(){
	if (isset($_SESSION['msg'])) {
		echo $_SESSION['msg'];
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

function storage($path = null){
	return PATH.'/storage/'.$path;
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

	/* VARIABLES NOT WORKING */ 
	$path = str_replace('\\', DS,$path);
	$path = str_replace('/', DS, $path);
	
	include ROOT.DS.'app'.DS.'views'.DS.$path.".php";
}

function json($var){

		header("Content-type: application/json; charset=utf-8");

		echo json_encode($var);

		exit;
}

function data($date){
	return date('d/m/Y',strtotime($date));
}

function dataHora($date){
	return date('d/m/Y à\s\ H:i:s',strtotime($date));
}

function hora($time){
	return date( 'H:i', strtotime($time));
}

function reais($float){
	$string = number_format((float)$float, 2, ',', '.');
	
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

function stringToFloat($s) {

	$filter1 = array("." => "");
	$filter2 = array("," => "."); // array de substituição

	$s = strtr($s, $filter1);
	$s = strtr($s, $filter2); // Substitui acentos e espaços

	return (float)$s;
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

function mes($mes){
	$map = array(
		'1' => 'Janeiro',
		'2' => 'Fevereiro',
		'3' => 'Março',
		'4' => 'Abril',
		'5' => 'Maio',
		'6' => 'Junho',
		'7' => 'Julho',
		'8' => 'Agosto',
		'9' => 'Setembro',
		'10' => 'Outubro',
		'11' => 'Novembro',
		'12' => 'Dezembro',
	);

	return strtr($mes, $map);
}

function elapsed_time(){

	$time = microtime(true) - $_SERVER["REQUEST_TIME_FLOAT"];

	$time = number_format($time, 2, ',', '.');

	return $time;
}

function datetime($dt){
	
	$dt = str_replace(' ', 'T',$dt);

	return $dt;
}

function googleMaps($end){

	$end = str_replace(['-',' ','_'],'+',$end);

	$link = "https://www.google.com.br/maps/place/{$end}";

	return $link;
}