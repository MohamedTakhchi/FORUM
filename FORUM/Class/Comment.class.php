<?php

	require_once('DataBase.class.php');
	


class Comment
{

	private $CommentId;
	private $Body;
	private $CreationDate;
	private $PostId;
	private $UserId;

	function  __construct()
	{
		
	}

	public function getCommentId()
	{
		return $this->CommentId;
	}

	public function setCommentId($id)
	{
		$this->CommentId = $id;
	}

	public function getBody()
	{
		return $this->Body;
	}

	public function setBody($body)
	{
		$this->Body = $body;
	}
	public function getCreationDate()
	{
		return $this->CreationDate;
	}

	public function setCreationDate($creationdate)
	{
		$this->CreationDate = $creationdate;
	}
	public function getPostId()
	{
		return $this->PostId;
	}

	public function setPostId($postId)
	{
		$this->PostId = $postId;
	}
	public function getUserId()
	{
		return $this->UserId;
	}

	public function setUserId($userId)
	{
		$this->UserId = $userId;
	}

	public function getAllByPost($idPost)
	{
		$DB = new DataBase();
		$request = "SELECT comment.*,username,avatar FROM  `comment`,`user` where comment.id_user=user.id_user and id_topic=? ORDER BY created_at DESC";
		$param = array($idPost);
		return $DB->LoadData($request,$param);
		
	}

	public function add()
	{
		$DB = new DataBase();
		$request = "INSERT INTO `comment`(`id_comment`, `body`, `id_user`, `id_topic`) VALUES (NULL,?,?,?)";
		$param = array($this->Body,$this->UserId,$this->PostId);
		return $DB->ExecuteData($request,$param);
	}

	public function getNumberComments($id)
	{
		$DB = new DataBase();
		$request = "SELECT count(*) as numbre from comment WHERE id_user=?";
		$param = array($id);
		return $DB->LoadData($request,$param);
	}

	


}

?>