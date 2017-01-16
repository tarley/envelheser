<?php

class Avaliador{
	/*
	 * Instância de Logger
	 */
	var $log;
	
	/*
	 * Instância da conex�o com o Banco
	 */
	var $cnn;
	
	/**
	 * Cria instancia de Logger para gerenciar exceções.
	 */
	function __construct($cnn) {
		$this->log = new Logger();
		$this->cnn = $cnn;
	}
	
	/**
	 * Retorna a lista de todos avaliadores cadastrados
	 */
	function getLista($input, $sortColumn = "", $sortOrder = "ASC"){
		$query = "SELECT Cod_Avaliador, Nom_Avaliador, a.Cod_Especialidade, Nom_Especialidade, Des_Email, Des_Login ";
		$query .= "FROM tb_avaliador a ";
		$query .= "LEFT JOIN tb_especialidade e ON (a.Cod_Especialidade = e.Cod_Especialidade) ";
		
		if($input != "")
			$query .= "WHERE nom_avaliador LIKE '%$input%' ";
		
		if($sortColumn != "")
			$query .= "ORDER BY " . $sortColumn . " " . $sortOrder . " ";
			
		$query = mysqli_query($this->cnn, $query);
		
		$listaAvaliadores = array();
		
		while($list  = mysqli_fetch_assoc($query)) {
			$listaAvaliadores[] = $list;
		}
		
		return $listaAvaliadores;
	}
	
	/**
	 * Retorna os dados de um avaliador
	 */
	function getDados($codAvaliador){
		$query = "SELECT Cod_Avaliador, Nom_Avaliador, a.Cod_Especialidade, Nom_Especialidade, Des_Email, Des_Login ";
		$query .= "FROM tb_avaliador a ";
		$query .= "LEFT JOIN tb_especialidade e ON (a.Cod_Especialidade = e.Cod_Especialidade) ";
		$query .= "WHERE Cod_Avaliador = $codAvaliador";
		
		$query = mysqli_query($this->cnn, $query);
		
		$avaliador  = mysqli_fetch_assoc($query);
		
		return $avaliador;
	}
	
	/**
	 * Insere os dados de um avaliador
	 */
	function Insert($a){
		$retorno = array();
		try {
			$codAvaliador = "";
			
			if($a['Cod_Avaliador'] != ""){
				
				$codAvaliador = $a['Cod_Avaliador'];
				
				if($a['Des_Senha'] != ""){
					$query = "UPDATE tb_avaliador ";
					$query .= "SET  ";
					$query .= "Nom_Avaliador = '" . $a['Nom_Avaliador'] . "', ";
					$query .= "Cod_Especialidade = '" . $a['Cod_Especialidade'] . "', ";
					$query .= "Des_Email = '" . $a['Des_Email'] . "', ";
					$query .= "Des_Login = '" . $a['Des_Login'] . "', ";
					$query .= "Des_Senha = '" . md5($a['Des_Senha']) . "' ";
					$query .= "WHERE Cod_Avaliador = " . $codAvaliador . "; ";
				}
				else{
					$query = "UPDATE tb_avaliador ";
					$query .= "SET  ";
					$query .= "Nom_Avaliador = '" . $a['Nom_Avaliador'] . "', ";
					$query .= "Cod_Especialidade = '" . $a['Cod_Especialidade'] . "', ";
					$query .= "Des_Email = '" . $a['Des_Email'] . "', ";
					$query .= "Des_Login = '" . $a['Des_Login'] . "' ";
					$query .= "WHERE Cod_Avaliador = " . $codAvaliador . "; ";
				}
				
				
				if (mysqli_query($this->cnn, $query)) {
					$retorno['Sucesso'] = true;
					$retorno['Mensagem'] = "Dados atualizados com sucesso";
					$retorno['CodAvaliador'] = $codAvaliador;
				}
			}
			
			else{
			
				$Nom_Avaliador = 'NULL';
				$Cod_Especialidade = 'NULL';
				$Des_Email = 'NULL';
				$Des_Login = 'NULL';
				$Des_Senha = 'NULL';
				
				if($a['Nom_Avaliador'] != ''){
					$Nom_Avaliador = "'".$a['Nom_Avaliador']."'";
				}
					
				if($a['Cod_Especialidade'] != ''){
					$Cod_Especialidade = "'".$a['Cod_Especialidade']."'";
				}
			
				if($a['Des_Email'] != ''){
					$Des_Email = "'".$a['Des_Email']."'";
				}
			
				if($a['Des_Login'] != ''){
					$Des_Login = "'".$a['Des_Login']."'";
				}
			
				if($a['Des_Senha'] != ''){
					$Des_Senha = $a['Des_Senha'];
				}
				
				$query = "INSERT INTO tb_avaliador (Nom_Avaliador, Cod_Especialidade, Des_Email, Des_Login, Des_Senha) ";
				$query .= "VALUES ($Nom_Avaliador, $Cod_Especialidade, $Des_Email, $Des_Login, md5($Des_Senha))";
				
				if (mysqli_query($this->cnn, $query)) {
					$codAvaliador = mysqli_insert_id($this->cnn);
				
					$retorno['Sucesso'] = true;
					$retorno['Mensagem'] = "Dados inseridos com sucesso";
					$retorno['CodAvaliador'] = $codAvaliador;
				}
			}	
		} catch (Exception $e) {
			$msg = "Falha ao inserir avaliador. Mensagem de erro: " . mysqli_error($this->cnn);
			$this->log->logError($this,$msg);			
			
			$retorno['Sucesso'] = false;			
			$retorno['Mensagem'] = "Falha ao inserir respostas";
		}
		
		return $retorno;
	}
	
	/**
	 * Deleta os dados de um avaliador
	 */
	function Delete($codAvaliador){
		
		$retorno = array();
		
		try {
			$query = "DELETE FROM tb_avaliador ";
			$query .= "WHERE Cod_Avaliador = $codAvaliador";
		
			if (mysqli_query($this->cnn, $query)) {
				$retorno['Sucesso'] = true;
				$retorno['Mensagem'] = "Dados inseridos com sucesso";
			}
		} catch (Exception $e) {
			$msg = "Falha ao excluir avaliador. Mensagem de erro: " . mysqli_error($this->cnn);
			$this->log->logError($this,$msg);			
			
			$retorno['Sucesso'] = false;			
			$retorno['Mensagem'] = "Falha ao excluir avaliador";
		}
		
		return $retorno;
	}
	
	/**
	 * Atualiza os dados de um avaliador
	 */
	function Update($codAvaliador, $nomAvaliador, $codEspecialidade, $desEmail, $desLogin, $desSenha){
		
		$retorno = array();
		
		try {
			$query = "UPDATE tb_avaliador SET Nom_Avaliador = $nomAvaliador, Cod_Especialidade = $codEspecialidade, ";
			$query .= "Des_Email = $desEmail, Des_Login = $desLogin, Des_Senha = $desSenha) ";
			$query .= "WHERE Cod_Avaliador = $codAvaliador";
			
			if (mysqli_query($this->cnn, $query)) {
				$retorno['Sucesso'] = true;
				$retorno['Mensagem'] = "Dados atualizados com sucesso";
				$retorno['CodAvaliador'] = $codAvaliador;
			}
		} catch (Exception $e) {
			$msg = "Falha ao atualizar avaliador. Mensagem de erro: " . mysqli_error($this->cnn);
			$this->log->logError($this,$msg);			
			
			$retorno['Sucesso'] = false;			
			$retorno['Mensagem'] = "Falha ao atualizar avaliador";
		}
		
		return $retorno;
	}

	function Login($usuario = "", $senha = "") {

		//Senha 12345 em md5: 827ccb0eea8a706c4c34a16891f84e7b

		$retorno = array();
		
		try {

			$csenha = md5($senha);

			$query = "SELECT Cod_Avaliador, Cod_Acesso FROM tb_avaliador WHERE Des_Login = '$usuario' AND Des_Senha = '$csenha'";
			
			$query = mysqli_query($this->cnn, $query);

			$numRows = mysqli_num_rows($query);

			if ($numRows == 1) {
				
				$avaliador  = mysqli_fetch_assoc($query);

				$retorno['Sucesso'] = true;
				$retorno['Cod_Avaliador'] = $avaliador['Cod_Avaliador'];
				$retorno['Cod_Acesso'] = $avaliador['Cod_Acesso'];
			} else {
				$retorno['Sucesso'] = false;
				$retorno['Mensagem'] = "Usuário ou senha inválidos";
			}

		} catch (Exception $e) {
			$msg = "Falha ao autenticar avaliador. Mensagem de erro: " . mysqli_error($this->cnn);
			$this->log->logError($this,$msg);
			
			$retorno['Sucesso'] = false;			
			$retorno['Mensagem'] = "Falha ao autenticar avaliador";
		}
		
		return $retorno;
	}
}
?>