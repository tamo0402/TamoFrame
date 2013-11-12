<?php


/*
 * Created 2012/10/17
 *
 */

class Member extends \TamoFrame\Core\dao {

    private $allValue = array();
    private $id;
    private $loginId;
    private $loginPw;
    private $auth;
    private $sei;
    private $mei;
    private $kanaSei;
    private $kanaMei;
    private $mailaddress;
    private $zipCode;
    private $prefId;
    private $address1;
    private $address2;
    private $tel;
    private $useFlg;
    private $delFlg;
    private $created;
    private $modified;

    // セッターゲッター
    public function setId($set) {  $this->id = $set;  }
    public function setLoginId($set) {  $this->loginId = $set;  }
    public function setLoginPw($set) {  $this->loginPw = $set;  }
    public function setAuth($set) {  $this->auth = $set;  }
    public function setSei($set) {  $this->sei = $set;  }
    public function setMei($set) {  $this->mei = $set;  }
    public function setKanaSei($set) {  $this->kanaSei = $set;  }
    public function setKanaMei($set) {  $this->kanaMei = $set;  }
    public function setMailaddress($set) {  $this->mailaddress = $set;  }
    public function setZipCode($set) {  $this->zipCode = $set;  }
    public function setPrefId($set) {  $this->prefId = $set;  }
    public function setAddress1($set) {  $this->address1 = $set;  }
    public function setAddress2($set) {  $this->address2 = $set;  }
    public function setTel($set) {  $this->tel = $set;  }
    public function setUseFlg($set) {  $this->useFlg = $set;  }
    public function setDelFlg($set) {  $this->delFlg = $set;  }
    public function setCreated($set) {  $this->created = $set;  }
    public function setModified($set) {  $this->modified = $set;  }
    public function getId() { return $this->id; }
    public function getLoginId() { return $this->loginId; }
    public function getLoginPw() { return $this->loginPw; }
    public function getAuth() { return $this->auth; }
    public function getSei() { return $this->sei; }
    public function getMei() { return $this->mei; }
    public function getKanaSei() { return $this->kanaSei; }
    public function getKanaMei() { return $this->kanaMei; }
    public function getMailaddress() { return $this->mailaddress; }
    public function getZipCode() { return $this->zipCode; }
    public function getPrefId() { return $this->prefId; }
    public function getAddress1() { return $this->address1; }
    public function getAddress2() { return $this->address2; }
    public function getTel() { return $this->tel; }
    public function getUseFlg() { return $this->useFlg; }
    public function getDelFlg() { return $this->delFlg; }
    public function getCreated() { return $this->created; }
    public function getModified() { return $this->modified; }

    public function getAllValue() {
        $this->allValue[0]["id"]  = $this->id;
        $this->allValue[0]["login_id"]  = $this->loginId;
        $this->allValue[0]["login_pw"]  = $this->loginPw;
        $this->allValue[0]["auth"]  = $this->auth;
        $this->allValue[0]["sei"]  = $this->sei;
        $this->allValue[0]["mei"]  = $this->mei;
        $this->allValue[0]["kana_sei"]  = $this->kanaSei;
        $this->allValue[0]["kana_mei"]  = $this->kanaMei;
        $this->allValue[0]["mailaddress"]  = $this->mailaddress;
        $this->allValue[0]["zip_code"]  = $this->zipCode;
        $this->allValue[0]["pref_id"]  = $this->prefId;
        $this->allValue[0]["address1"]  = $this->address1;
        $this->allValue[0]["address2"]  = $this->address2;
        $this->allValue[0]["tel"]  = $this->tel;
        $this->allValue[0]["use_flg"]  = $this->useFlg;
        $this->allValue[0]["del_flg"]  = $this->delFlg;
        $this->allValue[0]["created"]  = $this->created;
        $this->allValue[0]["modified"]  = $this->modified;
        return $this->allValue;
    }




    /**
     * コンストラクタ
     * 親クラスのコンストラクタを呼ぶ。
     */
    public function __construct() {
        parent::__construct();
    }



    /**
	 * すべてのデータ取得。
     * @see class
	 * @param
	 * @return array データ。
	 */
    public function getAllData() {
        return $this -> executeSql("SELECT * FROM member");
    }



    /**
	 * idでデータを取得
	 * @see class
	 * @param int id
	 * @return array データ。
	 */
    public function getDataById($id) {
        $sql = "SELECT * FROM member WHERE id = ?";
        $params = array($id);
        return $this->executePrepare($sql, $params);
    }



	/**
	 * idでデータを更新。
	 * @see class
	 * @param int id
	 * @return bool 更新結果。
	 */
    public function updateData() {

        $sql = "UPDATE member SET
        login_id = ?
        , login_pw = ?
        , auth = ?
        , sei = ?
        , mei = ?
        , kana_sei = ?
        , kana_mei = ?
        , mailaddress = ?
        , zip_code = ?
        , pref_id = ?
        , address1 = ?
        , address2 = ?
        , tel = ?
        , use_flg = ?
        , del_flg = ?
        , created = ?
        , modified = ?
        WHERE id = ? ";

        $params = array(
            $this->loginId,
            $this->loginPw,
            $this->auth,
            $this->sei,
            $this->mei,
            $this->kanaSei,
            $this->kanaMei,
            $this->mailaddress,
            $this->zipCode,
            $this->prefId,
            $this->address1,
            $this->address2,
            $this->tel,
            $this->useFlg,
            $this->delFlg,
            $this->created,
            $this->modified,
            $this->id
        );
        return $this->executePrepareWhite($sql, $params);
    }



	/**
	 * 新規登録。
	 * @see class
	 * @param int id
	 * @return bool 登録結果。
	 */
    public function insertData() {
        $sql = "INSERT INTO member values ('',
        ?,
        ?,
        ?,
        ?,
        ?,
        ?,
        ?,
        ?,
        ?,
        ?,
        ?,
        ?,
        ?,
        ?,
        ?,
        ?,
        ?)";
        $params = array(
            "{$this->loginId}",
            "{$this->loginPw}",
            "{$this->auth}",
            "{$this->sei}",
            "{$this->mei}",
            "{$this->kanaSei}",
            "{$this->kanaMei}",
            "{$this->mailaddress}",
            "{$this->zipCode}",
            "{$this->prefId}",
            "{$this->address1}",
            "{$this->address2}",
            "{$this->tel}",
            "{$this->useFlg}",
            "{$this->delFlg}",
            "{$this->created}",
            "{$this->modified}"
        );
        return $this->executePrepareWhite($sql, $params);
    }



	/**
	 * データの削除。
	 * @see class
	 * @param int id
	 * @return bool 削除結果。
	 */
    private function deleteDataById() {
        $sql = "DELETE FROM member WHERE id = ?";
        $params = array($this->id);
        return $this->executePrepareWhite($sql, $params);
    }
}
