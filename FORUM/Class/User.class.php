<?php

	require_once('DataBase.class.php');
	


class User
{

	public $UserId;
	public $Name;
	public $Username;
	public $Email;
	public $Avatar;
	public $LastConnectionDatetime;

	function  __construct()
	{
		
	}

	public function getUserId()
	{
		return $this->UserId;
	}

	public function setUserId($id)
	{
		$this->UserId = $id;
	}

	public function getName()
	{
		return $this->Name;
	}

	public function setName($name)
	{
		$this->Name = $name;
	}

	public function getUsername()
	{
		return $this->Username;
	}

	public function setUsername($username)
	{
		$this->Username = $username;
	}

	public function getEmail()
	{
		return $this->Email;
	}

	public function setEmail($email)
	{
		$this->Email = $email;
	}

	public function getAvatar()
	{
		return $this->Avatar;
	}

	public function setAvatar($avatar)
	{
		$this->Avatar = $avatar;
	}

	public function getLastConnectionDatetime()
	{
		return $this->LastConnectionDatetime;
	}

	public function setLastConnectionDatetime($lastConnectionDatetime)
	{
		$this->LastConnectionDatetime = $lastConnectionDatetime;
	}

	public function SignUp($password)
	{
		$DB = new DataBase();
		$request = "INSERT INTO `user`(`id_user`, `full_name`, `email`, `avatar`, `username`, `password`) VALUES (NULL,?,?,?,?,?)";
		$param = array($this->Name,$this->Email,$this->Avatar,$this->Username,$password);
		return $DB->ExecuteData($request,$param);
	}

	public function SignIn($email,$password)
	{
		$DB = new DataBase();
		$request = "SELECT `id_user`, `full_name`, `email`, `avatar`, `username`, `lastconnection` FROM `user` WHERE `email`=? and `password`=?";
		$param = array($email,$password);
		return $DB->LoadData($request,$param);
	}

	public function ModifyInfo($name,$username,$avatar)
	{
		$request = "insert into user values(?,?,?,?,?,?,?,?)";
		
	}

	public function UpdateLastConnection($NewOne)
	{
		
	}

	public function ChangePassword($oldPassword,$newPassword)
	{

	}

	

	public function Find($Id)
	{
		
	}


}

?>