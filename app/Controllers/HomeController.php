<?php

class HomeController {

	function index() {
		echo "tes";
	}

	function named($name,$id) {
		var_dump($name);
		var_dump($id);
	}
}