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

		$query = "SELECT Cod_Cliente, Nom_Cliente, ";
		$query .= "(SELECT Num_Telefone FROM tb_telefone t WHERE t.Cod_Cliente = c.Cod_Cliente LIMIT 1) AS Num_Telefone, ";
		$query .= "co.Nom_Cor, e.Nom_Escolaridade, o.Nom_Ocupacao, ec.Nom_Estado_Civil, n.Nom_Naturalidade, ";
		$query .= "CASE WHEN c.Ind_Sexo = 'F' THEN 'Feminino' ELSE 'Masculino' END AS Ind_Sexo, ";
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
}

?>
