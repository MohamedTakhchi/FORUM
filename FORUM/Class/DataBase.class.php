<?php

class DataBase
{
    private $Connection;
    private $PreparedStatement;
    private $ResultSet;
    private $Error;
    private $DB_host = "localhost";
    private $DB_user_name = "root";
    private $DB_user_password = "";
    private $DB_driver = "mysql";
    private $DB_database = "forumdb";

    function __construct()
    {
        try {
            if (is_null($this->Connection) || empty($this->Connection)) {
                $this->Connection = new PDO($this->DB_driver.':host='.$this->DB_host.';dbname='.$this->DB_database, $this->DB_user_name, $this->DB_user_password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'));
            }
        } catch (Exception $e) {
            $this->Error = 'ERREUR lors l\'ouverture du connexion => ' . $e->getFile() . ' L.' . $e->getLine() . ' : ' . $e->getMessage();
            die($this->Error);
        }
    }

    public function getConnection()
    {
        return $this->Connection;
    }

    public function Disconnect()
    {
        session_destroy();
    }

    public function LoadData($request,$param=null)
    {
        $this->PreparedStatement=$this->Connection->prepare($request);
        $this->ResultSet=$this->PreparedStatement->execute($param);
        if ($this->PreparedStatement->rowCount()==0) {
            return null;
        }
        else {
            return $this->PreparedStatement->fetchAll();
        }
    }

    public function ExecuteData($request,$param=null)
    {
        $this->PreparedStatement=$this->Connection->prepare($request);
        $execution=$this->PreparedStatement->execute($param);
        if ($execution) {
            return 0;
        }
        else {
            return -1;
        }
    }
}
?>