<?php
namespace TamoFrame\Core;

class dao {

    private $con;
    private $stmt;


    public function __construct() {
        $this->con = \Db::get();
    }


    /**
     * クエリー実行（select用）
     * @param String $sql
     * @return Array OR null
     */
    public function executeSql($sql) {
        $this->stmt = $this->con->query($sql);
        return $this->stmt->fetchAll(\PDO::FETCH_ASSOC);
    }


    /**
     * クエリー実行（INSERT UPDATE用）
     * @param String $sql
     * @return Boolen
     */
    public function executeSqlWhite($sql) {
        $this->stmt = $this->con->exec($sql);
    }


    /**
     * プレパラートのsql文を登録。
     */
    public function setPrepareSql($sql) {
        $this->stmt = $this->con->prepare($sql);
    }


    /**
     * プレパラートのsql文を実行。
     */
    public function setPrepareParam($params) {
        for ($i=1; $i <= count($params); $i++) {
            $type = $this->getPrepareModel($params[$i-1]);
            $this->stmt->bindParam($i, $params[$i-1], $type);
        }
    }


    /**
     * プレパラートのsql文を実行。
     */
    public function executeCoresql() {
        return $this->stmt->execute();
    }


    /**
     * プレパラートの型を調べて返す。
     */
    public function getPrepareModel($value) {
        switch (true) {
            case is_bool($value) :
                $type = \PDO::PARAM_BOOL;
                break;
            case is_null($value) :
                $type = \PDO::PARAM_NULL;
                break;
            case is_int($value) :
                $type = \PDO::PARAM_INT;
                break;
            default:
                $type = \PDO::PARAM_STR;
                break;
        }
        return $type;
    }


    /**
     * プレパラートでSQL実行(SELECT用)
     * @param $sql
     * @param $params
     */
    public function executePrepare($sql, $params) {
        $this->setPrepareSql($sql);
        $this->setPrepareParam($params);
        $this->stmt->execute();
        return $this->stmt->fetchAll(\PDO::FETCH_ASSOC);
    }


    /**
     * プレパラートでSQL実行(インサート・アップデート用)
     * @param $sql
     * @param $params
     * @return boolean
     */
    public function executePrepareWhite($sql, $params) {
        $this->setPrepareSql($sql);
        $this->setPrepareParam($params);
        if ($this->stmt->execute()) {
            return true;
        }
        return false;
    }


    /**
     * 直前でインサートしたSQLを引数に入れると
     * その結果が反映されたオートインクリメントの数字を返す。
     * @param unknown_type $sql
     */
    function getLastInsertId($sql=null) {
        if ($sql == null) {
            return new Exception("実行したsqlを引数に入れてください。");
        }
        return $this->con->lastInsertId($sql);
    }


    /**
     * オートインクリメントの値先に取得。
     * 基本的にダメやけど管理画面で使う分にはおっけ。
     * @see admin
     * @param string tebleName
     * @return int id
     */
    public function getAutoIncriment($tableName) {
        $sql = "SHOW TABLE STATUS FROM {$this->databaseName} LIKE ?";
        $params  = array($tableName);
        $retData = $this->executePrepare($sql, $params);
        return $retData[0]["Auto_increment"];
    }


    /**
     * ファイル名から拡張子を取得する。
     * @see class
     * @param string fileName
     * @return string 拡張子
     */
    public function getExt($fileName) {
        if ($fileName != "") {
            return substr($fileName, strrpos($fileName, '.') + 1);
        }
    }


    /**
     * prepareのデバッグ。
     * @see class
     * @param string str1
     * @return int int1
     */
    public function debugParams() {
        $this->stmt->debugDumpParams();
    }


    /**
     * DBのエラー情報。
     * @see class
     * @param string str1
     * @return int int1
     */
    public function getErrorInfo() {
        print_r($this->stmt->errorInfo());
    }


    /**
     * トランザクションを開始する。
     * @see class
     * @param string str1
     * @return int int1
     */
    public function startTransaction() {
        $this->con->beginTransaction();
    }


    /**
     * ロールバックする。
     * @see class
     * @param string str1
     * @return int int1
     */
    public function rallbackTransaction() {
        $this->con->rollBack();
    }


    /**
     * コミットする。
     * @see class
     * @param string str1
     * @return int int1
     */
    public function commitTransaction() {
        $this->con->commit();
    }
}