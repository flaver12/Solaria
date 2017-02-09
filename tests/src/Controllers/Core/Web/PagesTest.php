<?php

class PagesTest extends PHPUnit_Framework_TestCase {

	public function testRenderReturnsHelloWorld()
	{
		$pages = new \Controllers\Core\Web\Pages();
		$expected = 'hello world!';
		$this->assertEquals($expected, $pages->render());
	}
}