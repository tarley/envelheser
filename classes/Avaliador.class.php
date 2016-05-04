<?php
class Avaliador{
	/*
	 * Inst�ncia de Logger
	 */
	var $log;
	
	/*
	 * Inst�ncia da conex�o com o Banco
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
	function getLista(){
		$query = "SELECT Cod_Avaliador, Nom_Avaliador, Cod_Especialidade, Nom_Especialidade, Des_Email, Des_Login ";
		$query .= "FROM tb_avaliador a ";
		$query .= "LEFT JOIN tb_especialidade e ON (a.Cod_Especialidade = e.Cod_Especialidade) ";
		
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
		$query = "SELECT Cod_Avaliador, Nom_Avaliador, Cod_Especialidade, Nom_Especialidade, Des_Email, Des_Login ";
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
		try {
			$query = "INSERT INTO tb_avaliador (Nom_Avaliador, Cod_Especialidade, Des_Email, Des_Login, Des_Senha) ";
			$query .= "VALUES ($nomAvaliador, $codEspecialidade, $desEmail, $desLogin, $desSenha)";
		
			if (mysqli_query($this->cnn, $query)) {
				return mysqli_insert_id($this->cnn);
			}
		} catch (Exception $e) {
			throw $e;
		}
	}
	
	/**
	 * Deleta os dados de um avaliador
	 */
	function Delete($codAvaliador){
		try {
			$query = "DELETE FROM tb_avaliador ";
			$query .= "WHERE Cod_Avaliador = $codAvaliador";
		
			if (mysqli_query($this->cnn, $query)) {
				return 1;
			}
			else {
				return 0;
			}
		} catch (Exception $e) {
			throw $e;
		}
	}
	
	/**
	 * Atualiza os dados de um avaliador
	 */
	function Update($codAvaliador){
	
	}
}
?>