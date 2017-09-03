<?php

//include ("phpconstant.php");
class databaseConnection extends SQLite3
{
	var $db;
	var $databasePath;
	function databaseConnection()
	{
		$this->databasePath= 'db.sqlite';
		$this->db = new SQLite3($this->databasePath);
	}

}
?>