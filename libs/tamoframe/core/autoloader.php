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
class AutoLoader {


    /**
     * 読み込むディレクトリ格納
     */
    private $dirs = array(COREPATH, APPPATH, LIBPATH, SRCPATH);


    /**
     * コンストラクタ
     */
    public function __construct() {
        spl_autoload_register(array($this, 'loader'));
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
        foreach ($this->dirs as $dir) {
			$parts = explode('\\', $classname);
			$fileName = str_replace("_action", "", end($parts));
			$file = $dir . $fileName . '.php';
            if(is_readable($file)) {
                require $file;
                if (count($parts) == 1) {
	                return;
                }
            }
        }
    }
}