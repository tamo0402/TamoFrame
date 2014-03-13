<?php

// Modelで使うファイルを読み込む。
// require_once APPPATH . 'model/member.php';

class Index_action extends Action {
    public function index() {
    	  $data["title"] = "hello word!!";
        $data["token"] = $this->generate();
        return \View::set("index.html", $data);
    }
}