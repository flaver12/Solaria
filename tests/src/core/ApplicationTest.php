<?php

class ApplicationTest extends PHPUnit_Framework_TestCase {

	public function testSingeltion() {
        $app = new Application();
		$expected = new DbCore('','','','');
        $this->assertEquals($expected, Application::singelton('DbCore', array('','','','')));
	}
}
