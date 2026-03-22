<?php
class model {
	
	protected $db;

	public function __construct() {
		global $config;
		$dsn = "mysql:dbname=".$config['dbname'].";host=".$config['host'].";port=".$config['dbport'].";charset=utf8";
		
		// Opções para o PDO, incluindo SSL se necessário (TiDB Cloud exige)
		$options = array(
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
		);

		// Local CA for TiDB Cloud
		if (strpos($config['host'], 'tidbcloud.com') !== false) {
			$options[PDO::MYSQL_ATTR_SSL_CA] = __DIR__ . '/../isrgrootx1.pem';
			$options[PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT] = false;
		}

		$this->db = new PDO($dsn, $config['dbuser'], $config['dbpass'], $options);
	}

}
?>