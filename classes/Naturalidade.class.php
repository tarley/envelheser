<?php

class Naturalidade{
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
	function Naturalidade($cnn) {
		$this->log = new Logger();
		$this->cnn = $cnn;
	}
	
	/**
	 * Retorna a lista de naturalidades
	 */
	function getLista($input) {
		$query = "SELECT Cod_Naturalidade, Nom_Naturalidade ";
		$query .= "FROM tb_naturalidade ";
	
		$query = mysqli_query($this->cnn, $query);
	
		$listaNaturalidade = array();
	
		while($list  = mysqli_fetch_assoc($query)) {
			$listaNaturalidade[] = $list;
		}
	
		return $listaNaturalidade;
	}
}
?>