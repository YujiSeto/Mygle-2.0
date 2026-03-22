<?php
require 'config.php';
$protocol = "http";
if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
    $protocol = "https";
} elseif (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
    $protocol = "https";
}
$base_url = $protocol . "://" . $_SERVER['HTTP_HOST'];
if ($_SERVER['HTTP_HOST'] == 'localhost') { $base_url .= '/mygle'; }
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

try {
    $core = new Core(); // Just to trigger any core issues
    // Manual PDO test
    $dsn = "mysql:dbname=".$config['dbname'].";host=".$config['host'].";port=".$config['dbport'].";charset=utf8";
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
    if (strpos($config['host'], 'tidbcloud.com') !== false) {
        $options[PDO::MYSQL_ATTR_SSL_CA] = __DIR__ . '/isrgrootx1.pem';
        $options[PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT] = false;
    }
    $db = new PDO($dsn, $config['dbuser'], $config['dbpass'], $options);
    
    echo "<h1>Database Debug</h1>";
    echo "Connected successfully to: " . $config['host'] . " (DB: " . $config['dbname'] . ")<br><br>";
    
    echo "<h3>Tables found:</h3>";
    $stmt = $db->query("SHOW TABLES");
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    if (empty($tables)) {
        echo "<b style='color:red'>NO TABLES FOUND!</b> The database is empty.";
    } else {
        echo "<ul>";
        foreach ($tables as $table) {
            echo "<li>" . $table . "</li>";
        }
        echo "</ul>";
    }
    
} catch (Exception $e) {
    echo "<h1>Error</h1>";
    echo $e->getMessage();
}
