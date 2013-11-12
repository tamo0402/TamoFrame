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
namespace TamoFrame\Core;


class session {

    private $sessionParam = array();

	/**
	 * コンストラクタでセッション開始。
	 */
	public function __construct() {
		session_start();
	}


	/**
	 * セッションをセットする。
	 */
	public function set() {

	}

	/**
	 * セッションをセットする。
	 */
	public function set_flash() {

	}


	/**
	 * セッションを削除する。
	 */
	public function clear($key=null) {

	    if (null == $key) {
            $this->sessionParam = array();
            $_SESSION = array();
            return ;
	    }
	    // key指定で削除。
	    if (array_key_exists($key, $this->sessionParam)) {
    	    unset($this->sessionParam[$key]);
	    }
	}


	/**
	 * セッションを削除する。
	 * @param string セッション名
	 * 引数のセッション名のセッションを消す。
	 * 引数なければすべて。
	 */
	public function logout($sessionName=null) {

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