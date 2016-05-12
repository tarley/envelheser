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
	function Avaliador($cnn) {
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
	function Insert($nomAvaliador, $codEspecialidade, $desEmail, $desLogin, $desSenha){
		
		$retorno = array();
		
		try {
			$query = "INSERT INTO tb_avaliador (Nom_Avaliador, Cod_Especialidade, Des_Email, Des_Login, Des_Senha) ";
			$query .= "VALUES ($nomAvaliador, $codEspecialidade, $desEmail, $desLogin, $desSenha)";
		
			if (mysqli_query($this->cnn, $query)) {
				$codAvaliador = mysqli_insert_id($this->cnn);
				
				$retorno['Sucesso'] = true;
				$retorno['Mensagem'] = "Dados inseridos com sucesso";
				$retorno['CodAvaliador'] = $codAvaliador;
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
}
?>