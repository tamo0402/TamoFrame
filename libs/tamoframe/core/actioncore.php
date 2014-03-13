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
namespace TamoFrame\Core;

class ActionCore {

    public $view;
    private $viewName;
    private $assignList = array();
    private $folder;
    protected $sessionObj;

    /**
     * 子クラスのコンストラクタから呼び出す。
     * ここには自動的に毎回処理(初期設定)の内容を書く
     */
    public function __construct() {

        /**
         * PDOコネクションを用意する。
         */
        //\TamoFrame\Core\db::connection();


        /**
         * セッションクラス。
         */
        //$this->sessionObj = new \TamoFrame\Core\Session();


        /**
         * 現在の環境を設定。
         */
        //$modeObj = new \TamoFrame\Core\Environment(\Config::get("status"));


        /**
         * エラー系を扱うクラスのオブジェクト。
         */
        //$errorObj = new \TamoFrame\Core\Errors();


//         /**
//          * logクラス。
//          */
//         if ("none" != \Config::get("log")) {
//             $logObj = new log();
//         }


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
    public function befor() {}
    public function after() {}


    /**
     * トークン用にランダムな文字列を作成。
     */
    public function generate() {
        return $_SESSION["tamoframe_security"]["token"] = sha1(uniqid(mt_rand(), true));
    }


    /**
     * トークンが一致しているかチェック。
     */
    public function checkToken($postToken) {
        if ($_SESSION["tamoframe_security"]["token"] === $postToken) {
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



    /**
     * フォルダを作成し、その中にactionがある場合のフォルダをセット。
     */
    public function setFolder($folder) {
        $this->folder = $folder;
    }
}