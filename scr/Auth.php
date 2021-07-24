<?php

namespace EduardoLanzini\Framework;

use EduardoLanzini\Framework\Acl;

Class Auth{

	private $permissions;

	public static function check($level = null)
	{
		if (isset($_SESSION['userLogged'])){
			if ($level){
				if ($_SESSION['userLogged']['level'] == $level){
					return true;
				}
				return false;
			}
			return true;
		}
		return false;
	}

	public static function getId()
	{
		if (isset($_SESSION['userLogged']['id'])){
			return $_SESSION['userLogged']['id'];
		}
		return false;
	}

	public static function getLevel()
	{
		if (isset($_SESSION['userLogged']['group_id'])){
			return $_SESSION['userLogged']['group_id'];
		}
		return false;
	}

	public static function login($user)
	{
		$_SESSION['userLogged'] = (array)$user;

		return true;
	}

	public static function logout()
	{
		unset($_SESSION['userLogged']);

		return true;
	}

	public static function hasPermission($permission,$userId = null,$groupId = null)
	{
		if(!$userId){
			$userId = self::get('id');
		}
		if(!$groupId){
			$groupId = self::get('group_id');
		}

		return Acl::check($permission,$userId,$groupId);
	}

	public static function can($permission,$userId = null,$groupId = null)
	{
		return self::hasPermission($permission,$userId,$groupId);
	}

	public static function get($value)
	{
		if (isset($_SESSION['userLogged'][$value])){
			return $_SESSION['userLogged'][$value];
		}

		return false;
	}
	/*
	public static function hasPermission($role)
	{
		if (isset($_SESSION['userLogged']['permissions'])){

			$roles = explode(';',$_SESSION['userLogged']['permissions']);

			if (in_array($role, $roles)) {
				return true;
			}
		}

		return false;
	}

	public static function updatePermissions($roles)
	{
		$_SESSION['userLogged']['permissions'] = $roles;
	}
	*/

	/*
	public static function get($value)
	{
		if (isset($_SESSION['userLogged'][$value])){
			return $_SESSION['userLogged'][$value];
		}

		return false;
	}

	public static function update($value,$new)
	{
		if (isset($_SESSION['userLogged'][$value])){
			$_SESSION['userLogged'][$value] = $new;
		}

		return false;
	}
	*/
}