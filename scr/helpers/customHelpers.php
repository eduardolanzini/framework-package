<?php


function getProdutoColor($id){

	switch ($id) {

		case '1':
		return 'success';
		break;

		case '2':
		return 'danger';
		break;

		case '3':
		return 'warning';
		break;

		default:
		return 'info';
		break;
	}
}

function getProdutoNome($id){

	switch ($id) {

		case '1':
		return 'Ativo';
		break;

		case '2':
		return 'Inativo';
		break;

		case '3':
		return 'Esgotado';
		break;

		default:
		return 'info';
		break;
	}
}

function categoriaStatus($id){

	switch ($id) {

		case '0':
		return 'Inativo';
		break;

		case '1':
		return 'Ativo';
		break;

		default:
		return 'Erro';
		break;
	}
}

function categoriaStatusColor($id){

	switch ($id) {

		case '0':
		return 'danger';
		break;

		case '1':
		return 'success';

		break;

		default:
		return 'info';
		break;
	}
}

function prazoEntrega($v){
	switch ($v) {
		case 1:
		return '10 minutos';
		break;

		case 2:
		return '20 minutos';
		break;

		case 3:
		return '30 minutos';
		break;

		case 4:
		return '40 minutos';
		break;


		case 5:
		return '50 minutos';
		break;

		case 6:
		return '1 hora';
		break;

		case 7:
		return '1 hora e 10 minutos';
		break;

		case 8:
		return '1 hora e 20 minutos';
		break;

		case 9:
		return '1 hora e 30 minutos';
		break;

		case 10:
		return '1 hora e 40 minutos';
		break;

		case 11:
		return '1 hora e 50 minutos';
		break;

		case 12:
		return '2 horas';
		break;

		default:
		return '---';
		break;
	}
}

function getSemana($num){

	switch ($num) {
		case 1:
		return 'segunda';
		break;

		case 2:
		return 'terca';
		break;

		case 3:
		return 'quarta';
		break;

		case 4:
		return 'quinta';
		break;

		case 5:
		return 'sexta';
		break;

		case 6:
		return 'sabado';
		break;

		case 7:
		return 'domingo';
		break;

		default:
		return 'erro';
		break;
	}
}