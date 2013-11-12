<?php

/**
 * Tamo Frame - view.php -
 *
 * htmlファイルを表示する
 *
 * @version    2.0
 * @author     tamo
 * @license    MIT License
 * @copyright  2013 tamo All Rights Reserved.
 * @link       http://tamo3.info
 */

class View {

    private $fileName;
    private $dataset = array();
    private $datasetSafe = array();


    /**
     * new 禁止。
     * @return View
     */
    private function __construct($viewName, $data, $dataSafe) {
        $this->fileName = $viewName;
        if (null != $data && is_array($data)) {
            $this->dataset = $data;
        }
        if (null != $dataSafe && is_array($dataSafe)) {
            $this->datasetSafe = $dataSafe;
        }
        return $this;
    }


    /**
     * viewファイルをセットする。
     */
    public static function set($viewName, $data=null, $dataSafe=null) {
        return new self($viewName, $data, $dataSafe);
    }

    /**
     * viewに渡す変数をセットする。
     */
    public static function assign($data) {
        foreach ($data as $key=>$value) {
            $this->dataset[$key] = htmlspecialchars($value, ENT_QUOTES|ENT_HTML5, 'utf-8');
        }
    }


    /**
     * viewに渡す変数をセットする(htmlspecialなんとかしない版)
     */
    public static function assignSafe($data) {
        foreach ($data as $key=>$value) {
            $this->datasetSafe[$key] = $value;
        }
    }



    /**
     * viewを表示する。
     */
    public function display() {

        try {
            if (0 != count($this->dataset)) {
                extract($this->dataset);
            }
            if (0 != $this->datasetSafe) {
                extract($this->datasetSafe);
            }
            // viewファイルを読み込む。
            include APPPATH.'view/'.$this->fileName;

        } catch (\Exception $e) {
            throw $e;
        }
    }
}