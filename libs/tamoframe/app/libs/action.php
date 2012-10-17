<?php

/**
 * Tamo Frame - tamoframe.php -
 *
 * すべてのクラスで実行されるベースの処理。
 * よくあるなんとかアクション的なクラスの予定。
 * DBのコネクションとか初期設定する感じかな？
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

    /**
     * 子クラスのコンストラクタから呼び出す。
     * ここには自動的に毎回処理(初期設定)の内容を書く
     * TODO Coreのほうにいじられたくない処理を書いて継承させようかな。
     */
    public function __construct() {

        // クリックジャギング対策。
        header('X-FRAME-OPTIONS: SAMEORIGIN');


        // コンフィグ取得。
        //$this->conf = new config;
        //$this->conf = config::get();


        // PDOコネクションを用意する。
        \db::connection();


        // viewのエンジン取得。
        if (true) {
            //$this->view = new \TamoFrame\App\Lib\smarty();

            $myobj = new \TamoFrame\App\Lib\twig();
            $this->view = $myobj->getTwig();
        }


        /**
         * セッションクラス。
         */


        /**
         * 現在のモードを反映。
         * 1:運用中 2:デバッグ中 3:工事中
         */


        /**
         * エラー系を扱うクラスのオブジェクト。
         */


        /**
         * loadクラス
         * パスを追加する。
         * alwaysload的なもん？
         */
        //set_include_path(get_include_path() . PATH_SEPARATOR . $path);


        // logに書き込み。


        // 最後に子クラスのbeforを呼び出す。
        $this->befor();
    }


    /**
     * smartyの場合はそのまま、
     * twigの場合は一時保存してviewSetで読み込む。
     * TODO 配列で一気に対応させてもいいかも。
     */
    public function assign($key, $value) {

        // twig OR smarty
        if (true) {
            $this->twigAssign($key, $value);
        } else {
            $this->smartyAssign($key, $value);
        }
    }
    private function twigAssign($key, $value) {
        $this->assignList[$key] = $value;
    }
    private function smartyAssign($key, $value) {
        $this->view->assign($key, $value);
    }

    public function viewSet($viewName) {
        $this->viewName = $viewName;
    }


    public function response() {

        try {
            // twig OR smarty
            if (true) {
                $template = $this->view->loadTemplate($this->viewName);
                echo $template->render($this->assignList);
            } else {
                $this->view->display($this->viewName);
            }
        } catch (Exception $e) {
            echo $e;
        }
    }


    /**
     * 子クラスでオーバーライドして使う。
     */
    public function befor() {
        // ここに直接は書かない。
    }



    /**
     * 終了する時の処理を書く。
     */
    public function __destruct() {

        // ここには終了時に自動的に行う処理を書く。

        // afterを呼び出す。
    }



    /**
     * 子クラスでオーバーライドして使う。
     */
    public function after() {
        // ここに直接は書かない。
    }
}