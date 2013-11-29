<?php 
require_once('../model/registry.php');
require_once('../model/database.php');
require_once('../model/install.php');

class TestOfInstall extends PHPUnit_Framework_TestCase {

	public function testDatabaseConstruct() {
		$registry = Registry::getInstance();
		$registry->db_name = 'sodot_db_test_name';

		$user = $registry->db_user;
		$pass= $registry->db_password;
		$db = $registry->db_name; 

		try { 
			$dbh = new PDO("mysql:host=localhost", $user, $pass);
			} catch (PDOException $e) {
				die("DB ERROR: ". $e->getMessage());
			}
		
		$dbh->query("create database $db");
		
		$install = new Install();
		
		$this->assertNotNull($install->getResult()); 
		
	}
	
}