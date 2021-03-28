<?php

function statusContrato($status){

	switch ($status) {

		case 'Ativo':
		$status = "success";
		break;

		case 'Aguardando':
		$status = "warning";
		break;

		case 'Concluído':
		$status = "info";
		break;

		case 'Cancelado':
		$status = "danger";
		break;

		case 'Atrasado':
		$status = "danger";
		break;
	}

	return $status;
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