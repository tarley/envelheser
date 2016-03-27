<?php

class Logger {
	/*
	* Manipulador dos arquivos de log.
	*/
	var $error;

	/**
	* Inicializa logger e cria arquivo txt
	* caso não exista.
	*/
	function Logger() {
		$errorfile = "err_" . date("Ymd") . ".txt";
		$this->error = fopen(ABSPATH . "/log/" . $errorfile, "a");
	}

	/**
	* Escreve erros no arquivo txt.
	*/
	function logError($class, $msg) {
		$name = get_class($class);
		$date = date("Y.m.d H:i:s");
		$text = "[".$date."][Class: ".$name."] Error: " . $msg . "\r";

		if(DEBUG)
			echo $text;
		else
			fwrite($this->error, $text);
	}

	/**
	* Encerra logger e fecha arquivo txt.
	*/
	function __destruct() {
		fclose($this->error);
	}
}
?>
