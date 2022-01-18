<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    header("Content-type: application/json");
    require_once("../config/connection.php");
    include("functions.php");
    try {

        $fName = addslashes($_POST["fnameUI"]);
        $lName = addslashes($_POST["lnameUI"]);
        $email = addslashes($_POST["emailUI"]);
        $password = $_POST["passwordUI"];
        $passwordConf = $_POST["passwordConfUI"];

        $err = 0;

        $reFristName = "/^([A-Z][a-z]{2,15})+$/";
        $reLastName = "/^([A-Z][a-z]{2,20})+$/";
        $reEmail = "/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/";
        $rePassword = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/";

        if (isset($fName)) {
            if (!preg_match($reFristName, $fName)) {
                $err++;
            }
        }
        if (isset($lName)) {
            if (!preg_match($reLastName, $lName)) {
                $err++;
            }
        }
        if (isset($email)) {
            if (!preg_match($reEmail, $email)) {
                $err++;
            }
        }
        if (isset($password)) {
            if (!preg_match($rePassword, $password)) {
                $err++;
            }
        }
        if (isset($passwordConf)) {
            if (!preg_match($rePassword, $passwordConf)) {
                $err++;
            }
        }
        if ($password !== $passwordConf) {
            $err++;
        }
        $msg = [];
        if (!$err) {
            try {
                $encryptedPass = md5($password);
                $status = 1;
                $roleId = 2;
                $insert = insertUser($fName, $lName, $email, $encryptedPass, $status, $roleId);
                if ($insert) {
                    $msg = ["msg" => "Uspesna registracija"];
                    http_response_code(201);
                    echo json_encode($msg);
                }
            } catch (PDOException $exception) {
                http_response_code(401);
                logAction(LOG_ERR_FAJL, $exception->getMessage());
                $msg = ["msg" => "Email koji ste uneli je vec uzet."];
                echo json_encode($msg);
            }
        }
    } catch (PDOException $exception) {
        http_response_code(404);
        $msg = ["msg" => "Email/lozinka su u neodgovarajucem formatu"];
        die();
    }
}
