<?php

/**
 * Tamo Frame - environment.php -
 *
 * 環境設定クラス。
 *
 * @version    1.0
 * @author     tamo
 * @license    MIT License
 * @copyright  2012 tamo All Rights Reserved.
 * @link       http://tamo3.info
 */
namespace TamoFrame\Core;


class Environment {

    // 環境の種類。
    public static $production = 1; // 本番環境。
    public static $develop    = 2; // 開発環境。
    public static $test       = 3; // テスト環境。
    public static $mentenance = 4; // メンテナンス中。

    // 現在の環境。
    private $env;


    /**
     * コンストラクタ。
     * @param $env
     */
    public function __construct($env) {
        $this->env = $env;
        $this->setFinalEnv();
        $this->set();
    }


    /**
     * 変数に値を格納。
     */
    private final function setFinalEnv() {
        self::$production = 1;
        self::$develop = 2;
        self::$test = 3;
        self::$mentenance = 4;
    }


    /**
     * 現在の環境によって処理を分ける。
     * TODO DBもからめたらいいな。
     */
    private function set() {
        if ($this->env == self::$production) {}
        else if ($this->env == self::$develop) {}
        else if ($this->env == self::$test) {}
        else if ($this->env == self::$mentenance){}
    }



    /**
     * 現在の環境を取得。
     */
    public function getEnv() {
        return $this->env;
    }
}