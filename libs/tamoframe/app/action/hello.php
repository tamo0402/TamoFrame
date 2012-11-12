<?php

class Hello_action extends Action {

    /**
     * 親クラスをnewする。
     */
    public function __construct() {
        parent::__construct();
    }


    /**
     * indexが呼ばれた時。
     */
    public function index() {
        $this->assign("title", "TamoFrame | Hello");
        $this->viewSet('hello.tpl'); // tplの場合。
    }


    /**
     * 引数に渡すパターン。
     * @param $hikisuu
     */
    public function sample($hikisuu) {
        $this->assign("hello", trim($hikisuu));
        $this->viewSet('hello.tpl');
    }


    /**
     * POSTの処理。
     */
    public function samplePost() {
        $this->assign("hello", trim($_POST["hello"]));
        $this->viewSet('hello.tpl');
    }


    /**
     * GETの処理。
     */
    public function sampleGet() {

        $this->assign("hello", trim($_GET["hello"]) . trim($_GET["hello2"]));
        $this->viewSet('hello.tpl');
    }
}