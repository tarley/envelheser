<?php
// Hello world 
/**
* Fun��o para carregar automaticamente todas as classes padr�o
* Ver: http://php.net/manual/pt_BR/function.autoload.php.
* Nossas classes est�o na pasta classes/.
* O nome do arquivo dever� ser class-NomeDaClasse.php.
* Por exemplo: para a classe TutsupMVC, o arquivo vai chamar class-TutsupMVC.php
*/
function __autoload($class_name) {
	$file = ABSPATH . '/classes/' . $class_name . '.class.php';
	
	if ( ! file_exists( $file ) ) {
		echo "Classe " . $class_name . " n�o encontrada.";
		die();
	}
	
	// Inclui o arquivo da classe
    require_once $file;
}

function utf8(&$entry) {
	//$entry = iconv('Windows-1250', 'UTF-8', $entry);
}