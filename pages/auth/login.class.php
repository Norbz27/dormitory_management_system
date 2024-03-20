<?php

class Login extends Dbh {

    protected function getUser($uid, $pwd) {
        $stmt = $this->connect()->prepare('SELECT pwd FROM users WHERE uid = ? OR contact = ?');


        if(!$stmt->execute(array($uid, $pwd))) {
            $stmt = null;
            header("Location: login.php?error=stmtfailed");
            exit();
        }

        if($stmt->rowCount() == 0)
        {
            $stmt = null;
            header("Location: login.php?error=usernotfound");
            exit();
        }

        $pwdHashed = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $checkPwd = password_verify($pwd, $pwdHashed[0]["pwd"]);

        if($checkPwd == false)
        {
            $stmt = null;
            header("Location: login.php?error=wrongpassword");
            exit();
        }
        else if($checkPwd == true)
        {
            $stmt = $this->connect()->prepare('SELECT * FROM users WHERE uid = ? OR contact = ? AND pwd = ?');

            if(!$stmt->execute(array($uid, $uid, $pwd))) {
                $stmt = null;
                header("Location: login.php?error=stmtfailed");
                exit();
            }

            if($stmt->rowCount() == 0)
            {
                $stmt = null;
                header("Location: login.php?error=usernotfound");
                exit();
            }

            $user = $stmt->fetchAll(PDO::FETCH_ASSOC);

            session_start();
            $_SESSION["account"] = true;
            $_SESSION["userid"] = $user[0]["id"];
            $_SESSION["username"] = $user[0]["uid"];
            $_SESSION["usersname"] = $user[0]["name"];
            $_SESSION["displayImg"] = $user[0]["display_img"];

            $stmt = null;
        }

        $stmt = null;
    }
}