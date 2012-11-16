<?php
namespace TamoFrame\Core;

/**
 * 中身実装する必要ないので
 * なんとなくインターフェイスにしたけどどーなん？
 */
interface ActionBase {


    /**
     * 子クラスでオーバーライドして使う。
     */
    public function befor();
    public function after();


    /**
     * レスポンスを返す。
     * とゆーかviewファイルを読み込む。
     * Twig OR Smarty OR 素PHP
     */
    public function response();


    /**
     * smartyの場合はそのまま、
     * twigの場合は一時保存してviewSetで読み込む。
     * TODO 配列で一気に対応させてもいいかも。
     */
    public function assign($key, $value);


    /**
     * view名をセットする。
     * @param unknown $viewName
     */
    public function viewSet($viewName);


    /**
     * トークン用にランダムな文字列を作成。
     */
    public function generate();


    /**
     * トークンが一致しているかチェック。
     */
    public function checkToken($postToken);

}