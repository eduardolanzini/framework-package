<?php

namespace EduardoLanzini\Framework;

Class Validate
{

	public $errors = array();

	private $input = array();

	private $values = array();

	public function __construct($input = null)
	{
		if (is_array($input)) {
			$this->input = $input;
		}
		elseif(is_object($input)){
			$this->input = (array)$input;
		}
		else{
			exit('Erro ao validar');
		}
	}

	public function name($name)
	{
		$this->name = $name;

		if (array_key_exists($this->name,$this->input))
		{
			
			$this->setvalue($this->input[$this->name]);

			$this->values[$this->name] = $this->input[$this->name];
		}
		else
		{
			$this->errors[] = 'Parâmetro "'.$this->name.'" não existe.';
		}

		return $this;
	}

	public function insert($name,$value)
	{
		$this->name = $name;

		$this->setvalue($value);

		$this->values[$this->name] = $value;

		return $this;
	}

	public function add($name,$value)
	{
		$this->insert($name,$value);

		return $this;
	}

	public function get($input){
		if (isset($this->values[$input]) && $this->success()) {
			return $this->values[$input];
		}
		return false;
	}

	public function getInput(){

		return $this->input;
	}

	public function getValues(){

		return $this->values;
	}

	public function setValue($value)
	{
		$this->value = $value;

		return $this;
	}

	public function file($value)
	{
		$this->file = $value;
		return $this;
	}


	public function string(){
		if(!empty($this->value) && !filter_var($this->value)){
			$this->errors[] = "Formato de string inválido. ({$this->name})";
		}
		return $this;
	}

	public function array(){

		if (!is_array($this->value)) {
			$this->errors[] = "Formato de array inválido. ({$this->name})";
		}

		$this->values[$this->name] = serialize($this->values[$this->name]);

		return $this;
	}

	public function password(){
		if(!filter_var($this->value)){
			$this->errors[] = 'Formato de senha inválida.';
		}


		$this->values[$this->name] = password_hash($this->value, PASSWORD_DEFAULT);

		return $this;
	}

	public function int(){
		if(!filter_var($this->value, FILTER_VALIDATE_INT)){
			$this->errors[] = 'Formato inteiro inválido.';
		}
		return $this;
	}

	public function float(){
		if(!filter_var($this->value, FILTER_VALIDATE_FLOAT)){
			$this->errors[] = 'Formato FLOAT inválido.';
		}
		return $this;
	}

	public function money(){

		$money = str_replace('.','', $this->value);

		$money = str_replace(',', '.', $money);

		if(!filter_var((float)$money, FILTER_VALIDATE_FLOAT)){
			$this->errors[] = 'Formato de dinheiro inválido.';
		}

		$this->values[$this->name] = (float)$money;

		return $this;
	}

	public function email()
	{
		if(!filter_var($this->value, FILTER_VALIDATE_EMAIL)){
			$this->errors[] = 'Formato de e-mail inválido.';
		}
		return $this;
	}

	function datetime(){
		if(!filter_var($this->value) && !empty($this->value)){
			$this->errors[] = "Formato de data inválido. ({$this->name})";
		}
		$this->values[$this->name] = str_replace('T', ' ',$this->value);

		return $this;
	}

	public function required()
	{
		if((isset($this->file) && $this->file['error'] == 4) || ($this->value == '' || $this->value == null)){
			$this->errors[] = 'Campo "'.$this->name.'" obrigatório.';
		}            
		return $this;
	}

	public function min($length)
	{
		if(is_string($this->value)){

			if(strlen($this->value) < $length){
				$this->errors[] = 'Campo "'.$this->name.'" inferior ao valor mínimo';
			}
		}else{

			if($this->value < $length){
				$this->errors[] = 'Campo "'.$this->name.'" inferior ao valor mínimo';
			}
		}
		return $this;
	}

	public function max($length)
	{
		if(is_string($this->value))
		{
			if(strlen($this->value) > $length)
			{
				$this->errors[] = 'Campo "'.$this->name.'" inferior ao valor máximo';
			}
		}
		else
		{
			if($this->value > $length)
			{
				$this->errors[] = 'Campo "'.$this->name.'" inferior ao valor máximo';
			}

		}
		return $this;   
	}

	public function equal($value)
	{
		if($this->value != $value){
			$this->errors[] = 'O campo "'.$this->name.'" não corresponde';
		}
		return $this;
	}

	public function maxSize($size)
	{
		if($this->file['error'] != 4 && $this->file['size'] > $size){
			$this->errors[] = 'Il file '.$this->name.' supera o tamanho máximo de '.number_format($size / 1048576, 2).' MB.';
		}
		return $this;   
	}

	public function ext($extension)
	{
		if($this->file['error'] != 4 && pathinfo($this->file['name'], PATHINFO_EXTENSION) != $extension && strtoupper(pathinfo($this->file['name'], PATHINFO_EXTENSION)) != $extension){
			$this->errors[] = 'O arquivo '.$this->name.' não é um '.$extension.'.';
		}
		return $this; 
	}

	public function purify($string)
	{
		return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
	}

	public function regex($pattern)
	{
		$regex = '/^('.$pattern.')$/u';
		if($this->value != '' && !preg_match($regex, $this->value)){
			$this->errors[] = 'Campo "'.$this->name.'" inválido.';
		}
		return $this;
	}

	public function success()
	{
		if(empty($this->errors)){
			return $this->values;
		}else{
			return false;
		}
	}

	public function getErrors()
	{
		if(!$this->success()) return $this->errors;
	}

	public function displayErrors()
	{
		if(!$this->success()){
			$errors = '';

			foreach($this->getErrors() as $error)
			{
				$errors .= "<p>{$error}</p><br>";
			}

			return $errors;

		}else{
			return true;
		}
	}
}