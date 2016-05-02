<?php

class Escolaridade{
	/*
	 * Instância de Logger
	 */
	var $log;
	
	/*
	 * Instância da conexão com o Banco
	 */
	var $cnn;
	
	/**
	 * Cria instancia de Logger para gerenciar exceções.
	 */
	function Escolaridade($cnn) {
		$this->log = new Logger();
		$this->cnn = $cnn;
	}
	
	/**
	 * Retorna a lista de escolaridade 
	 */
	function getLista($input) {
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