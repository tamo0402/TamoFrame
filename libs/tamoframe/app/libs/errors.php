<?php

class errors {

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
	 * final
	 */
	private final function setErrorKeyword() {
        $this->ERROR_REGIST = 1;
        $this->ERROR_MAIL   = 2;
        $this->ERROR_NODATA = 3;
        $this->ERROR_SYSTEM = 99;
	}


	/**
	 * エラーを配列にセットする。
	 */
	public function setErrors($err) {
		$this->errors[] = $err;
	}


	/**
	 * セットしたエラーを取得する。
	 */
	public function getErrors() {
		return $this->errors;
	}


	/**
	 * セットしたエラーをリセットする。
	 */
	public function resetErrors() {
	    $this->errors = array();
	}
}