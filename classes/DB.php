<?php
	class DB {
		public static function connect()
		{
			$connection = new PDO('mysql:host=localhost;dbname=mbo-open;charset=utf8',
			'root', '');
			return $connection;
		}
	}
?>