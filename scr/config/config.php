<?php

// ----------------------------------
// |     GENERAL CONFIGURATIONS     |
// ----------------------------------

// true OR false
$config->showErrors(true);

//local OR production
$config->setEnvironment('local');

//www.php.net/manual/pt_BR/timezones.php
$config->setTimezone("America/Sao_Paulo");

// ----------------------------------
// |     URL CONFIGURATIONS       |
// ----------------------------------

$config->setLocalPath('http://localhost');
$config->setProductionPath("");

// ----------------------------------
// |      DATABASE CONFIGURATIONS       |
// ----------------------------------

$config->useDb = false;

$config->localDB = [
	'driver' => 'mysql',
	'host' => 'localhost',
	'port' => '3306',
	'charset' => 'charset=utf8;',
	'database' => '',
	'user' => '',
	'pass' => ''
];

$config->productionDB = [
	'driver' => 'mysql',
	'host' => 'localhost',
	'port' => '3306',
	'charset' => 'charset=utf8;',
	'database' => '',
	'user' => '',
	'pass' => ''
];

// ----------------------------------
// |      USER CONFIGURATIONS       |
// ----------------------------------

$config->setEmail('');