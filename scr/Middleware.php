<?php

namespace EduardoLanzini\Framework;

use EduardoLanzini\Framework\Auth;

Class Middleware
{
	public static function checkPermission($permission)
	{
		if (Auth::hasPermission($permission)) {
			return true;
		}else{
			http_response_code(403);
			setMsg('Acesso não permitido');
			redirect('login');

			return false;
		}
	}
}

?>