<?php

namespace EduardoLanzini\Framework;

Class Config{

	private $path,$email,$groups,$db;

	public function getDB(){

		if (empty($this->db['database']) || empty($this->db['user'])) {
			return false;
		}
		
		return $this->db;
	}

	public function getRoot(){
		return $this->root;
	}

	public function getPath(){
		return $this->path;
	}

	public function getEmail(){
		return $this->email;
	}

	public function setRoot($root){
		$this->root = $root;
	}

	public function setPath($path){
		$this->path = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].$path;
	}

	public function setGroups(array $groups)
	{
		$this->groups = $groups;
	}

	public function getGroups()
	{
		return $this->groups;
	}

	public function setDB($db){
		$this->db = $db;
	}

	public function setEmail($email)
	{
		$this->email = $email;
	}

	public function showErrors(bool $bool)
	{
		if ($bool) {
			error_reporting(E_ALL);
			ini_set("display_errors", 1);
		}else{
			error_reporting(0);
			ini_set("display_errors", 0);
		}
	}

	public function setTimezone($timezone)
	{
		date_default_timezone_set($timezone);
	}

}