<?php

class Cliente {
	/*
	* Instancia de Logger
	*/
	var $log;
	
	/*
	 * Instancia da conexão com o Banco
	 */
	var $cnn;	
	
	/**
	* Cria instancia de Logger para gerenciar exce��es.
	*/
	function __construct($cnn) {
		$this->log = new Logger();
		$this->cnn = $cnn;
	}
	
	/**
	* Retorna a lista de clientes baseada no nome passado pelo parametro
	*/	
	function getLista($input, $sortColumn = "", $sortOrder = "ASC") {
		$query = "SELECT Cod_Cliente, Nom_Cliente, Num_Rg, ";
		$query .= "(SELECT Num_Telefone FROM tb_telefone WHERE Cod_Cliente = c.Cod_Cliente LIMIT 1) as NumTelefone, ";
		$query .= "(SELECT DATE_FORMAT(Dta_Data_Prontuario, '%d/%m/%Y') AS Dta_Prontuario FROM tb_prontuario WHERE Cod_Cliente = c.Cod_Cliente ORDER BY Dta_Data_Prontuario DESC LIMIT 1) as DtaUltimoAtendimento ";
		$query .= "FROM tb_cliente c ";
		
		if($input != "")			
			$query .= "WHERE nom_cliente LIKE '%$input%' or Num_Rg LIKE '%$input%' ";
		
		if($sortColumn != "")
			$query .= "ORDER BY " . $sortColumn . " " . $sortOrder . " ";
		
		$query = mysqli_query($this->cnn, $query);

		$listaClientes = array();
		
		while($list  = mysqli_fetch_assoc($query)) {		
			$listaClientes[] = $list;
		}

		return $listaClientes;
	}
	
	/**
	* Retorna os dados do cliente de acordo com o codigo passado pelo parametro
	*/	
	function getDados($codCliente) {		
		
		$query = "SELECT Cod_Cliente, Nom_Cliente, Num_Rg, ";
		$query .= "(SELECT Num_Telefone FROM tb_telefone t WHERE t.Cod_Cliente = c.Cod_Cliente LIMIT 1) AS Num_Telefone, ";
		$query .= "co.Nom_Cor, co.Cod_Cor, e.Nom_Escolaridade, e.Cod_Escolaridade, o.Nom_Ocupacao, o.Cod_Ocupacao, ec.Nom_Estado_Civil, ec.Cod_Estado_Civil, n.Nom_Naturalidade, n.Cod_Naturalidade, ";
		$query .= "c.Ind_Sexo, ";
		$query .= "c.Num_Filhos, c.Des_Endereco, ";
		$query .= "DATE_FORMAT(c.Dta_Nascimento, '%d/%m/%Y') AS Dta_Nascimento ";
		$query .= "FROM tb_cliente c LEFT JOIN tb_cor co ON (c.Cod_Cor = co.Cod_Cor) ";
		$query .= "LEFT JOIN tb_escolaridade e ON (c.Cod_Escolaridade = e.Cod_Escolaridade) ";
		$query .= "LEFT JOIN tb_ocupacao o ON (c.Cod_Ocupacao = o.Cod_Ocupacao) ";
		$query .= "LEFT JOIN tb_estado_civil ec ON (c.Cod_Estado_Civil = ec.Cod_Estado_Civil) ";
		$query .= "LEFT JOIN tb_naturalidade n ON (c.Cod_Naturalidade = n.Cod_Naturalidade) ";
		$query .= "WHERE Cod_Cliente = $codCliente";
		
		$query = mysqli_query($this->cnn, $query);
		
		$cliente  = mysqli_fetch_assoc($query);	

		return $cliente;
	}
	
	/**
	 * Retorna a lista de prontuarios do cliente
	 */
	function getProntuarios($codCliente) {
		$query = "SELECT Num_Prontuario, ";
		$query .= "DATE_FORMAT(Dta_Data_Prontuario, '%d/%m/%Y') AS Dta_Prontuario ";
		$query .= "FROM tb_prontuario ";
		$query .= "WHERE Cod_Cliente = $codCliente ";
		$query .= "ORDER BY Dta_Data_Prontuario DESC ";
		$query .= "LIMIT 5";
		
		$query = mysqli_query($this->cnn, $query);
		
		if(!$query) {
			exit;
		}
		
		$listaProntuario = array();
		
		while($list  = mysqli_fetch_assoc($query)) {
			$listaProntuario[] = $list;
		}
		
		return $listaProntuario;		
	}
	
	function insert($c) {
		$retorno = array();
		try {
			
			$codCliente = "";
			
			if($c['Cod_Cliente'] != ""){
				
				$codCliente = $c['Cod_Cliente'];
				
				if($c['Dta_Nascimento'] != ""){
					$Dta_Nascimento = DateTime::createFromFormat("d/m/Y", $c['Dta_Nascimento']);
					$Dta_Nascimento = date_format($Dta_Nascimento, "Y-m-d");
				}
				else 
					$Dta_Nascimento = 'NULL';
				
				$Cod_Cor = 'NULL';
				$Cod_Escolaridade = 'NULL';
				$Cod_Ocupacao = 'NULL';
				$Cod_Estado_Civil = 'NULL';
				$Cod_Naturalidade = 'NULL';
					
				if($c['Cod_Cor'] != ''){
					$Cod_Cor = $c['Cod_Cor'];
				}
				
				if($c['Cod_Escolaridade'] != ''){
					$Cod_Escolaridade = $c['Cod_Escolaridade'];
				}
				
				if($c['Cod_Ocupacao'] != ''){
					$Cod_Ocupacao = $c['Cod_Ocupacao'];
				}
				
				if($c['Cod_Estado_Civil'] != ''){
					$Cod_Estado_Civil = $c['Cod_Estado_Civil'];
				}
				
				if($c['Cod_Naturalidade'] != ''){
					$Cod_Naturalidade = $c['Cod_Naturalidade'];
				}
					
				$query = "UPDATE tb_cliente ";
				$query .= "SET  ";
				$query .= "Nom_Cliente = '" . $c['Nom_Cliente'] . "', ";
				$query .= "Dta_Nascimento = '" . $Dta_Nascimento. "', ";
				$query .= "Num_Rg = '" . $c['Num_Rg'] . "', ";
				$query .= "Des_Endereco = '" . $c['Des_Endereco'] . "', ";
				$query .= "Ind_Sexo = '" . $c['Ind_Sexo'] . "', ";
				$query .= "Num_Filhos = " . $c['Num_Filhos'] . ", ";
				$query .= "Cod_Cor = " . $Cod_Cor . ", ";
				$query .= "Cod_Escolaridade = " . $Cod_Escolaridade . ", ";
				$query .= "Cod_Ocupacao = " . $Cod_Ocupacao . ", ";
				$query .= "Cod_Estado_Civil = " . $Cod_Estado_Civil . ", ";
				$query .= "Cod_Naturalidade = " . $Cod_Naturalidade . " ";
				$query .= "WHERE Cod_Cliente = " . $c['Cod_Cliente'] . "; ";
				
				if (mysqli_query($this->cnn, $query)) {
					$retorno['Sucesso'] = true;
					$retorno['Mensagem'] = "Dados atualizados com sucesso";
					$retorno['CodCliente'] = $codCliente;
				}
				else{
					throw new Exception(mysqli_error($this->cnn), mysqli_errno($this->cnn));
				}
			}
			else{
				
				$Nom_Cliente = 'NULL';
				$Dta_Nascimento = 'NULL';
				$Num_Rg = 'NULL';
				$Des_Endereco = 'NULL';
				$Ind_Sexo = 'NULL';
				$Num_Filhos = 'NULL';
				$Cod_Cor = 'NULL';
				$Cod_Escolaridade = 'NULL';
				$Cod_Ocupacao = 'NULL';
				$Cod_Estado_Civil = 'NULL';
				$Cod_Naturalidade = 'NULL';
				
				if($c['Nom_Cliente'] != ''){
					$Nom_Cliente = "'".$c['Nom_Cliente']."'";
				}
				
				if($c['Dta_Nascimento'] != ''){
					$Dta_Nascimento = DateTime::createFromFormat("d/m/Y", $c['Dta_Nascimento']);
					$Dta_Nascimento = date_format($Dta_Nascimento, "Y-m-d");
				}
					
				if($c['Num_Rg'] != ''){
					$Num_Rg = "'".$c['Num_Rg']."'";
				}
				
				if($c['Des_Endereco'] != ''){
					$Des_Endereco = "'".$c['Des_Endereco']."'";
				}
				
				if($c['Ind_Sexo'] != ''){
					$Ind_Sexo = "'".$c['Ind_Sexo']."'";
				}
				
				if($c['Num_Filhos'] != ''){
					$Num_Filhos = $c['Num_Filhos'];
				}
				
				if($c['Cod_Cor'] != ''){
					$Cod_Cor = $c['Cod_Cor'];
				}
				
				if($c['Cod_Escolaridade'] != ''){
					$Cod_Escolaridade = $c['Cod_Escolaridade'];
				}
				
				if($c['Cod_Ocupacao'] != ''){
					$Cod_Ocupacao = $c['Cod_Ocupacao'];
				}
				
				if($c['Cod_Estado_Civil'] != ''){
					$Cod_Estado_Civil = $c['Cod_Estado_Civil'];
				}
				
				if($c['Cod_Naturalidade'] != ''){
					$Cod_Naturalidade = $c['Cod_Naturalidade'];
				}
				
				$query = "INSERT INTO `tb_cliente`(`Nom_Cliente`, `Dta_Nascimento`, `Num_Rg`, `Des_Endereco`, `Ind_Sexo`, `Num_Filhos`, `Cod_Cor`, `Cod_Escolaridade`, `Cod_Ocupacao`, `Cod_Estado_Civil`, `Cod_Naturalidade`) ";
				$query .= "VALUES (".$Nom_Cliente.", '" . $Dta_Nascimento ."', ".$Num_Rg.", ".$Des_Endereco.", ".$Ind_Sexo.", ".$Num_Filhos.", ".$Cod_Cor.", ".$Cod_Escolaridade.", ".$Cod_Ocupacao.", ".$Cod_Estado_Civil.", ".$Cod_Naturalidade."); ";
				
				if (mysqli_query($this->cnn, $query)) {
					$retorno['Sucesso'] = true;
					$retorno['Mensagem'] = "Dados inseridos com sucesso";
					$retorno['CodCliente'] = $codCliente;
				}
				else{
					throw new Exception(mysqli_error($this->cnn), mysqli_errno($this->cnn));
				}
			}
		} catch (Exception $e) {
			$msg = "Falha ao inserir respostas. Mensagem de erro: " . mysqli_error($this->cnn);
			$this->log->logError($this,$msg);			
			
			$retorno['Sucesso'] = false;			
			$retorno['Mensagem'] = "Falha ao inserir respostas";
		}
		
		return $retorno;
	}
}

?>
