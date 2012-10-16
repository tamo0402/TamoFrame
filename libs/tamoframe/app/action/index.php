<?php

class index_action extends \TamoFrame\App\Lib\action {

	/**
	 * 親クラスをnewする。
	 */
	public function __construct() {
		parent::__construct();
	}

	public function index() {
		$this->assign("title", "TamoFrame | index");
		$this->assign("name", "World!!");
		$this->viewSet('index.html');
	}
}