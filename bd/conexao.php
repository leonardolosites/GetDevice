<?php

require("config.php");

try {

	$conn = new PDO('mysql:host='.HOST.';dbname='.DB, USER, PASS);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (Exception $e) {
	echo "ERROR: ".$e->getMessage();
}

?>