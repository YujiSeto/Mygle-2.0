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

		// Se o host não for localhost, exigimos SSL (TiDB Cloud exige)
		if ($config['host'] !== 'localhost' && $config['host'] !== '127.0.0.1') {
			// Tenta os caminhos comuns de CA no Linux (Render)
			if (file_exists('/etc/ssl/certs/ca-certificates.crt')) {
				$options[PDO::MYSQL_ATTR_SSL_CA] = '/etc/ssl/certs/ca-certificates.crt';
			} elseif (file_exists('/etc/pki/tls/certs/ca-bundle.crt')) {
				$options[PDO::MYSQL_ATTR_SSL_CA] = '/etc/pki/tls/certs/ca-bundle.crt';
			}
			$options[PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT] = false;
		}

		$this->db = new PDO($dsn, $config['dbuser'], $config['dbpass'], $options);
	}

}
?>