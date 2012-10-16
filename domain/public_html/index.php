<?php

/**
 * Tamo Frame - index.php -
 *
 * すべてのリクエストで実行される。
 * パスの設定とか。
 *
 * @version    1.0
 * @author     tamo
 * @license    MIT License
 * @copyright  2012 tamo All Rights Reserved.
 * @link       http://tamo3.info
 */


/**
 * エラー表示ON
 */
ini_set('display_errors', 1);



/**
 * document rootのパスをセット。
 */
define('DOCROOT', __DIR__.DIRECTORY_SEPARATOR);



/**
 * applicationのパスをセット。
 */
define('APPPATH', realpath(__DIR__.'/../../libs/tamoframe/app/').DIRECTORY_SEPARATOR);



/**
 * applicationのlibsのパスをセット。
 */
define('LIBPATH', realpath(APPPATH.'libs/').DIRECTORY_SEPARATOR);



/**
 * ライブラリーまでのパスをセット。
 */
define('COREPATH', realpath(__DIR__.'/../../libs/tamoframe/core/').DIRECTORY_SEPARATOR);



/**
 * ソースファイルまでのパスをセット。
 */
define('SRCPATH', realpath(__DIR__.'/../../libs/tamoframe/app/action/').DIRECTORY_SEPARATOR);



/**
 * 時間とメモリーをセット。
 */
defined('START_TIME') or define('START_TIME', microtime(true));
defined('START_MEM')  or define('START_MEM', memory_get_usage());



/**
 * オートロード開始。
 */
require_once COREPATH . 'autoloader.php';
new AutoLoader();



/**
 * リクエストをルーティング
 */
$reqObj = new request();
$reqObj->executeRequest()->response();



