<?php


/*
 * Created on 2012/05/15
 *
 */
class m_member_dao extends dao {

    private $allValue = array();
    private $memberId;
    private $memberAuth;
    private $loginId;
    private $loginPw;
    private $memberSei;
    private $memberMei;
    private $memberKanasei;
    private $memberKanamei;
    private $memberZip;
    private $memberPref;
    private $memberAddress1;
    private $memberAddress2;
    private $memberMail;
    private $memberTel;
    private $memberImage;
    private $memberComment;
    private $memberUse;
    private $memberDelete;
    private $created;
    private $modified;

    // カラムにないもの追加。
    public $chkPw;
    public $memberTel2;
    public $memberTel3;
    public $chkMail;
    public $userCode;

    // パスワード用
    private $fixedSalt = 'qazwsxedcrfvtgbyhnujmikolp';
    private $stretchcount = 1000;



    // セッターゲッター。
    public function setMemberId($set) {  $this->memberId = $set;  }
    public function setMemberAuth($set) {  $this->memberAuth = $set;  }
    public function setLoginId($set) {  $this->loginId = $set;  }
    public function setLoginPw($set) {  $this->loginPw = $set;  }
    public function setMemberSei($set) {  $this->memberSei = $set;  }
    public function setMemberMei($set) {  $this->memberMei = $set;  }
    public function setMemberKanasei($set) {  $this->memberKanasei = $set;  }
    public function setMemberKanamei($set) {  $this->memberKanamei = $set;  }
    public function setMemberZip($set) {  $this->memberZip = $set;  }
    public function setMemberPref($set) {  $this->memberPref = $set;  }
    public function setMemberAddress1($set) {  $this->memberAddress1 = $set;  }
    public function setMemberAddress2($set) {  $this->memberAddress2 = $set;  }
    public function setMemberMail($set) {  $this->memberMail = $set;  }
    public function setMemberTel($set) {  $this->memberTel = $set;  }
    public function setMemberImage($set) {  $this->memberImage = $set;  }
    public function setMemberComment($set) {  $this->memberComment = $set;  }
    public function setMemberUse($set) {  $this->memberUse = $set;  }
    public function setMemberDelete($set) {  $this->memberDelete = $set;  }
    public function setCreated($set) {  $this->created = $set;  }
    public function setModified($set) {  $this->modified = $set;  }
    public function getMemberId() { return $this->memberId; }
    public function getMemberAuth() { return $this->memberAuth; }
    public function getLoginId() { return $this->loginId; }
    public function getLoginPw() { return $this->loginPw; }
    public function getMemberSei() { return $this->memberSei; }
    public function getMemberMei() { return $this->memberMei; }
    public function getMemberKanasei() { return $this->memberKanasei; }
    public function getMemberKanamei() { return $this->memberKanamei; }
    public function getMemberZip() { return $this->memberZip; }
    public function getMemberPref() { return $this->memberPref; }
    public function getMemberAddress1() { return $this->memberAddress1; }
    public function getMemberAddress2() { return $this->memberAddress2; }
    public function getMemberMail() { return $this->memberMail; }
    public function getMemberTel() { return $this->memberTel; }
    public function getMemberImage() { return $this->memberImage; }
    public function getMemberComment() { return $this->memberComment; }
    public function getMemberUse() { return $this->memberUse; }
    public function getMemberDelete() { return $this->memberDelete; }
    public function getCreated() { return $this->created; }
    public function getModified() { return $this->modified; }

    public function getAllValue() {

        $this->allValue[0]["member_id"] = $this -> memberId;
        $this->allValue[0]["member_auth"] = $this -> memberAuth;
        $this->allValue[0]["login_id"] = $this -> loginId;
        $this->allValue[0]["login_pw"] = $this -> loginPw;
        $this->allValue[0]["chk_pw"] = $this->chkPw;
        $this->allValue[0]["member_sei"] = $this -> memberSei;
        $this->allValue[0]["member_mei"] = $this -> memberMei;
        $this->allValue[0]["member_kanasei"] = $this -> memberKanasei;
        $this->allValue[0]["member_kanamei"] = $this -> memberKanamei;
        $this->allValue[0]["member_zip"] = $this -> memberZip;
        $this->allValue[0]["member_pref"] = $this -> memberPref;
        $this->allValue[0]["member_address1"] = $this -> memberAddress1;
        $this->allValue[0]["member_address2"] = $this -> memberAddress2;
        $this->allValue[0]["member_mail"] = $this -> memberMail;
        $this->allValue[0]["chk_mail"] = $this -> chkMail;
        $this->allValue[0]["member_tel"] = $this -> memberTel;
        $this->allValue[0]["member_image"] = $this -> memberImage;
        $this->allValue[0]["member_comment"] = $this -> memberComment;
        $this->allValue[0]["member_use"] = $this -> memberUse;
        $this->allValue[0]["member_delete"] = $this -> memberDelete;
        $this->allValue[0]["created"] = $this -> created;
        $this->allValue[0]["modified"] = $this -> modified;
        $this->allValue[0]["member_tel2"] = $this->memberTel2;
        $this->allValue[0]["member_tel3"] = $this->memberTel3;

        return $this->allValue;
    }





    public function __construct() {
        parent::__construct();
    }



    public function getAllData() {
        $sql = "SELECT * FROM m_member WHERE member_delete = ? ORDER BY created DESC ";
        $params = array(0);
        return $this -> executePreparePager($sql, $params);
    }



    private function getData($sql, $params) {
        return $this->executePrepare($sql, $params);
    }



    private function getDataObj($sql, $params) {
        $result = $this->executePrepare($sql, $params);
        foreach($result as $re) {
            $obj = new m_member();
            $obj -> setMemberId($re["member_id"]);
            $obj -> setMemberAuth($re["member_auth"]);
            $obj -> setLoginId($re["login_id"]);
            $obj -> setLoginPw($re["login_pw"]);
            $obj -> setMemberSei($re["member_sei"]);
            $obj -> setMemberMei($re["member_mei"]);
            $obj -> setMemberKanasei($re["member_kanasei"]);
            $obj -> setMemberKanamei($re["member_kanamei"]);
            $obj -> setMemberZip($re["member_zip"]);
            $obj -> setMemberPref($re["member_pref"]);
            $obj -> setMemberAddress1($re["member_address1"]);
            $obj -> setMemberAddress2($re["member_address2"]);
            $obj -> setMemberMail($re["member_mail"]);
            $obj -> setMemberTel($re["member_tel"]);
            $obj -> setMemberImage($re["member_image"]);
            $obj -> setMemberComment($re["member_comment"]);
            $obj -> setMemberUse($re["member_use"]);
            $obj -> setMemberDelete($re["member_delete"]);
            $obj -> setCreated($re["created"]);
            $obj -> setModified($re["modified"]);
            $ret[] = $obj;
        }
        return $ret;
    }



    public function getDataById($id) {
        $sql = "SELECT * FROM m_member WHERE member_id = ? AND member_delete = '0'";
        $params = array($id);
        return $this->executePrepare($sql, $params);
    }



    public function updateData($obj) {

        $sql = "UPDATE m_member SET
        member_auth = ?
        , login_id = ?
        , login_pw = ?
        , member_sei = ?
        , member_mei = ?
        , member_kanasei = ?
        , member_kanamei = ?
        , member_zip = ?
        , member_pref = ?
        , member_address1 = ?
        , member_address2 = ?
        , member_mail = ?
        , member_tel = ?
        , member_image = ?
        , member_comment = ?
        , member_use = ?
        , member_delete = ?
        , created = ?
        , modified = ?
        WHERE member_id = ? ";

        $params = array(
            $obj -> getMemberAuth(),
            $obj -> getLoginId(),
            $obj -> getLoginPw(),
            $obj -> getMemberSei(),
            $obj -> getMemberMei(),
            $obj -> getMemberKanasei(),
            $obj -> getMemberKanamei(),
            $obj -> getMemberZip(),
            $obj -> getMemberPref(),
            $obj -> getMemberAddress1(),
            $obj -> getMemberAddress2(),
            $obj -> getMemberMail(),
            $obj -> getMemberTel(),
            $obj -> getMemberImage(),
            $obj -> getMemberComment(),
            $obj -> getMemberUse(),
            $obj -> getMemberDelete(),
            $obj -> getCreated(),
            $obj -> getModified(),
            $obj->getMemberId()
        );

        if ($this -> executePrepareWhite($sql, $params) === false) {
            return false;
        }
        return ture;
    }


    public function insertData($obj) {

        $sql = "INSERT INTO m_member values ('',
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
        ?,
        ?,
        ?)";
        $params = array(
            "{$obj -> getMemberAuth()}",
            "{$obj -> getLoginId()}",
            "{$obj -> getLoginPw()}",
            "{$obj -> getMemberSei()}",
            "{$obj -> getMemberMei()}",
            "{$obj -> getMemberKanasei()}",
            "{$obj -> getMemberKanamei()}",
            "{$obj -> getMemberZip()}",
            "{$obj -> getMemberPref()}",
            "{$obj -> getMemberAddress1()}",
            "{$obj -> getMemberAddress2()}",
            "{$obj -> getMemberMail()}",
            "{$obj -> getMemberTel()}",
            "{$obj -> getMemberImage()}",
            "{$obj -> getMemberComment()}",
            "{$obj -> getMemberUse()}",
            "{$obj -> getMemberDelete()}",
            "{$obj -> getCreated()}",
            "{$obj -> getModified()}"
        );

        if ($this -> executePrepareWhite($sql, $params) === false) {
            return false;
        }
        return true;
    }


    public function deleteData($obj) {
        return $this -> deleteDataById($obj -> getMemberId());
    }

    private function deleteDataById($id) {

        $sql = "DELETE FROM m_member WHERE member_id = ?";
        $params = array($id);

        if ($this -> executePrepareWhite($sql, $params) === false) {
            return false;
        }
        return true;
    }

    // ここまで自動生成 --------------------------------------------------------------------------




    /**
    * チェックする。
    * @see ticket.php
    * @return bool チェック結果。
    */
    public function check() {

        // 購入者情報。
        if ($this->loginId == "") {
            init::$errObj->setErrors("ログインIDが入力されていません。");
        } else if (init::$chkObj->checkLength($this->loginId, 16) === false) {
            init::$errObj->setErrors("ログインIDは16文字以内で入力してください。");
        }
        if ($this->loginPw == "") {
            init::$errObj->setErrors("パスワードが入力されていません。");
        } else if (init::$chkObj->checkLength($this->loginPw, 6, 16) === false) {
            init::$errObj->setErrors("パスワードは6文字以上16文字以内で入力してください。");
        }
        if ($this->chkPw == "") {
            init::$errObj->setErrors("確認用パスワードが入力されていません。");
        } else if ($this->loginPw != $this->chkPw) {
            init::$errObj->setErrors("ログインパスワードと確認用パスワードが一致しません。");
        }
        if ($this->memberSei == "") {
            init::$errObj->setErrors("お名前（姓）が入力されていません。");
        } else if (init::$chkObj->checkLength($this->memberSei, 32) === false) {
            init::$errObj->setErrors("お名前（姓）は32文字以内で入力してください。");
        }
        if ($this->memberMei == "") {
            init::$errObj->setErrors("お名前（名）が入力されていません。");
        } else if (init::$chkObj->checkLength($this->memberMei, 32) === false) {
            init::$errObj->setErrors("お名前（名）は32文字以内で入力してください。");
        }
        if ($this->memberKanasei == "") {
            init::$errObj->setErrors("フリガナ（姓）が入力されていません。");
        } else if (init::$chkObj->checkLength($this->memberKanasei, 64) === false) {
            init::$errObj->setErrors("フリガナ（姓）は64文字以内で入力してください。");
        }
        if ($this->memberKanamei == "") {
            init::$errObj->setErrors("フリガナ（名）が入力されていません。");
        } else if (init::$chkObj->checkLength($this->memberKanamei, 64) === false) {
            init::$errObj->setErrors("フリガナ（名）は64文字以内で入力してください。");
        }
        if ($this->memberTel == "") {
            init::$errObj->setErrors("電話番号1を入力してください。");
        } else if (init::$chkObj->checkNumric($this->memberTel) === false) {
            init::$errObj->setErrors("電話番号1は数字で入力してください。");
        }
        if ($this->memberTel2 == "") {
            init::$errObj->setErrors("電話番号2を入力してください。");
        } else if (init::$chkObj->checkNumric($this->memberTel2) === false) {
            init::$errObj->setErrors("電話番号2は数字で入力してください。");
        }
        if ($this->memberTel3 == "") {
            init::$errObj->setErrors("電話番号3を入力してください。");
        } else if (init::$chkObj->checkNumric($this->memberTel3) === false) {
            init::$errObj->setErrors("電話番号3は数字で入力してください。");
        }
        if ($this->memberZip == "") {
            init::$errObj->setErrors("郵便番号が入力されていません。");
        } else if (init::$chkObj->chkZip($this->memberZip) === false) {
            init::$errObj->setErrors("郵便番号は半角数字またはハイフンのみ使用できます。");
        }
        if ($this->memberPref == "") {
            init::$errObj->setErrors("都道府県が選択されていません。");
        }
        if ($this->memberAddress1 == "") {
            init::$errObj->setErrors("住所が入力されていません。");
        }
        if ($this->memberMail == "") {
            init::$errObj->setErrors("メールアドレスが入力されていません。");
        } else if (!preg_match('/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/', $this->memberMail)) {
            init::$errObj->setErrors("メールアドレスの記述が正しくありません。");
        } else if (init::$chkObj->checkLength($this->memberMail, 100) === false) {
            init::$errObj->setErrors("メールアドレスは100文字以内で入力してください。");
        } else {

            // 登録されているメールアドレスかチェック。
            $sql = "SELECT * FROM m_member WHERE member_mail = ? AND member_auth = '1'";
            $params = array($this->memberMail);
            $chkData = $this->executePrepare($sql, $params);
            if (count($chkData) != 0) {
                init::$errObj->setErrors("そのメールアドレスは既に使用されています。");
            }
        }

        if ($this->chkMail == "") {
            init::$errObj->setErrors("確認用メールアドレスが入力されていません。");
        } else if ($this->memberMail != $this->chkMail) {
            init::$errObj->setErrors("メールアドレスと確認用メールアドレスが一致しません。");
        }

        if (count(init::$errObj->getErrors()) == 0) {
            return true;
        }
        return false;
    }



    /**
     * 会員登録処理。
     * @see member_regist.php
     * @return bool 登録結果。
     */
    public function regist() {

        $today = date("YmdHis");

        // 本登録用のユーザーコードを作成する。ばれてもあんま問題ないのでゆるめ。
        $this->userCode = uniqid(rand());


        // パスワードをハッシュ化する。
        $hashPassword = $this->getHashPassword();


        // 登録するデータを取得。
        $sql = "INSERT INTO m_member (
        member_auth, user_code, login_id, login_pw, member_sei, member_mei, member_kanasei, member_kanamei, member_zip, member_pref, member_address1,
        member_address2, member_mail, member_tel, member_image, member_comment, member_use, member_delete, created, modified) values
        ('0', ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '1', '0', $today, $today)";

        $params = array(
            $this->userCode,
            $this->loginId,
            $hashPassword,
            $this->memberSei,
            $this->memberMei,
            $this->memberKanasei,
            $this->memberKanamei,
            $this->memberZip,
            $this->memberPref,
            $this->memberAddress1,
            $this->memberAddress2,
            $this->memberMail,
            $this->memberTel . "-" . $this->memberTel2 . "-" . $this->memberTel3,
            $this->memberImage,
            $this->memberComment
        );
        if ($this->executePrepareWhite($sql, $params)) {
            return $this->sendRegistMail();
        }
        return false;
    }




    /**
     * セッションのメンバーデータをクラス変数にセットする。
     * @see member_regist.php
     * @param string str1
     * @return int int1
     */
    public function setMemberDataSession() {

        $this->loginId = $_SESSION["domain"]["login_id"];
        $this->loginPw = $_SESSION["domain"]["login_pw"];
        $this->chkPw = $_SESSION["domain"]["chk_pw"];
        $this->memberSei = $_SESSION["domain"]["sei"];
        $this->memberMei = $_SESSION["domain"]["mei"];
        $this->memberKanasei = $_SESSION["domain"]["hurisei"];
        $this->memberKanamei = $_SESSION["domain"]["hurimei"];
        $this->memberTel = $_SESSION["domain"]["tel1"];
        $this->memberTel2 = $_SESSION["domain"]["tel2"];
        $this->memberTel3 = $_SESSION["domain"]["tel3"];
        $this->memberZip = $_SESSION["domain"]["zip"];
        $this->memberPref = $_SESSION["domain"]["pref"];
        $this->memberAddress1 = $_SESSION["domain"]["addr"];
        $this->memberAddress2 = $_SESSION["domain"]["address2"];
        $this->memberMail = $_SESSION["domain"]["mail"];
        $this->chkMail = $_SESSION["domain"]["chk_mail"];
    }


    /**
     * パスワード保存時のソルト取得。
     * @see this class only
     * @param ログインIDをセットしていること。
     * @return string salt
     */
    private function getSalt() {
       return $this->loginId . pack("H*", $this->fixedSalt);
    }


    /**
     * パスワードのハッシュ値を返す。
     * @see this class only
     * @param ログインIDをセットしていること。
     * @return hash password
     */
    private function getHashPassword() {
        $salt = $this->getSalt();
        $hash = '';
        for ($i = 0; $i < $this->stretchcount; $i++) {
            $hash = hash('sha256', $hash . $this->loginPw . $salt); // ストレッチング
        }
        return $hash;
    }


    /**
     * メールを送信する。
     */
    public function mailSend($to, $subject, $text, $from) {

        $mail = new Qdmail();
        $mail -> to($to);
        $mail -> subject($subject);
        $mail -> text($text);
        $mail -> from($from);

        if(!$mail->send()) {
            // エラー処理
            $message = "TO={$to},\nFROM={$from},\nSUB={$subject},\nBODY={$text},\nerr_page=" . $_SERVER["SCRIPT_NAME"] . "\n\n";
            $message .= print_r($mail -> errorStatment(false), true);
            // TODO 本番では変更する。
            @mail('mailaddress', 'ErrorQdmail', $message, 'From: mailaddress');
            return false;
        } else {
            return true;
        }
    }



    /**
     * 登録完了メールを送信する。
     * @see this class only
     * @return bool 結果。
     */
    private function sendRegistMail() {

        // URLを作成。
        $url = init::$conf->WebHome . "member_auth.php?user=" . $this->userCode;
        $to = $this->memberMail;
        $from = init::$conf->MailFrom;
        $titl = "EIKOH 会員登録";
        $body ="";

        // メール送信。
        return $this->mailSend($to, $titl, $body, $from);
    }




    /**
     * ユーザーコードから会員データを取得。
     * @see class
     * @param string str1
     * @return int int1
     */
    public function getMemberDataForUserCode() {
        $sql = "SELECT login_id, member_sei, member_mei FROM m_member WHERE user_code = ? ORDER BY created desc";
        $params = array($this->userCode);
        return $this->executePrepare($sql, $params);
    }



    /**
     * 認証フラグを更新する。
     * @see class
     * @param string str1
     * @return int int1
     */
    public function updateAuth() {
        $today = date("YmdHis");
        $sql = "UPDATE m_member SET member_auth = '1', modified = {$today} WHERE user_code = ?";
        $params = array($this->userCode);
        $this->executePrepareWhite($sql, $params);
    }



    /**
     * ログインする。
     * @see class
     * @param string str1
     * @return int int1
     */
    public function login() {

        $password = $this->getHashPassword();
        $sql = "SELECT * FROM m_member WHERE login_id = ? AND login_pw = ? AND member_auth = '1'";
        $params = array($this->loginId, $password);
        $memberData = $this->executePrepare($sql, $params);

        if (count($memberData) != 0) {

            // 使用できる状態かチェック。
            if ($memberData[0]["member_use"] == '1' && $memberData[0]["member_delete"] == '0') {

                // 会員情報をセッションに詰めておく。
                $_SESSION["domain"]["sid"] = $memberData[0]["member_id"];
                $_SESSION["domain"]["id"]  = $memberData[0]["login_id"];
                $_SESSION["domain"]["sei"] = $memberData[0]["member_sei"];
                $_SESSION["domain"]["mei"] = $memberData[0]["member_mei"];
                $_SESSION["domain"]["kanasei"] = $memberData[0]["member_kanasei"];
                $_SESSION["domain"]["kanamei"] = $memberData[0]["member_kanamei"];
                $_SESSION["domain"]["zip"]  = $memberData[0]["member_zip"];
                $_SESSION["domain"]["pref"] = $memberData[0]["member_pref"];
                $_SESSION["domain"]["address1"] = $memberData[0]["member_address1"];
                $_SESSION["domain"]["address2"] = $memberData[0]["member_address2"];
                $_SESSION["domain"]["mail"]  = $memberData[0]["member_mail"];
                $_SESSION["domain"]["tel"]   = $memberData[0]["member_tel"];
                $_SESSION["domain"]["image"] = $memberData[0]["member_image"];
                $_SESSION["domain"]["comment"] = $memberData[0]["member_comment"];
                return true;

            } else {
                init::$errObj->setErrors("現在そのアカウントは使用できません。");
            }

        } else {
            init::$errObj->setErrors("IDまたはパスワードが間違っています。");
        }
        return false;
    }


    /**
     * 使用の有無を変更する。
     * @see class
     * @param string str1
     * @return int int1
     */
    public function changUse($memberId) {
        $sql = "SELECT member_use FROM m_member WHERE member_id = ?";
        $params  = array($memberId);
        $chkData = $this->executePrepare($sql, $params);

        if (count($chkData) != 0) {
            $sql = "UPDATE m_member SET member_use = ? WHERE member_id = ? ";
            $params = array();
            if ($chkData[0]["member_use"] == '1') {
                $params[] = 0;
                $params[] = $memberId;

            } else {
                $params[] = 1;
                $params[] = $memberId;
            }
            return $this->executePrepareWhite($sql, $params);
        }
    }



    /**
     * 削除フラグを立てる。
     * @see class
     * @param string str1
     * @return int int1
     */
    public function delete($memberId) {
        $sql = "UPDATE m_member SET member_delete = '1' WHERE member_id = ?";
        $params = array($memberId);
        return $this->executePrepareWhite($sql, $params);
    }


}
