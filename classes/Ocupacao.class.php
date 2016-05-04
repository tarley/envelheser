<?php

class Ocupacao{
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
	function Ocupacao($cnn) {
		$this->log = new Logger();
		$this->cnn = $cnn;
	}
	
	/**
	 * Retorna a lista de ocupa��es
	 */
	function getLista() {
		$query = "SELECT Cod_Ocupacao, Nom_Ocupacao ";
		$query .= "FROM tb_ocupacao ";
	
		$query = mysqli_query($this->cnn, $query);
	
		$listaOcupacao = array();
	
		while($list  = mysqli_fetch_assoc($query)) {
			$listaOcupacao[] = $list;
		}
	
		return $listaOcupacao;
	}
}
?>