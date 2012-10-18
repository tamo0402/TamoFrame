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

class config {

    private static $configs = null;

    /**
     * コンストラクタ。
     * 設定をセットする。
     */
    private function __construct() {
        self::$configs = $this->setConfig();
    }


    /**
     * 設定を取得する。
     */
    public static function get($key) {

        if (self::$configs == null) {
            new self();
        }
        $configs = self::$configs;
        return $configs[$key];
    }


    public final function __clone() {
        throw new RuntimeException('Singletonパターンの為、cloneキーワードの使用は禁止されています。');
    }


    /**
     * 設定の内容。
     */
    private function setConfig() {
        return array(

            /**
             * viewのエンジンを選択。
             * Twig OR Smarty OR PHP
             */
            "view" => "Twig",



            /**
             * 現在のモードを選択。
             * @see /app/libs/environment.php
             * 1 : $production
             * 2 : $develop
             * 3 : $test
             * 4 : $mentenance
             */
            "status" => environment::$develop,



            /**
             * オリジナルlogを記録するかの設定。
             * @see /core/log.php
             * none : 記録しない。
             * none以外 : 記録する。
             * デフォルトは記録しない。
             */
            "log" => "none",



            /**
             * logの保存場所を指定する。
             * @see /core/log.php
             */
            "log_path" => APPPATH . "log/",



            /**
             * logのファイル名を指定する。
             * 指定しなければ年月日.txt
             * @see /core/log.php
             */
            "log_file_name" => "",
        );
    }
}