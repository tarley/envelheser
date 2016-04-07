<?php
	header("Content-Type: text/html; charset=ISO-8859-1", true);
	
	require_once '../init.php';
	
	$mysql = new MySQL();	
	
	$cliente = new Cliente();
	
	
	//Este trecho deve ficar sempre no fim do arquivo
	$mysql->disconect();
?>