<?php
/**
* Configura��o geral
*/
 
// Caminho para a raiz
define( 'ABSPATH', dirname( __FILE__ ) ); 
 
// Nome do host da base de dados
define( 'HOSTNAME', 'localhost' );
 
// Nome do DB
define( 'DB_NAME', 'bd_envelheser' );
 
// Usu�rio do DB
define( 'DB_USER', 'root' );
 
// Senha do DB
define( 'DB_PASSWORD', '' );
 
// Se voc� estiver desenvolvendo, modifique o valor para true
define( 'DEBUG', true );
 
/**
* N�o edite daqui em diante
*/
 
// Carrega o loader, que vai carregar a aplica��o inteira
require_once ABSPATH . '/loader.php';

?>