<?php 
require_once('../model/registry.php');

class TestOfRegistry extends PHPUnit_Framework_TestCase {
    public function testSetResult() {
        $registry = Registry::getInstance();
		$registry->SomeTestvar = TRUE;
        $this->assertTrue($registry->SomeTestvar);
    }
	public function testGetResult() {
        $registry = Registry::getInstance();
		$var = $registry->threshold_time;
        $this->assertNotNull($var);
    }
	public function testIsDB_USER_defined() {
		$registry = Registry::getInstance();
		$this->assertNotNull($registry->db_user, 'db_user is not defined. cannot test'); 
    }
	public function testIsDB_PWD_defined() {
		$registry = Registry::getInstance();
		$this->assertNotNull($registry->db_password, 'db_password is not defined. cannot test'); 
    }
	
}