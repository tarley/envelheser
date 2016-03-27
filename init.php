<?php
/**
* Configuraчуo geral
*/
 
// Caminho para a raiz
define( 'ABSPATH', dirname( __FILE__ ) ); 
 
// Nome do host da base de dados
define( 'HOSTNAME', 'localhost' );
 
// Nome do DB
define( 'DB_NAME', 'bd_envelheser' );
 
// Usuсrio do DB
define( 'DB_USER', 'root' );
 
// Senha do DB
define( 'DB_PASSWORD', '' );
 
// Se vocъ estiver desenvolvendo, modifique o valor para true
define( 'DEBUG', true );
 
/**
* Nуo edite daqui em diante
*/
 
// Carrega o loader, que vai carregar a aplicaчуo inteira
require_once ABSPATH . '/loader.php';

?>