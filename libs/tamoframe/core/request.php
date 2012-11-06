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
namespace TamoFrame\Core;


class Request {

    private $url; // リクエストURL。
    private $folderName; // フォルダがあればフォルダ名。
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
        } catch (Exception $e) {
            echo "rrrrrrrrrrrrrrrrrrrrrrrrrr";
            // errorAction
            $obj = new Error404_action();
            $obj->index();
            $obj->assign("errorMsg", $e->getMessage());
            return $obj;
        }

        try {
            return $this->call();
        } catch (Exception $e) {
            echo "eeeeeeeeeeeeeeeeeeeee";
            throw $e;
        }
    }



    /**
     * URLを分解してセットする。
     */
    private function setParams() {

        // デフォルトをセット。
        $this->fileName = "index";
        $this->methodName = "index";

        // 最初の空を取り除く。
        $urlList  = explode('/', $this->url, 2);

        // ドメイン以降にURLがあるか。
        if (isset($urlList[1]) && $urlList[1] != "") {

            // URLを分割。
            $urlChk = explode('/', $urlList[1], 2);

            // ファイルがあるか。
            if (is_file(ACTIONPATH.$urlChk[0].".php")) {

                // ファイル名セット。
                $fileMethodList = explode('/', $urlList[1], 3);
                $this->fileName = $fileMethodList[0];

                // メソッド指定あるか。
                if (isset($fileMethodList[1]) && $fileMethodList[1] != "") {
                    $this->methodName = $fileMethodList[1];

                } else if (is_dir(ACTIONPATH.$urlChk[0])) {

                    // ディレクトリがある場合。
                    $fileMethodList = explode('/', $urlList[1], 4);
                    $this->folderName = $fileMethodList[0];

                    // メソッド指定あるか。
                    if (isset($fileMethodList[1]) && $fileMethodList[1] != "") {

                        // あればメソッド名と引数をセット。
                        $this->methodName = $fileMethodList[1];
                        if (isset($fileMethodList[2]) && $fileMethodList[2] != "") {
                            $this->hikisuu = implode(",", explode("/", $fileMethodList[2]));
                        }

                    } else {
                        throw new \ErrorException("method is missing...");
                    }
                }

            } else if (is_dir(ACTIONPATH.$urlChk[0])) {

                // ディレクトリがある場合。
                $fileMethodList = explode('/', $urlList[1], 4);
                $this->folderName = $fileMethodList[0];

                // メソッド指定あるか。
                if (isset($fileMethodList[1]) && $fileMethodList[1] != "") {

                    // あればメソッド名と引数をセット。
                    $this->methodName = $fileMethodList[1];

                    if (isset($fileMethodList[2]) && $fileMethodList[2] != "") {
                        $this->hikisuu = implode(",", explode("/", $fileMethodList[2]));
                    }

                } else {
                    throw new \Exception("method is missing...");
                }

            } else {
                throw new \Exception("file is missing...");
            }
        }
    }



    /**
     * class（メソッド）を実行する。
     * 実行するとViewオブジェクトが返ってくるので、
     * それを使用してViewを呼び出す。
     * errorがあった場合はここでキャッチする？
     */
    private function call() {

        try {
            // ファイル名からアクション名（クラス名をセット）
            $actionName = $this->fileName . "_action";

            // アクションをnewする。
            if ($this->folderName != "") {
                require_once ACTIONPATH.$this->folderName."/".$this->fileName.".php";
                $obj = new $actionName();
                $obj->setFolder($this->folderName);
            } else {
                $obj = new $actionName();
            }
            // このクラスに指定したメソッドがあるかチェック。
            if (method_exists($obj, $this->methodName) === false) {
                // なければエラー。
                throw new \Exception("this method {$this->methodName} is missing.");
            }

            // メソッドを実行する。
            $methodName = $this->methodName;
            $obj->$methodName();

        } catch (Exception $e) {
            echo "gggggggggggggg";
            throw $e;
        }

        // オブジェクトを返す。
        return $obj;
    }
}