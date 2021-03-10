<?php

namespace EduardoLanzini\Framework;

Class Auth{

	public static function check($level = null)
	{
		if (isset($_SESSION['userId']) && isset($_SESSION['userLv']))
		{
			if ($level)
			{
				if ($_SESSION['userLv'] == $level)
				{
					return true;
				}
				return false;
			}
			return true;
		}
		else
		{
			return false;
		}
	}

	public static function lv()
	{
		if (isset($_SESSION['userLv']))
		{
			return $_SESSION['userLv'];
		}
		return false;
	}

	public static function getId()
	{
		if (isset($_SESSION['userId']))
		{
			return $_SESSION['userId'];
		}
		return false;
	}
}