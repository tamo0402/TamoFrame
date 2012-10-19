<?php

/**
 * Tamo Frame - config.php -
 *
 * 設定クラス。
 * 自分の変更に変更する。
 *
 * @version    1.0
 * @author     tamo
 * @license    MIT License
 * @copyright  2012 tamo All Rights Reserved.
 * @link       http://tamo3.info
 */

class Config {

    private static $configs = null;

    /**
     * コンストラクタ。
     * 設定をセットする。
     */
    private function __construct() {
        self::$configs = require_once LIBPATH.'config.php';
    }


    /**
     * 設定を取得する。
     */
    public static function get($key) {

        if (self::$configs == null) {
            new self();
        }
        return self::$configs[$key];
    }


    public final function __clone() {
        throw new RuntimeException('Singletonパターンの為、cloneキーワードの使用は禁止されています。');
    }
}