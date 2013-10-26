<?php 
require_once('../model/database.php');
require_once('../model/registry.php');

class TestOfDatabase extends PHPUnit_Framework_TestCase {
    function testGetInstance() {
        $this->assertNotNull(Database::getInstance());
    }
}