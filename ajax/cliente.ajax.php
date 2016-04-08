<?php
	header("Content-Type: text/html; charset=ISO-8859-1", true);
	
	require_once '../init.php';
	
	$mysql = new MySQL();	
	
	$cliente = new Cliente();
	
	if(isset($_GET['term'])) {		
		$retorno = "";
		
		$lista = $cliente->getLista($mysql->link, utf8_decode($_GET['term']));		
		for($i = 0; $i < sizeOf($lista); $i++) {
			
			$retorno .= ($retorno != "") ? "," : "";
			$retorno .= "{";
			$retorno .= "\"codigo\": " . $lista[$i]["Cod_Cliente"] . ", ";
			$retorno .= "\"nome\": \"" . $lista[$i]["Nom_Cliente"] . "\", ";
			$retorno .= "\"NumRg\": \"" . $lista[$i]["Num_Rg"] . "\"";
			$retorno .= "}";
		}
		
		echo "[" . $retorno . "]";
		
	} else if(isset($_GET['codigo'])) {
		$dados = $cliente->getDados($mysql->link, $_GET['codigo']);
		$pront = $cliente->getProntuarios($mysql->link, $dados['Cod_Cliente']);
		
		$retorno = "{";
		$retorno .= "\"codigo\": " . $dados['Cod_Cliente'] . ", ";
		$retorno .= "\"nome\": \"" . $dados['Nom_Cliente'] . "\", ";
		$retorno .= "\"telefone\": \"" . $dados['Num_Telefone'] . "\", ";
		$retorno .= "\"cor\": \"" . $dados['Nom_Cor'] . "\", ";
		$retorno .= "\"escolaridade\": \"" . $dados['Nom_Escolaridade'] . "\", ";
		$retorno .= "\"ocupacao\": \"" . $dados['Nom_Ocupacao'] . "\", ";
		$retorno .= "\"estadoCivil\": \"" . $dados['Nom_Estado_Civil'] . "\", ";
		$retorno .= "\"naturalidade\": \"" . $dados['Nom_Naturalidade'] . "\", ";
		$retorno .= "\"sexo\": \"" . $dados['Ind_Sexo'] . "\", ";
		$retorno .= "\"dataNascimento\": \"" . $dados['Dta_Nascimento'] . "\", ";
		$retorno .= "\"numeroFilhos\": \"" . $dados['Num_Filhos'] . "\", ";
		$retorno .= "\"endereco\": \"" . $dados['Des_Endereco'] . "\"; ";
		
		
		$jsonPront = "";
		for ($i = 0; $i < sizeof($pront); $i++) {
			$jsonPront .= ($jsonPront != "") ? "," : "";
			$jsonPront .= "{";
			$jsonPront .= "\"NumProntuario\": " .$pront[$i]['Num_Prontuario'] . ", ";
			$jsonPront .= "\"DtaProntuario\": \"" .$pront[$i]['Dta_Data_Prontuario'] . "\" ";
			$jsonPront .= "}";
		}
		
		$retorno .= "\"prontuario\": [". $jsonPront ."]";
		
		$retorno .= "}";
		
		echo $retorno;
	}
	
	
	//Este trecho deve ficar sempre no fim do arquivo
	$mysql->disconect();
?>