<?php

Class Acl
{

	private $db;
	private $user_empty = false;


	function __construct() {
		$this->db = new db;
	}

	function check($permission,$userid,$group_id) {

		If(!$this->user_permissions($permission,$userid)) {
			return false;
		}

		if(!$this->group_permissions($permission,$group_id) & $this->IsUserEmpty()) {
			return false;
		}

		return true;

	}

	function user_permissions($permission,$userid) {
		$this->db->q("SELECT COUNT(*) AS count FROM user_permissions WHERE permission_name='$permission' AND userid='$userid' ");

		$f = $this->db->f();

		If($f['count']>0) {
			$this->db->q("SELECT * FROM user_permissions WHERE permission_name='$permission' AND userid='$userid' ");

			$f = $this->db->f();

			If($f['permission_type']==0) {
				return false;
			}

			return true;

		}

		$this->setUserEmpty('true');

		return true;

	}
	function group_permissions($permission,$group_id) {
		$this->db->q("SELECT COUNT(*) AS count FROM group_permissions WHERE permission_name='$permission' AND group_id='$group_id' ");

		$f = $this->db->f();

		if($f['count']>0) {
			$this->db->q("SELECT * FROM group_permissions WHERE permission_name='$permission' AND group_id='$group_id' ");

			$f = $this->db->f();

			If($f['permission_type']==0) {
				return false;
			}

			return true;

		}

		return true;

	}


	function setUserEmpty($val) {
		$this->userEmpty = $val;
	}

	function isUserEmpty() {
		return $this->userEmpty;
	}


}


/*

CREATE TABLE users (
 userid INT(10) NOT NULL AUTO_INCREMENT,
 group_id INT(10) NOT NULL,
 username VARCHAR(255) NOT NULL UNIQUE,
 password VARCHAR(255) NOT NULL,
 reg_date INT(10),
 PRIMARY KEY(userid)
);

CREATE TABLE usergroups (
 group_id INT(10) NOT NULL AUTO_INCREMENT,
 group_name VARCHAR(100) NOT NULL,
 PRIMARY KEY(group_id)
);

CREATE TABLE user_permissions (
 pid INT(10) NOT NULL AUTO_INCREMENT,
 permission_name VARCHAR(100) NOT NULL,
 permission_type INT(1),
 userid INT(10) NOT NULL,
 PRIMARY KEY (pid)
);

CREATE TABLE group_permissions (
 pid INT(10) NOT NULL AUTO_INCREMENT,
 permission_name VARCHAR(100) NOT NULL,
 permission_type INT(1),
 group_id INT(10) NOT NULL,
 PRIMARY KEY (pid)
);
*/

?>