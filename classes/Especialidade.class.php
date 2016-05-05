<?php

class Especialidade{
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
	function Especialidade($cnn) {
		$this->log = new Logger();
		$this->cnn = $cnn;
	}
	
	/**
	 * Retorna a lista de especialidades
	 */
	function getLista() {
		$query = "SELECT Cod_Especialidade, Nom_Especialidade ";
		$query .= "FROM tb_especialidade ";
	
		$query = mysqli_query($this->cnn, $query);
	
		$listaEspecialidade = array();
	
		while($list  = mysqli_fetch_assoc($query)) {
			$listaEspecialidade[] = $list;
		}
	
		return $listaEspecialidade;
	}
}
?>