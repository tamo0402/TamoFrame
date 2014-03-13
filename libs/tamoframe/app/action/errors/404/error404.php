<?php

/**
 * Tamo Frame - error404.php -
 *
 * ページなしエラー。
 *
 * @version    1.0
 * @author     tamo
 * @license    MIT License
 * @copyright  tamo All Rights Reserved.
 * @link       http://tamo3.info
 */
class Error404_action extends Action {

    public function index() {

    	  $aaNo       = [0,1,2,3,4,5];
    	  $comentNo   = [0,1,2,3,4];
        $aaList     = require_once 'aa.php';
        $comentList = require_once 'coment.php';

        $data["aa"]     = $aaList[array_rand($aaNo, 1)];
        $data["coment"] = nl2br($comentList[array_rand($comentNo, 1)]);

        return \View::set('/errors/404.html', $data);
    }
}