<?php

// Modelで使うファイルを読み込む。
class Index_action extends \Action {

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

        $data["title"] = "TamoFrame | index";
        $data["name"]  = "World!!";
        return \View::set("index.html", $data);
    }
}