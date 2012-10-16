<?php

/**
 * Tamo Frame - error404.php -
 *
 * ページなしエラー。
 *
 * @version    1.0
 * @author     tamo
 * @license    MIT License
 * @copyright  2012 tamo All Rights Reserved.
 * @link       http://tamo3.info
 */

class error404_action extends \TamoFrame\App\Lib\action {

	public function __construct() {
		parent::__construct();
	}

	public function index() {
		$this->viewSet('error404.html');
	}
}