<?php

class EstadoCivil{
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
	function EstadoCivil($cnn) {
		$this->log = new Logger();
		$this->cnn = $cnn;
	}
	
	/**
	 * Retorna a lista de estado civil 
	 */
	function getLista($input) {
		$query = "SELECT Cod_Estado_Civil, Nom_Estado_Civil ";
		$query .= "FROM tb_estado_civil ";
	
		$query = mysqli_query($this->cnn, $query);
	
		$listaEstadoCivil = array();
	
		while($list  = mysqli_fetch_assoc($query)) {
			$listaEstadoCivil[] = $list;
		}
	
		return $listaEstadoCivil;
	}
}
?>