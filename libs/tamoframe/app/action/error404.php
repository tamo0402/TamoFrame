<?php

/**
 * Tamo Frame - error404.php -
 *
 * ページなしエラー。
 *
 * @version    2.0
 * @author     tamo
 * @license    MIT License
 * @copyright  2013 tamo All Rights Reserved.
 * @link       http://tamo3.info
 */

class Error404_action extends Action {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->viewSet('error404.html');
    }
}