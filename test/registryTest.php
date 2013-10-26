<?php 
require_once('../model/registry.php');

class TestOfRegistry extends PHPUnit_Framework_TestCase {
    function testSetResult() {
        $registry = new Registry;
		$registry->SomeTestvar = TRUE;
        $this->assertTrue($registry->SomeTestvar);
    }
	 function testGetResult() {
        $registry = new Registry;
		$var = $registry->threshold_time;
        $this->assertNotNull($var);
    }
}