<?php
session_start(); 
$db = new mysqli("127.0.0.1", "root", "", "inventario");

if ($db->connect_errno) {
	die("Hemos encontrado un error");
}

$config = $db->query("SELECT * FROM config");

$config = $config->fetch_object();

?>