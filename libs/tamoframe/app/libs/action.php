<?php

/**
 * Tamo Frame - action.php -
 *
 * アクションベースクラス。
 * アクションから継承させて使う。
 *
 * @version    1.0
 * @author     tamo
 * @license    MIT License
 * @copyright  2012 tamo All Rights Reserved.
 * @link       http://tamo3.info
 */
namespace TamoFrame\App\Lib;

class action {

    public $view;
    private $viewName;
    private $assignList = array();
    protected $sessionObj;


    /**
     * 子クラスのコンストラクタから呼び出す。
     * ここには自動的に毎回処理(初期設定)の内容を書く
     */
    public function __construct() {

        /**
         * クリックジャギング対策。
         */
        header('X-FRAME-OPTIONS: SAMEORIGIN');


        /**
         * PDOコネクションを用意する。
         */
        \db::connection();


        /**
         * viewクラス。
         */
        if (\config::get("view") == "Twig") {
            $twig = new \TamoFrame\App\Lib\twig();
            $this->view = $twig->getTwig();

        } else if (\config::get("view") == "Smarty") {
            $this->view = new \TamoFrame\App\Lib\smarty();
        }


        /**
         * セッションクラス。
         */
        $this->sessionObj = new \session();


        /**
         * 現在の環境を設定。
         */
        $modeObj = new \environment(\config::get("status"));


        /**
         * エラー系を扱うクラスのオブジェクト。
         */
        $errorObj = new \errors();


        /**
         * loadクラス。
         * パスを追加する。
         */
        //set_include_path(get_include_path() . PATH_SEPARATOR . $path);


        /**
         * logクラス。
         */
        if ("none" != \config::get("log")) {
            $logObj = new log();
        }


        // 最後に子クラスのbeforを呼び出す。
        // staticでできる？遅延静的束縛というみたい。
        // static::befor();
    }


    /**
     * 終了する時の処理を書く。
     */
    public function __destruct() {
        /* ここには終了時に自動的に行う処理を書く */
        // 最後にafterを呼び出す。
        // static::after();
    }


    /**
     * 子クラスでオーバーライドして使う。
     */
    public function befor() {
    }
    public function after() {
    }


    /**
     * レスポンスを返す。
     * とゆーかviewファイルを読み込む。
     * Twig OR Smarty OR 素PHP
     */
    public function response() {

        try {
            if ("Twig" == \config::get("view")) {
                $template = $this->view->loadTemplate($this->viewName);
                echo $template->render($this->assignList);
            } else if ("Smarty" == \config::get("view")) {
                $this->view->display($this->viewName);
            }

        } catch (Exception $e) {
            echo nl2br($e);
        }
    }


    /**
     * smartyの場合はそのまま、
     * twigの場合は一時保存してviewSetで読み込む。
     * TODO 配列で一気に対応させてもいいかも。
     */
    public function assign($key, $value) {

        if ("Twig" == \config::get("view")) {
            $this->twigAssign($key, $value);
            return;
        } else if ("Smarty" == \config::get("view")) {
            $this->smartyAssign($key, $value);
            return;
        }
    }


    /**
     * Twig使用時viewに変数登録。
     * @param $key
     * @param $value
     */
    private function twigAssign($key, $value) {
        $this->assignList[$key] = $value;
    }


    /**
     * Smarty使用時viewに変数登録。
     * @param $key
     * @param $value
     */
    private function smartyAssign($key, $value) {
        $this->view->assign($key, $value);
    }


    /**
     * view名をセットする。
     * @param unknown $viewName
     */
    public function viewSet($viewName) {
        $this->viewName = $viewName;
    }


    /**
     * トークン用にランダムな文字列を作成。
     */
    public function generate() {
        return $_SESSION["syamrock"]["token"] = sha1(uniqid(mt_rand(), true));
    }


    /**
     * トークンが一致しているかチェック。
     */
    public function checkToken($postToken) {
        if ($_SESSION["syamrock"]["token"] === $postToken) {
            return true;
        }
        return false;
    }


    /**
     * ページリダイレクト。
     */
    public function gotoPage($url) {
        if ($url != "") {
            header("Location:" . $url);
            exit();
        }
    }


    /**
     * エラーページへリダイレクト。
     */
    public function gotoError($errorFlg) {
        $url = "error.php?flg={$errorFlg}";
        $this->gotoPage($url);
    }
}