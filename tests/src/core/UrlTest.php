<?php

class UrlTest extends PHPUnit_Framework_TestCase {

    /**
    * @expectedException Exception
    */
	public function testInvalidResolve() {
		URL::resolve('/invalid/invalid');
	}
}
