<?php

/**
 * Tamo Frame - autoloader.php -
 *
 * オートロードを実装するクラス。
 * これは便利！
 *
 * @version    1.0
 * @author     tamo
 * @license    MIT License
 * @copyright  2012 tamo All Rights Reserved.
 * @link       http://tamo3.info
 */
namespace TamoFrame\Core;

class AutoLoader {


    /**
     * 読み込むディレクトリ格納
     */
    private static $dirs = array(COREPATH, APPPATH);


    /**
     * コンストラクタ
     */
    private function __construct() {
        spl_autoload_register(array($this, 'loader'));
    }


    public static function register() {
        new self();
        self::registerDir(COREPATH.'plugin/');
        self::registerDir(APPPATH.'plugin/');
        self::registerDir(APPPATH.'action/');
        self::registerDir(APPPATH.'model/');
        self::registerDir(APPPATH.'libs/');
    }


    /**
     * ディレクトリを登録
     */
    public function registerDir($dir) {
        self::$dirs[] = $dir;
    }


    /**
     * コールバック
     * @param string $classname
     */
    public function loader($classname) {

        // 順番にファイルを探す。
        foreach (self::$dirs as $dir) {

            $parts = explode('\\', $classname);
            $fileName = str_replace("_action", "", end($parts));
            $file = $dir . strtolower($fileName) . '.php';

            // ファイルがあれば読み込む。
            if(is_readable($file)) {
                require $file;
                return;
            }
        }
    }
}