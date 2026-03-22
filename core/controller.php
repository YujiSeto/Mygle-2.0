<?php
class controller {

	protected $db;

	public function __construct() {
		global $config;
		$dsn = "mysql:dbname=".$config['dbname'].";host=".$config['host'].";port=".$config['dbport'].";charset=utf8";
		
		// Opções para o PDO, incluindo SSL se necessário (TiDB Cloud exige)
		$options = array(
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
		);

		// Blunderbuss SSL for TiDB Cloud (Forces SSL handshake)
		if (strpos($config['host'], 'tidbcloud.com') !== false) {
			$options[1007] = ''; // PDO::MYSQL_ATTR_SSL_CA
			$options[1008] = ''; // PDO::MYSQL_ATTR_SSL_CAPATH
			$options[1009] = ''; // PDO::MYSQL_ATTR_SSL_KEY
			$options[1010] = ''; // PDO::MYSQL_ATTR_SSL_CERT
			$options[1014] = false; // PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT
		}

		$this->db = new PDO($dsn, $config['dbuser'], $config['dbpass'], $options);
	}
	
	public function loadView($viewName, $viewData = array()) {
		extract($viewData);
		include 'views/'.$viewName.'.php';
	}

	public function loadTemplate($viewName, $viewData = array()) {
		include 'views/template.php';
	}

	public function loadViewInTemplate($viewName, $viewData) {
		extract($viewData);
		include 'views/'.$viewName.'.php';
	}

	public function loadLibrary($lib) {
		if(file_exists('libraries/'.$lib.'.php')) {
			include 'libraries/'.$lib.'.php';
		}
	}

}