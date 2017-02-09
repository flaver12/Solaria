<?php

namespace Controllers\Core\Web;

class Pages {

	public function render()
	{
		return "hello world!";
	}

	public function returnTrue()
	{
		return true;
	}

	public function renderArray() {
		return ['Test', 'Hallo', 'Moin'];
	}
}