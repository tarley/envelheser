<?php
	header("Content-Type: text/html; charset=ISO-8859-1", true);
	
	require_once '../init.php';
	
	$mysql = new MySQL();	
	
	$prontuario = new Prontuario();
	
	if(isset($_GET['numProntuario'])) {
			
		$lista = $prontuario->getDados($mysql->link, utf8_decode($_GET['numProntuario']));
		
			echo json_encode($lista);			
	}
	
	elseif ($_POST['']){
		
	}
		
	//Este trecho deve ficar sempre no fim do arquivo
	$mysql->disconect();
?>