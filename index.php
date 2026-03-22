<?php
session_start();
require 'vendor/autoload.php';
require 'config.php';

// BASE_URL dinâmica para rodar tanto local quanto no Render
$protocol = "http";
if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
    $protocol = "https";
} elseif (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
    $protocol = "https";
}

$base_url = $protocol . "://" . $_SERVER['HTTP_HOST'];

// Ajuste para desenvolvimento local se necessário
if ($_SERVER['HTTP_HOST'] == 'localhost') {
    $base_url .= '/mygle';
}
define('BASE_URL', $base_url);

spl_autoload_register(function ($class){
    if(strpos($class, 'Controller') > -1) {
        if(file_exists('controllers/'.$class.'.php')) {
            require_once 'controllers/'.$class.'.php';
        }
    } elseif(file_exists('models/'.$class.'.php')) {
        require_once 'models/'.$class.'.php';
    } elseif(file_exists('core/'.strtolower($class).'.php')) {
        require_once 'core/'.strtolower($class).'.php';
    }
});

$core = new Core();
$core->run();
?>