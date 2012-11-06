<?php
namespace TamoFrame\Core;


class ActionBase {

    public $view;
    protected $viewName;
    protected $assignList = array();



    /**
     * 子クラスのコンストラクタから呼び出す。
     * ここには自動的に毎回処理(初期設定)の内容を書く
     */
    public function __construct() {}


    /**
     * 終了する時の処理を書く。
     */
    public function __destruct() {}


    /**
     * 子クラスでオーバーライドして使う。
     */
    public function befor() {}
    public function after() {}


    /**
     * レスポンスを返す。
     * とゆーかviewファイルを読み込む。
     * Twig OR Smarty OR 素PHP
     */
    public function response() {}


    /**
     * smartyの場合はそのまま、
     * twigの場合は一時保存してviewSetで読み込む。
     * TODO 配列で一気に対応させてもいいかも。
     */
    public function assign($key, $value) {}


    /**
     * Twig使用時viewに変数登録。
     * @param $key
     * @param $value
     */
    private function twigAssign($key, $value) {}


    /**
     * Smarty使用時viewに変数登録。
     * @param $key
     * @param $value
     */
    private function smartyAssign($key, $value) {}


    /**
     * view名をセットする。
     * @param unknown $viewName
     */
    public function viewSet($viewName) {}


    /**
     * トークン用にランダムな文字列を作成。
     */
    public function generate() {}


    /**
     * トークンが一致しているかチェック。
     */
    public function checkToken($postToken) {}


    /**
     * ページリダイレクト。
     */
    public function gotoPage($url) {}


    /**
     * エラーページへリダイレクト。
     */
    public function gotoError($errorFlg) {}

}