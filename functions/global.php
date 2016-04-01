<?php
// Hello world 
/**
* Funчуo para carregar automaticamente todas as classes padrуo
* Ver: http://php.net/manual/pt_BR/function.autoload.php.
* Nossas classes estуo na pasta classes/.
* O nome do arquivo deverс ser class-NomeDaClasse.php.
* Por exemplo: para a classe TutsupMVC, o arquivo vai chamar class-TutsupMVC.php
*/
function __autoload($class_name) {
	$file = ABSPATH . '/classes/' . $class_name . '.class.php';
	
	if ( ! file_exists( $file ) ) {
		echo "Classe " . $class_name . " nуo encontrada.";
		die();
	}
	
	// Inclui o arquivo da classe
    require_once $file;
}