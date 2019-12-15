<?php

	require_once('DataBase.class.php');
	


class Post
{

	private $PostId;
	private $Title;
	private $Body;
	private $Image;
	private $CreationDate;
	private $UserId;
	private $CategoryId;
	private $UserName;
	private $CategoryName;

	function  __construct()
	{
		
	}

	public function getPostId()
	{
		return $this->PostId;
	}

	public function setPostId($id)
	{
		$this->PostId = $id;
	}

	public function getTitle()
	{
		return $this->Title;
	}

	public function setTitle($title)
	{
		$this->Title = $title;
	}

	public function getBody()
	{
		return $this->Body;
	}

	public function setBody($body)
	{
		$this->Body = $body;
	}

	public function getImage()
	{
		return $this->Image;
	}

	public function setImage($image)
	{
		$this->Image = $image;
	}

	public function getCreationDate()
	{
		return $this->CreationDate;
	}

	public function setCreationDate($creationDate)
	{
		$this->CreationDate = $creationDate;
	}

	public function getUserId()
	{
		return $this->UserId;
	}

	public function setUserId($id)
	{
		$this->UserId = $id;
	}

	public function getCategoryId()
	{
		return $this->CategoryId;
	}

	public function setCategoryId($id)
	{
		$this->CategoryId = $id;
	}

	public function getUserName()
	{
		return $this->UserName;
	}

	public function setUserName($name)
	{
		$this->UserName = $name;
	}

	public function getCategoryName()
	{
		return $this->CategoryName;
	}

	public function setCategoryName($name)
	{
		$this->CategoryName = $name;
	}

	

	public function add()
	{
		$DB = new DataBase();
		$request = "INSERT INTO `topic`(`id_topic`, `title`, `body`, `image`, `id_user`, `id_category`) VALUES (NULL,?,?,?,?,?)";
		$param = array($this->Title,$this->Body,$this->Image,$this->UserId,$this->CategoryId);
		return $DB->ExecuteData($request,$param);
	}

	public function Find($Id)
	{
		$DB = new DataBase();
		$request = "SELECT id_topic,title,body,image,created_at,username,topic.id_user,avatar FROM `topic`,`user` where topic.id_user=user.id_user and id_topic=?";
		$param = array($Id);
		return $DB->LoadData($request,$param);
	}

	public function getAll()
	{
		$DB = new DataBase();
		$request = "SELECT id_topic,title,created_at,username,topic.id_user FROM `topic`,`user` where topic.id_user=user.id_user ORDER BY created_at DESC";
		return $DB->LoadData($request);
	}

	public function getAllByUser($id)
	{
		$DB = new DataBase();
		$request = "SELECT id_topic,title,created_at,username,topic.id_user FROM `topic`,`user` where topic.id_user=user.id_user and topic.id_user=? ORDER BY created_at DESC";
		$param = array($id);
		return $DB->LoadData($request,$param);
	}

	public function getSavedPost($idUser)
	{
		$DB = new DataBase();
		$request = "SELECT topic.id_topic,title,created_at,username,topic.id_user FROM `topic`,`user`,`saved` where topic.id_user=user.id_user and topic.id_topic=saved.id_topic and saved.id_user=? ORDER BY created_at DESC";
		$param = array($idUser);
		return $DB->LoadData($request,$param);
	}

	public function getSavedByCategory($idUser,$idCategory)
	{
		$DB = new DataBase();
		$request = "SELECT topic.id_topic,title,created_at,username,topic.id_user FROM `topic`,`user`,`saved` where topic.id_user=user.id_user and topic.id_topic=saved.id_topic and saved.id_user=? and id_category=? ORDER BY created_at DESC";
		$param = array($idUser,$idCategory);
		return $DB->LoadData($request,$param);
	}

	public function getByIdCategory($idCategory)
	{
		$DB = new DataBase();
		$request = "SELECT id_topic,title,created_at,username,topic.id_user FROM `topic`,`user` where topic.id_user=user.id_user and id_category=? ORDER BY created_at DESC";
		$param = array($idCategory);
		return $DB->LoadData($request,$param);
	}

	public function SavePost($idPost,$idUser)
	{
		$DB = new DataBase();
		$request = "INSERT INTO `saved`(`id_save`, `id_user`, `id_topic`) VALUES (NULL,?,?)";
		$param = array($idUser,$idPost);
		return $DB->ExecuteData($request,$param);
	}

	public function isSaved($idPost,$idUser)
	{
		$DB = new DataBase();
		$request = "SELECT * FROM `saved` where  id_topic=? and id_user=? ";
		$param = array($idPost,$idUser);
		if($DB->LoadData($request,$param) != null)
			return 1;
		else
			return 0;
	}

	public function getNumberPosts($id)
	{
		$DB = new DataBase();
		$request = "SELECT count(*) as numbre from topic WHERE id_user=?";
		$param = array($id);
		return $DB->LoadData($request,$param);
	}




}

?>