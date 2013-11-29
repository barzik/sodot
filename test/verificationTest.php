<?php 
require_once('../model/database.php');
require_once('../model/registry.php');
require_once('../model/verification.php');


class TestOfVerificiation extends PHPUnit_Framework_TestCase {
    function testVerification() {
		$post_array['ip'] = '127.0.0.1';
		$post_array['content'] = 'test';
	
        $verification = new Verification($post_array);
		$this->assertNotNull($verification);

    }
}