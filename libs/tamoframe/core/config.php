<?php

/**
 * Tamo Frame - config.php -
 *
 * コアのコンフィグクラス。
 * デフォルトの設定を書く。
 * 変更する場合はappごとのコンフィグクラスで書きかえる。
 *
 * @version    1.0
 * @author     tamo
 * @license    MIT License
 * @copyright  2012 tamo All Rights Reserved.
 * @link       http://tamo3.info
 */

namespace Tamo\Core;

class config {

	private $config;

	public function __construct() {
		$this->config = $this->getConfig();
	}

	private function getConfig() {
		// 設定。

	}

	public static function get() {
		return $this->config;
	}
}