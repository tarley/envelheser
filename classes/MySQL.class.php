<?php

class MySQL {
	/*
	* Instancia de Logger
	*/
	var $log;

	/*
	* Vari�vel de conex�o
	*/
	var $link;

	/**
	* Carrega configura��es e conecta ao BD
	*/
	function MySQL() {
		$this->log = new Logger();
		$this->link = mysqli_connect(HOSTNAME, DB_USER, DB_PASSWORD); //Conecta ao BD

		if(!$this->link) //Verifica a conex�o
		{
			$msg = "N�o foi poss�vel conectar ao Banco de Dados: " .mysqli_error($this->link);
			$this->log->logError($this, $msg);
		}
		elseif(!mysqli_select_db($this->link, DB_NAME)) //Seleciona o banco
		{
			$msg = "N�o foi poss�vel selecionar o Banco de Dados: " .mysqli_error($this->link);
			$this->log->logError($this, $msg);
		}
	}

	/**
	* Fecha conex�o com BD
	*/
	function disconect() {
		return mysqli_close($this->link);
	}
}
?>
