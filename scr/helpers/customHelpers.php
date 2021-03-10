<?php

use Core\Log;

function dd($v){
	echo "<pre>";
	print_r($v);
	exit;
}

function url($uri = null){
	if ($uri == null || $uri == '/') {
		return PATH;
	}else{
		return PATH.'/'.$uri;
	}
}

function environment(){
	return 'local';
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
			header('location:'.HTML);
		}else{
			header('location:'.HTML.'/'.$uri);
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

function img($path = null){
	if ($path) {
		return PATH.'/img/'.$path;
	}else{
		return false;
	}
}

// First image on array
function fImg($imagem){

	if ($imagem) {

		$imagem = explode(';', $imagem);

		return PATH.'/img/'.$imagem[0];
	}else{
		return false;
	}
}
function css($path = null){
	if ($path) {
		return PATH.'/css/'.$path;
	}else{
		return false;
	}
}

function js($path = null){
	if ($path) {
		return PATH.'/js/'.$path;
	}else{
		return false;
	}
}

function media($path = null){
	if ($path) {
		return PATH.'/media/'.$path;
	}else{
		return false;
	}
}

function view($path){

	$path = str_replace('\\', DS,$path);
	$path = str_replace('/', DS, $path);
	
	include VIEW.DS.$path.".php";
}


/*function view($path = null){

	$path = str_replace('\\', DS,$path);

	$path = str_replace('/', DS, $path);

	if ($path) {
		require VIEW.DS.$path.'.php';
	}else{
		return false;
	}
}*/

function json($var = null){
	if ($var) {
		header("Content-type: application/json; charset=utf-8");
		return json_encode($var);
	}else{
		return false;
	}
}

function token(){
	echo TOKEN;
}

function data($date){
	return date('d/m/Y à\s\ H:i:s',strtotime($date));
}

function reais($float){
	$string = number_format($float, 2, ',', '.');
	
	return $string;
}

function stringToUrl($campo) {

	$campo = strtolower($campo); // Transforma tudo pra minúsculo

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



function getstatus($status){

	switch ($status) {

		case '1':
		$status = "Aguardando pagamento"; //LARANJA
		break;

		case '2':
		$status = "Em análise"; // AMARELO
		break;

		case '3':
		$status = "Pago"; // VERDE
		break;

		case '4':
		$status = "Disponível"; //AZUL
		break;

		case '5':
		$status = "Em disputa"; //LARANJA
		break;

		case '6':
		$status = "Devolvida"; //VERMELHO
		break;

		case '7':
		$status = "Cancelada"; //VERMELHO
		break;

		case '8':
		$status = "Debitado"; //LARANJA
		break;

		case '9':
		$status = "Retenção temporária"; //VERMELHO
		break;

	}

	return $status;
}

function getstatusFrete($status){

	switch ($status) {

		case '0':
		$status = "Nulo";
		break;

		case '1':
		$status = "Aguardando envio";
		break;

		case '2':
		$status = "A caminho";
		break;

		case '3':
		$status = "Entregue";
		break;

		case '4':
		$status = "Cancelado";
		break;

		default:
		$status = "Sem Status definido";
		Log::alert();
	}

	return $status;
}

function getstatusColor($status){

	switch ($status) {

		case '1':
		$status = "orange-text";
		break;

		case '2':
		$status = "orange-text"; // AMARELO
		break;

		case '3':
		$status = "green-text"; // VERDE
		break;

		case '4':
		$status = "blue-text"; //AZUL
		break;

		case '5':
		$status = "orange-text"; //LARANJA
		break;

		case '6':
		$status = "red-text"; //VERMELHO
		break;

		case '7':
		$status = "red-text"; //VERMELHO
		break;

		case '8':
		$status = "orange-text"; //LARANJA
		break;

		case '9':
		$status = "red-text"; //VERMELHO
		break;

	}

	return $status;
}

function getStatusFreteColor($status){

	switch ($status) {

		case '0':
		$status = "orange-text";
		break;

		case '1':
		$status = "orange-text";
		break;

		case '2':
		$status = "green-text"; // AMARELO
		break;

		case '3':
		$status = "green-text"; // VERDE
		break;

		case '4':
		$status = "red-text"; //AZUL
		break;
	}

	return $status;
}

function formataData($data){

	//FORMATOS DE DATE
	//https://www.php.net/manual/pt_BR/function.date.php

	$datetime = new DateTime($data);

	$diaHoje = $datetime->format('j');
	$array_meses = array(1 => "Janeiro", 2 => "Fevereiro", 3 => "Março", 4 => "Abril", 5 => "Maio", 6 => "Junho",
		7 => "Julho", 8 => "Agosto", 9 => "Setembro", 10 => "Outubro", 11 => "Novembro", 12 => "Dezembro");

	$horaAgora = $datetime->format('H:i');
	$mesgetdate = $datetime->format('n');
	$anoAtual = date('Y');

	return $diaHoje.' de '.$array_meses[$mesgetdate].' de '.$anoAtual.', às '.$horaAgora.'.';
	
}

function rastreamento($cod){

	return 'https://linketrack.com/track?codigo='.$cod;

	//return 'https://www.linkcorreios.com.br/'.$cod;
}