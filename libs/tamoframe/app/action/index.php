<?php

// Modelで使うファイルを読み込む。
// require_once APPPATH . 'model/member.php';

class index_action extends \TamoFrame\App\Lib\action {

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

        // DB操作する時。
        //$memberDao = new member();
        //print_r($memberDao->getAllData());

        $this->assign("title", "TamoFrame | index");
        $this->assign("name", "World!!");
        $this->viewSet('index.html');
    }
}