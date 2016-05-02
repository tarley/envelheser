<?php

class Ocupacao{
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
	function Ocupacao($cnn) {
		$this->log = new Logger();
		$this->cnn = $cnn;
	}
	
	/**
	 * Retorna a lista de ocupações
	 */
	function getLista($input) {
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