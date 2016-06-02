<?php
header("Content-Type: text/html; charset=UTF-8", true);
class MySQL {
	/*
	* Instancia de Logger
	*/
	var $log;

	/*
	* Variável de conexão
	*/
	var $link;

	/**
	* Carrega configurações e conecta ao BD
	*/
	function __construct(){
		$this->log = new Logger();
		$this->link = mysqli_connect(HOSTNAME, DB_USER, DB_PASSWORD); //Conecta ao BD
		
		if(!$this->link) //Verifica a conex�o
		{
			$msg = "Não foi possível conectar ao Banco de Dados: " .mysqli_error($this->link);
			$this->log->logError($this, $msg);
		}
		elseif(!mysqli_select_db($this->link, DB_NAME)) //Seleciona o banco
		{
			$msg = "Não foi possível selecionar o Banco de Dados: " .mysqli_error($this->link);
			$this->log->logError($this, $msg);
		}
	}

	/**
	* Fecha conexão com BD
	*/
	function disconect() {
		return mysqli_close($this->link);
	}
}
?>
