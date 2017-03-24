<?php

class ApplicationTest extends PHPUnit_Framework_TestCase {

	public function testSingeltion() {
		$expected = new DbCore('','','','');
        $this->assertEquals($expected, Application::singleton('DbCore', array('','','','')));
	}

	public function testNewInstance() {
		$expected = new DbCore('','','','');
        $this->assertEquals($expected, Application::newInstance('DbCore', array('','','','')));
	}
}
