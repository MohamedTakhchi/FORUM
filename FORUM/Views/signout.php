<?php
	require_once('../Class/DataBase.class.php');
	session_start();
	$DB = new DataBase();
	echo "string";
	$DB->Disconnect();
?>
	<script type="text/javascript"> 
        window.location="index.php";
    </script>