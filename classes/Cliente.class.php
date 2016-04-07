<?php

class Cliente {
	/*
	* Instância de Logger
	*/
	var $log;
	
	/**
	* Cria instancia de Logger para gerenciar exceções.
	*/
	function Cliente() {
		$this->log = new Logger();
	}
	
	/**
	* Retorna a lista de clientes baseada no nome passado pelo parâmetro
	*/	
	function getLista($cnn, $nomCliente) {
		$query = "SELECT Cod_Cliente, Nom_Cliente, ";
		$query .= "(SELECT Num_Telefone FROM tb_telefone t WHERE t.Cod_Cliente = c.Cod_Cliente LIMIT 1) AS Num_Telefone ";
		$query .= "FROM tb_cliente c WHERE nom_cliente LIKE '%$nomCliente%'";
		
		$query = mysqli_query($cnn, $query);

		$listaClientes = array();
		
		while($list  = mysqli_fetch_assoc($query)) {
			$listaClientes[] = $list;
		}

		return $listaClientes;
	}
	
	/**
	* Retorna os dados do cliente de acordo com o codigo passado pelo parâmetro
	*/	
	function getDados($cnn, $codCliente) {		

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
		$query .= "WHERE Cod_Cliente = '$codCliente'";
		
		$query = mysqli_query($cnn, $query);
		
		$cliente  = mysqli_fetch_assoc($query);		

		return $cliente;
	}
	
	/**
	 * Retorna a lista de prontuarios do cliente
	 */
	function getProntuarios($cnn, $codCliente) {
		$query = "SELECT Num_Prontuario, Dta_Data_Prontuario FROM TB_Prontuario ";
		$query .= "WHERE Cod_Cliente = '$codCliente'";
		
		$query = mysqli_query($cnn, $query);
		
		$listaProntuario = array();
		
		while($list  = mysqli_fetch_assoc($query)) {
			$listaProntuario[] = $list;
		}
		
		return $listaProntuario;		
	}
}

?>
