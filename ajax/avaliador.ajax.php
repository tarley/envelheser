<?php
	header("Content-Type: text/html; charset=ISO-8859-1", true);
	
	require_once '../init.php';
	
	$mysql = new MySQL();
	
	$avaliador = new Avaliador($mysql->link);
	
	if(isset($_GET['lista'])) {
		$retorno = "";
	
		$filtro = (isset($_POST['filtro'])) ? utf8_decode($_POST['filtro']) : "";
		$sortColumn = (isset($_POST['sortColumn'])) ? $_POST['sortColumn'] : "";
		$sortOrder = (isset($_POST['sortOrder'])) ? $_POST['sortOrder'] : "";
	
		$lista = $avaliador->getLista($filtro, $sortColumn, $sortOrder);
	
		for($i = 0; $i < sizeOf($lista); $i++) {
			$retorno .= ($retorno != "") ? "," : "";
			$retorno .= "{";
			$retorno .= "\"codigo\": " . $lista[$i]["Cod_Avaliador"] . ", ";
			$retorno .= "\"nome\": \"" . $lista[$i]["Nom_Avaliador"] . "\", ";
			$retorno .= "\"especialidade\": \"" . $lista[$i]["Nom_Especialidade"] . "\", ";
			$retorno .= "\"login\": \"" . $lista[$i]["Des_Login"] . "\"";
			$retorno .= "}";
		}
	
		echo "{ \"Collection\": ["  . $retorno . "]}";
	}
	
	//Este trecho deve ficar sempre no fim do arquivo
	$mysql->disconect();
?>