<?php

/**
 * Tamo Frame - request.php -
 *
 * すべてのリクエストで実行される。
 * リクエストURLのクラスを実行する。
 *
 * @version    2.0
 * @author     tamo
 * @license    MIT License
 * @copyright  2013 tamo All Rights Reserved.
 * @link       http://tamo3.info
 */
namespace TamoFrame\Core;


class Request {

    private $url; // リクエストURL。
    private $getParams;  // $_GETのパラメーターあれば。
    private $folderName; // フォルダがあればフォルダ名。
    private $fileName   = 'index'; // 実行するclass名。
    private $methodName = 'index'; // 実行するメソッド名。
    private $hikisuu;    // メソッドに渡す引数。


    /**
     * コンストラクタ
     * リクエストURLをセット。
     */
    private function __construct() {

        // リクエストのURLを取得。
        $url = trim($_SERVER['REQUEST_URI']);

        // ?で分割する。
        $urls = explode("?", $url);
        $this->url = $urls[0]; // ?の前URL
        if (isset($urls[1])) {
            $this->getParams = $urls[1]; // ?の後URL
        }

        // 各パラメーターをセットする。
        try {
            $this->setParams();

        } catch (\Exception $e) {
            // errorAction
            $this->folderName = 'errors';
            $this->fileName   = 'error404';
        }
        return $this;
    }


    /**
     * リクエストを実行。
     */
    public static function execute() {
        return new self();
    }



    /**
     * URLを分解してセットする。
     * TODO とりあえず動くようにしただけなのであとでいい感じにまとめる。
     */
    private function setParams() {

        // 最初の空を取り除く。
        $urlList  = explode('/', $this->url, 2);

        // ドメイン以降にURLがあるか。
        if (isset($urlList[1]) && $urlList[1] != "") {

            // URLを分割。
            $urlChk = explode('/', $urlList[1], 2);

            // ファイルがあるか。
            if (is_file(APPPATH."action/".$urlChk[0].".php")) {

                // ファイル名セット。
                $fileMethodList = explode('/', $urlList[1], 3);
                $this->fileName = $fileMethodList[0];

                // メソッド指定あるか。
                if (isset($fileMethodList[1]) && $fileMethodList[1] != "") {
                    $this->methodName = $fileMethodList[1];

                    // あればメソッド名と引数をセット。
                    if (isset($fileMethodList[2]) && $fileMethodList[2] != "") {
                        $this->hikisuu = explode("/", urldecode($fileMethodList[2]));
                    }

                } else if (is_dir(APPPATH."action/".$urlChk[0])) {

                    // ディレクトリがある場合。
                    $fileMethodList = explode('/', $urlList[1], 4);
                    $this->folderName = $fileMethodList[0];

                    // メソッド指定あるか。
                    if (isset($fileMethodList[1]) && $fileMethodList[1] != "") {

                        // あればメソッド名と引数をセット。
                        $this->methodName = $fileMethodList[1];
                        if (isset($fileMethodList[2]) && $fileMethodList[2] != "") {
                            $this->hikisuu = explode("/", $fileMethodList[2]);
                        }

                    } else {
                        throw new \ErrorException("method is missing...");
                    }
                }

            } else if (is_dir(APPPATH.'action/'.$urlChk[0])) {

                // ディレクトリがある場合。
                $fileMethodList = explode('/', $urlList[1], 4);
                $this->folderName = $fileMethodList[0];

                // メソッド指定あるか。
                if (isset($fileMethodList[1]) && $fileMethodList[1] != "") {

                    // あればメソッド名と引数をセット。
                    $this->methodName = $fileMethodList[1];

                    if (isset($fileMethodList[2]) && $fileMethodList[2] != "") {
                        $this->hikisuu = explode("/", $fileMethodList[2]);
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
     * ルーティングされたメソッドを実行する。
     * @return 実行するクラスのオブジェクトを返す。
     */
    public function call() {

        $viewObj = null;

        try {
            // ファイル名からアクション名（クラス名をセット）
            $actionName = $this->fileName . "_action";

            // アクションをnewする。
            if ($this->folderName != "") {
                if ($this->fileName == 'error404') {
                	require_once APPPATH."action/".$this->folderName."/404/".$this->fileName.".php";
                	$obj = new $actionName();
                	$obj->setFolder($this->folderName);
                } else {
            				require_once APPPATH."action/".$this->folderName."/".$this->fileName.".php";
                		$obj = new $actionName();
                		$obj->setFolder($this->folderName);
                }
            } else {
                $obj = new $actionName();
            }
            // このクラスに指定したメソッドがあるかチェック。
            if (method_exists($obj, $this->methodName) === false) {
                // なければエラー。
                throw new \Exception("this method {$this->methodName} is missing.");
            }

            // $_GETの値をセットする。
            if (isset($this->getParams)) {
                $this->setGetParams();
            }

            // メソッドを実行する。
            $methodName = $this->methodName;

            if (count($this->hikisuu) != 0) {
                $viewObj = call_user_func_array(array($obj,$methodName), $this->hikisuu);
            } else {
                $viewObj = $obj->$methodName();
            }

        } catch (Exception $e) {
            throw $e;
        }
        // オブジェクトを返す。
        return $viewObj;
    }



    /**
     * $_GETのパラメーターがあった場合$_GETにkey=>valueでセットする。
     * // TODO 名前きもい。
     */
    private function setGetParams() {
        $params = explode("&", $this->getParams);
        foreach ($params as $param) {
            $keyValue = explode("=", $param);
            $_GET[$keyValue[0]] = urldecode($keyValue[1]);
        }
    }
}