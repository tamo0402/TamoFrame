<?php

/**
 * Tamo Frame - db.php -
 *
 * データーベースクラス。
 * コネクションを作成、保持する。
 * シングルトンパターン。
 *
 * @version    1.0
 * @author     tamo
 * @license    MIT License
 * @copyright  2012 tamo All Rights Reserved.
 * @link       http://tamo3.info
 */
namespace TamoFrame\Core;

class Db extends \Database {

    private static $con;

    private function __construct() {
        if (is_null(self::$con)) {
            self::$con = new \PDO("mysql:host=" . $this->serverName . "; dbname=" . $this->databaseName, $this->serverId, $this->serverPass);
            self::$con->query("SET NAMES utf-8;");
        }
    }


    /**
     * コネクションを作成する。
     */
    public function connection() {
        new self();
    }


    /**
     * コネクションを取得する。
     */
    public static function get() {
        return self::$con;
    }


    /**
     * クローン禁止。
     */
    public final function __clone() {
        throw new RuntimeException('Singletonパターンの為、cloneキーワードの使用は禁止されています。');
    }
}