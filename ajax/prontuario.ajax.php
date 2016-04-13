<?php
	header("Content-Type: text/html; charset=ISO-8859-1", true);
	
	require_once '../init.php';
	
	$mysql = new MySQL();	
	
	$prontuario = new Prontuario($mysql->link);
	
	if(isset($_GET['numProntuario'])) {
		$listaRespostas = $prontuario->getRespostas(utf8_decode($_GET['numProntuario']));
		
		echo json_encode($listaRespostas);	
		
	} elseif (isset($_POST['listaRespostas'])) {		
		$codCliente = $_POST['CodCliente'];
		$listaRespostas = json_decode(stripslashes($_POST['listaRespostas']), true);
		$retorno = $prontuario->insertRespostas($codCliente, $listaRespostas);
		
		echo json_encode($retorno);		
	}
		
	//Este trecho deve ficar sempre no fim do arquivo
	$mysql->disconect();
?>