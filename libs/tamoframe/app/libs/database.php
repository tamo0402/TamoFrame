<?php

/**
 * Tamo Frame - database.php -
 *
 * databaseの接続情報を入れるクラス。
 * 自分用に書き換える。
 * TODO 環境によってすぐ変更できるようにするか。
 *
 * @version    1.0
 * @author     tamo
 * @license    MIT License
 * @copyright  2012 tamo All Rights Reserved.
 * @link       http://tamo3.info
 */
class database {

	// DB接続に必要な情報を入れる。
    protected $serverName   = "localhost";
    protected $serverId     = "id";
    protected $serverPass   = "password";
    protected $databaseName = "dbname";
}