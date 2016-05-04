<?php

class Cor{
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
	function Cor($cnn) {
		$this->log = new Logger();
		$this->cnn = $cnn;
	}
	
	/**
	 * Retorna a lista de cor 
	 */
	function getLista() {
		$query = "SELECT Cod_Cor, Nom_Cor ";
		$query .= "FROM tb_cor ";
	
		$query = mysqli_query($this->cnn, $query);
	
		$listaCor = array();
	
		while($list  = mysqli_fetch_assoc($query)) {
			$listaCor[] = $list;
		}
	
		return $listaCor;
	}
}
?>