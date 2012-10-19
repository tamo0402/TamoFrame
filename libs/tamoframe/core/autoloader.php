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
    private $dirs = array(COREPATH, LIBPATH, ACTIONPATH, MODELPATH);


    /**
     * コンストラクタ
     */
    private function __construct() {
        spl_autoload_register(array($this, 'loader'));
    }


    public static function register() {
        new self();
    }


    /**
     * ディレクトリを登録
     */
    public function registerDir($dir) {
        $this->dirs[] = $dir;
    }


    /**
     * コールバック
     * @param string $classname
     */
    public function loader($classname) {

        // TwigのオートローダーとかぶるのでTwigの場合は処理しない。
        if (0 === strpos($classname, 'Twig')) {
            return;
        }

        // 順番にファイルを探す。
        foreach ($this->dirs as $dir) {

            $parts = explode('\\', $classname);
            $fileName = str_replace("_action", "", end($parts));
            $file = $dir . strtolower($fileName) . '.php';

            echo $file, "<br>";

            // ファイルがあれば読み込む。
            if(is_readable($file)) {
                require $file;
                return;
            }
        }
    }
}