<?php

class Naturalidade{
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
	function Naturalidade($cnn) {
		$this->log = new Logger();
		$this->cnn = $cnn;
	}
	
	/**
	 * Retorna a lista de naturalidades
	 */
	function getLista() {
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