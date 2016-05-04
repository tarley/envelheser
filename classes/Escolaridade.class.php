<?php

class Escolaridade{
	/*
	 * Inst�ncia de Logger
	 */
	var $log;
	
	/*
	 * Inst�ncia da conex�o com o Banco
	 */
	var $cnn;
	
	/**
	 * Cria instancia de Logger para gerenciar exce��es.
	 */
	function Escolaridade($cnn) {
		$this->log = new Logger();
		$this->cnn = $cnn;
	}
	
	/**
	 * Retorna a lista de escolaridade 
	 */
	function getLista() {
		$query = "SELECT Cod_Escolaridade, Nom_Escolaridade ";
		$query .= "FROM tb_escolaridade ";
	
		$query = mysqli_query($this->cnn, $query);
	
		$listaEscolaridade = array();
	
		while($list  = mysqli_fetch_assoc($query)) {
			$listaEscolaridade[] = $list;
		}
	
		return $listaEscolaridade;
	}
}
?>