<?php

/**
 * Tamo Frame - session.php -
 *
 * セッション関係のクラス。
 *
 * @version    1.0
 * @author     tamo
 * @license    MIT License
 * @copyright  2012 tamo All Rights Reserved.
 * @link       http://tamo3.info
 */
class session {

	/**
	 * コンストラクタでセッション開始。
	 */
	function __construct() {
		session_start();
	}


	/**
	 * セッションを削除する。
	 * @param string セッション名
	 * 引数のセッション名のセッションを消す。
	 * 引数なければすべて。
	 */
	function logout($sessionName=null) {

		if (is_null($sessionName)) {

			// 名前指定がない場合はすべて削除。
			$_SESSION = array();

			if (isset($_COOKIE[session_name()])) {
    			setcookie(session_name(), '', time()-42000, '/');
			}
			session_destroy();

		} else {
			// 名前指定がある場合その名前だけ消す。
			unset($_SESSION["{$sessionName}"]);
		}
	}
}

?>