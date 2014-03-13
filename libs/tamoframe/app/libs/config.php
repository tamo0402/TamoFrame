<?php

/**
 * Tamo Frame - config.php -
 *
 * 設定ファイル。
 * 自分用にアプリごとに書き換える。
 *
 * @version    1.0
 * @author     tamo
 * @license    MIT License
 * @copyright  2012 tamo All Rights Reserved.
 * @link       http://tamo3.info
 */
return array(

/********************************************************
 *                                                      *
 *   url                                                *
 *                                                      *
 ********************************************************/
    /**
     * baseurl
     */
    "base_url" => 'http://mydomain/',


/********************************************************
 *                                                      *
 *   環境設定。                                         *
 *                                                      *
 ********************************************************/

    /**
     * 現在のモードを選択。
     * @see /app/libs/environment.php
     * 1 : $production
     * 2 : $develop
     * 3 : $test
     * 4 : $mentenance
     */
    "status" => \TamoFrame\Core\environment::$develop,



/********************************************************
 *                                                      *
 *   ログに関する設定。                                 *
 *                                                      *
 ********************************************************/

    /**
     * オリジナルlogを記録するかの設定。
     * @see /core/log.php
     * none : 記録しない。
     * none以外 : 記録する。
     * デフォルトは記録しない。
     */
    "log" => "none",


    /**
     * logの保存場所を指定する。
     * @see /core/log.php
     */
    "log_path" => APPPATH . "log/",


    /**
     * logのファイル名を指定する。
     * 指定しなければ年月日.txt
     * @see /core/log.php
     */
    "log_file_name" => "",
);
