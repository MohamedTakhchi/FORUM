<?php

	require_once('DataBase.class.php');
	


class User
{

	private $UserId;
	private $Name;
	private $Username;
	private $Email;
	private $Avatar;
	private $LastConnectionDatetime;

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
		$result = $DB->LoadData($request,$param);
		if ($result==null) {
			return null;
		}
		else{
			$this->UpdateLastConnection($result[0]);
			return $result;
		}
		
	}

	public function UpdateLastConnection($id)
	{
		$DB = new DataBase();
		$request = "UPDATE `user` SET `lastconnection`=CURRENT_TIMESTAMP() WHERE `id_user`=? ";
		$param = array($id);
		$DB->ExecuteData($request,$param);
		
	}

	public function ModifyInfo()
	{
		$DB = new DataBase();
		$request = "UPDATE `user` SET `full_name`=?,`avatar`=?,`username`=? WHERE `id_user`=?";
		$param = array($this->Name,$this->Avatar,$this->Username,$this->UserId);
		return $DB->ExecuteData($request,$param);
		
	}

	public function isPasswordCorrect($password)
	{
		$DB = new DataBase();
		$request = "	SELECT id_user FROM user WHERE id_user=? and password=?";
		$param = array($this->UserId,$password);
		if($DB->LoadData($request,$param)!=null){
			return 0;
		}
		else
			return -1;
	}

	public function ChangePassword($password)
	{
		$DB = new DataBase();
		$request = "UPDATE `user` SET `password`=? WHERE `id_user`=?";
		$param = array($password,$this->UserId);
		return $DB->ExecuteData($request,$param);
	}

	

	public function Find($id)
	{
		$DB = new DataBase();
		$request = "SELECT `id_user`, `full_name`, `email`, `avatar`, `username`, `lastconnection` FROM `user` WHERE `id_user`=? ";
		$param = array($id);
		return $DB->LoadData($request,$param);
	}


}

?>