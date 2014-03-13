<?php

/**
 * Tamo Frame - index.php -
 *
 * すべてのリクエストで実行される。
 * パスの設定とか。
 *
 * @version    2.0
 * @author     tamo
 * @license    MIT License
 * @copyright  2013 tamo All Rights Reserved.
 * @link       http://tamo3.info
 */



/**
 * エラー表示ON
 */
ini_set('display_errors', 1);

session_start();



/**
 * document rootのパスをセット。
 */
define('DOCROOT', __DIR__.DIRECTORY_SEPARATOR);



/**
 * コアファイルまでのパスをセット。
 */
define('COREPATH', realpath(__DIR__.'/tamoframe/core/').DIRECTORY_SEPARATOR);



/**
 * Appのパスをセット。
 */
define('APPPATH', realpath(__DIR__.'/tamoframe/app/').DIRECTORY_SEPARATOR);



/**
 * オートロード開始。
 */
require_once COREPATH . 'autoloader.php';
\TamoFrame\Core\AutoLoader::register();



/**
 * リクエストを実行。
 */
try {
    \TamoFrame\Core\Request::execute()->call()->display();
} catch (Exception $e) {
    echo nl2br(htmlspecialchars($e, ENT_QUOTES, "utf-8"));
}
