<?php
namespace TamoFrame\Core;


class Errors {

    // エラー画面の種類。
	public $ERROR_REGIST;
	public $ERROR_MAIL;
	public $ERROR_NODATA;
    public $ERROR_SYSTEM; // 予期せぬエラー。

	private $errors = array();


	/**
	 * コンストラクタ。
	 */
	public function __construct() {
	    $this->setErrorKeyword();
	}


	/**
	 * エラーの定数。
	 */
	private final function setErrorKeyword() {

	    $this->ERROR_REGIST = 1;  // 登録エラー。
        $this->ERROR_MAIL   = 2;  // メールエラー。
        $this->ERROR_NODATA = 3;  // データなしエラー。
        $this->ERROR_SYSTEM = 99; // システムエラー。
	}


	/**
	 * エラーを配列にセットする。
	 */
	public static function setErrors($err) {
		$this->errors[] = $err;
	}


	/**
	 * セットしたエラーを取得する。
	 */
	public static function getErrors() {
		return $this->errors;
	}


	/**
	 * セットしたエラーをリセットする。
	 */
	public static function resetErrors() {
	    $this->errors = array();
	}
}