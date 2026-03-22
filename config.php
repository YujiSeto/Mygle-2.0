<?php
require 'environment.php';

global $config;
$config = array();

// Em produção (Railway/Render), as variáveis virão do ambiente
// Localmente, se não houver variáveis de ambiente, ele usa os padrões de desenvolvimento
$config['dbname'] = getenv('DB_NAME') ?: 'mygle';
$config['host']   = getenv('DB_HOST') ?: 'localhost';
$config['dbuser'] = getenv('DB_USER') ?: 'root';
$config['dbpass'] = getenv('DB_PASS') ?: 'root';

// Opcional: Se precisar de mais configurações baseadas no ambiente
if(ENVIRONMENT == 'development') {
    // Ajustes extras para dev se necessário
}
?>