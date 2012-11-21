<?php

// Modelで使うファイルを読み込む。
// require_once APPPATH . 'model/member.php';

class Index_action extends Action {

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

        // DB操作する時はこんな感じかな？
        //try {
        //    $memberDao = new member();
        //    $retData = $memberDao->getAllData());
        //    print_r($retData);
        //} catch (PDOException $e) {
        //    throw $e;
        //}

        $this->assign("title", "TamoFrame | index");
        $this->assign("name", "World!!");
        $this->viewSet('index.html');
    }
}