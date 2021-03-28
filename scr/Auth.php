<?php

namespace EduardoLanzini\Framework;

Class Auth{

	public static function check($level = null)
	{
		if (isset($_SESSION['userLogged']))
		{
			if ($level)
			{
				if ($_SESSION['userLogged']['level'] == $level)
				{
					return true;
				}
				return false;
			}
			return true;
		}
		return false;
	}

	public static function getLevel()
	{
		if (isset($_SESSION['userLogged']['level']))
		{
			return $_SESSION['userLogged']['level'];
		}
		return false;
	}

	public static function getId()
	{
		if (isset($_SESSION['userLogged']['id']))
		{
			return $_SESSION['userLogged']['id'];
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
		//$roles = explode(';',$roles);

		//$roles = implode(';',$roles);

		//dd($roles);
		$_SESSION['userLogged']['permissions'] = $roles;
	}

	public static function get($value)
	{
		if (isset($_SESSION['userLogged'][$value])){
			return $_SESSION['userLogged'][$value];
		}

		return false;
	}
}