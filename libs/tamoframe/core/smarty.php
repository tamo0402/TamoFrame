<?php

namespace TamoFrame\Core;


require_once COREPATH . '/vender/smarty/Smarty.class.php';

class Smarty extends \Smarty {

    private $templateDir;
    private $compileDir;

    /** 親クラスのコンストラクタを呼ぶ。 */
    public function __construct() {
        parent::__construct();

        // コンストラクタで設定したものを使用する。
        $this->template_dir = APPPATH . "view";
        $this->compile_dir  = APPPATH . "cache";

        // すべて共通の処理。
        $this->left_delimiter  = "{{";
        $this->right_delimiter = "}}";
        $this->default_modifiers = array('escape');
    }
}