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
 * コアファイルまでのパスをセット。
 */
define('COREPATH', realpath(__DIR__.'/../../libs/tamoframe/core/').DIRECTORY_SEPARATOR);



/**
 * Appのパスをセット。
 */
define('APPPATH', realpath(__DIR__.'/../../libs/tamoframe/app/').DIRECTORY_SEPARATOR);



/**
 * Libsのパスをセット。
 */
define('LIBPATH', APPPATH.'libs'.DIRECTORY_SEPARATOR);



/**
 * ACTIONまでのパスをセット。
 */
define('ACTIONPATH', APPPATH.'action'.DIRECTORY_SEPARATOR);



/**
 * MODELまでのパスをセット。
 */
define('MODELPATH', APPPATH.'model'.DIRECTORY_SEPARATOR);



/**
 * 時間とメモリーをセット。
 */
defined('START_TIME') or define('START_TIME', microtime(true));
defined('START_MEM')  or define('START_MEM', memory_get_usage());



/**
 * オートロード開始。
 */
require_once COREPATH . 'autoloader.php';
\TamoFrame\Core\AutoLoader::register();



/**
 * リクエストをルーティング
 */
try {
    $reqest = new \TamoFrame\Core\Request();
    $reqest->executeRequest()->response();

} catch (Exception $e) {
    echo nl2br($e);
}