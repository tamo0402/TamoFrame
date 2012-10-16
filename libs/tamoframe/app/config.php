<?php

/**
 * Tamo Frame - config.php -
 *
 * appのコンフィグクラス。
 * 自分の変更に変更する。
 *
 * @version    1.0
 * @author     tamo
 * @license    MIT License
 * @copyright  2012 tamo All Rights Reserved.
 * @link       http://tamo3.info
 */

namespace Tamo\App;

class config extends \Tamo\Core\config {

	public function __construct() {
		parent::__construct();
		echo "App!!";
	}
}