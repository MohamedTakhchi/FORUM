<?php

	require_once('DataBase.class.php');
	


class Category
{

	private $CategoryId;
	private $Name;
	private $More;
	private $CreationDate;

	function  __construct()
	{
		
	}

	public function getCategoryId()
	{
		return $this->CategoryId;
	}

	public function setCategoryId($id)
	{
		$this->CategoryId = $id;
	}

	public function getName()
	{
		return $this->Name;
	}

	public function setName($name)
	{
		$this->Name = $name;
	}
	public function getMore()
	{
		return $this->More;
	}

	public function setMore($more)
	{
		$this->More = $more;
	}
	public function getCreationDate()
	{
		return $this->CreationDate;
	}

	public function setCreationDate($creationdate)
	{
		$this->CreationDate = $creationdate;
	}

	public function getAll()
	{
		$DB = new DataBase();
		$request = "SELECT * FROM  `category`";
		return $DB->LoadData($request);
		
	}

	public function add()
	{
		$DB = new DataBase();
		$request = "INSERT INTO `category`(`id_category`, `name`, `description`) VALUES (NULL,?,?)";
		$param = array($this->Name,$this->More);
		return $DB->ExecuteData($request,$param);
	}

	


}

?>