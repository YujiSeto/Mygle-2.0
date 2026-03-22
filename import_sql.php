<?php
require 'config.php';

try {
    $dsn = "mysql:dbname=".$config['dbname'].";host=".$config['host'].";port=".$config['dbport'].";charset=utf8";
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
    if (strpos($config['host'], 'tidbcloud.com') !== false) {
        $options[PDO::MYSQL_ATTR_SSL_CA] = __DIR__ . '/isrgrootx1.pem';
        $options[PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT] = false;
    }
    
    $db = new PDO($dsn, $config['dbuser'], $config['dbpass'], $options);
    
    echo "<h1>Database Migration Tool</h1>";
    echo "Connected to TiDB Cloud!<br>";
    
    $sql_file = __DIR__ . '/mygle_essential.sql';
    if (!file_exists($sql_file)) {
        die("SQL file not found.");
    }
    
    $sql = file_get_contents($sql_file);
    
    // Split the SQL file into separate statements
    $statements = array_filter(array_map('trim', explode(';', $sql)));
    
    $success = 0;
    $errors = 0;
    
    foreach ($statements as $statement) {
        if (!empty($statement)) {
            try {
                $db->exec($statement);
                $success++;
            } catch (PDOException $e) {
                echo "<p style='color:red'>Error executing statement: " . htmlspecialchars(substr($statement, 0, 100)) . "...</p>";
                echo "<p style='color:red'>" . $e->getMessage() . "</p>";
                $errors++;
            }
        }
    }
    
    echo "<h2>Migration Complete!</h2>";
    echo "<p>Successfully executed: <b>$success</b> statements.</p>";
    if ($errors > 0) {
        echo "<p style='color:red'>Errors encountered: <b>$errors</b></p>";
    } else {
        echo "<p style='color:green'>All tables created and populated successfully!</p>";
        echo "<p><a href='" . BASE_URL . "'>Go to Login</a></p>";
    }
    
} catch (Exception $e) {
    echo "<h1>Connection Error</h1>";
    echo $e->getMessage();
}
