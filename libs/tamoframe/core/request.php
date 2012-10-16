<?php

/**
 * Tamo Frame - request.php -
 *
 * すべてのリクエストで実行される。
 * リクエストURLのクラスを実行する。
 *
 * @version    1.0
 * @author     tamo
 * @license    MIT License
 * @copyright  2012 tamo All Rights Reserved.
 * @link       http://tamo3.info
 */
class request {

    private $url; // リクエストURL。
    private $fileName;   // 実行するclass名。
    private $methodName; // 実行するメソッド名。
    private $hikisuu;    // メソッドに渡す引数。


    /**
     * コンストラクタ
     * リクエストURLをセット。
     */
    public function __construct() {
        $this->url = $_SERVER['REQUEST_URI'];
    }


    /**
     * リクエストURLを実行する。
     * 実行でエラーの場合はエラーページを実行しているので
     * 以降はどちらもページを表示する処理。
     */
    public function executeRequest() {
        try {

            $this->setParams();
            return $this->call();

        } catch (Exception $e) {
            echo "error!!";
            echo $e;
        }
    }



    /**
     * URLを分解してセットする。
     */
    private function setParams() {

        // 最初の空を取り除く。
        $urlList  = explode('/', $this->url, 2);

        // ファイル指定あるか。
        if ($urlList[1] != "") {

            // あればファイル名をセット。
            $fileMethodList = explode('/', $urlList[1], 3);
            $this->fileName = $fileMethodList[0];

            // メソッド指定あるか。
            if (isset($fileMethodList[1])) {

                // あればメソッド名と引数をセット。
                $this->methodName = $fileMethodList[1];
                $this->hikisuu = implode(",", explode("/", $fileMethodList[2]));
            }

        } else {
            // なければデフォルトセット。
            $this->fileName = "index";
            $this->methodName = "index";
        }
    }




    /**
     * class（メソッド）を実行する。
     * 実行するとViewオブジェクトが返ってくるので、
     * それを使用してViewを呼び出す。
     * errorがあった場合はここでキャッチする？
     * TODO errorを配列にするかExceptionにするか。
     */
    private function call() {
        try {
            if (is_file($this->fileName . ".php") === false) {
                $this->fileName = "error404";
                $this->methodName = "index";
            }
            $actionName = $this->fileName . "_action";

            require_once LIBPATH . 'action.php';

            $obj = new $actionName();
            if (method_exists($obj, $this->methodName) === false) {
                throw new Exception("this method {$this->methodName} is missing.");
            }
            $methodName = $this->methodName;
            $obj->$methodName();
            return $obj;

        } catch (Exception $e) {
            throw $e;
        }
    }
}