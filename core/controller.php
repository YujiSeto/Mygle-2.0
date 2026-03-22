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

		// Se o host for TiDB Cloud, exigimos SSL
		if (strpos($config['host'], 'tidbcloud.com') !== false) {
			$options[1007] = file_exists('/etc/ssl/certs/ca-certificates.crt') ? '/etc/ssl/certs/ca-certificates.crt' : '';
			$options[1014] = false;
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