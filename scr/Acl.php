<?php

namespace EduardoLanzini\Framework;

use EduardoLanzini\DB;
use EduardoLanzini\Auth;

// ACCESS CONTROL LIST

Class Acl
{
	private static $user_permissions, $group_permissions;

	public static function check($permission,$user_id,$group_id)
	{
		If(self::user_permissions($permission,$user_id)) {
			return true;
		}

		if(self::group_permissions($permission,$group_id)) {
			return true;
		}

		return false;
	}

	private static function user_permissions($permission,$user_id) {


		if(!empty(self::$user_permissions)){

			if(
				self::$user_permissions->id == $user_id &&
				self::$user_permissions->name == $permission &&
				self::$user_permissions->value == 'true'

			)
			{
				return true;
			}
		}

		$p = DB::table('user_permissions')
		->where('name',$permission)
		->find('user_id',$user_id);

		self::$user_permissions = $p;

		if($p){
			If($p->value) {
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

	static function group_permissions($permission,$group_id) {

		if(!empty(self::$group_permissions)){

			if
				(
					self::$group_permissions->id == $group_id &&
					self::$group_permissions->name == $permission

				)
			{
				return true;
			}
		}

		$p = DB::table('group_permissions')
		->where('name',$permission)
		->where('group_id',$group_id)
		//->orWhere('name','*')
		//->where('group_id','1')
		->find();

		self::$group_permissions = $p;

		if($p){

			//FUTURAMENTE $p->value
			If($p) { 
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

}


/*

CREATE TABLE IF NOT EXISTS users (
 userid INT(10) NOT NULL AUTO_INCREMENT,
 group_id INT(10) NOT NULL,
 username VARCHAR(255) NOT NULL UNIQUE,
 password VARCHAR(255) NOT NULL,
 reg_date INT(10),
 PRIMARY KEY(userid)
);

CREATE TABLE IF NOT EXISTS user_groups (
 group_id INT(10) NOT NULL AUTO_INCREMENT,
 group_name VARCHAR(100) NOT NULL,
 PRIMARY KEY(group_id)
);

CREATE TABLE IF NOT EXISTS user_permissions (
 pid INT(10) NOT NULL AUTO_INCREMENT,
 permission_name VARCHAR(100) NOT NULL,
 permission_type INT(1),
 userid INT(10) NOT NULL,
 PRIMARY KEY (pid)
);

CREATE TABLE IF NOT EXISTS group_permissions (
 pid INT(10) NOT NULL AUTO_INCREMENT,
 permission_name VARCHAR(100) NOT NULL,
 permission_type INT(1),
 group_id INT(10) NOT NULL,
 PRIMARY KEY (pid)
);
*/

?>