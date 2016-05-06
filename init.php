<?php
/**
* Configuração geral
*/
 
// Caminho para a raiz
define( 'ABSPATH', dirname( __FILE__ ) ); 
 
// Nome do host da base de dados
define( 'HOSTNAME', 'localhost' );
 
// Nome do DB
define( 'DB_NAME', 'bd_envelheser' );
 
// Usuário do DB
define( 'DB_USER', 'root' );
 
// Senha do DB
define( 'DB_PASSWORD', '' );
 
// Se você estiver desenvolvendo, modifique o valor para true
define( 'DEBUG', true );
 
/**
* Não edite daqui em diante
*/
 
// Carrega o loader, que vai carregar a aplicação inteira
require_once ABSPATH . '/loader.php';

?>