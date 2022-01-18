<?php
header("Content-type: application/json");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once "../config/connection.php";
    include "functions.php";

    require_once "../PHPMailer/includes/PHPMailer.php";
    require_once "../PHPMailer/includes/SMTP.php";
    require_once "../PHPMailer/includes/Exception.php";

    $email = addslashes($_POST["emailUI"]);
    $password = $_POST["passwordUI"];

    $reEmail = "/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/";
    $rePassword = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/";

    $err = 0;
    $msg = [];

    if (isset($_POST["emailUI"])) {
        if (!preg_match($reEmail, $email)) {
            $err++;
        }
    }
    if (isset($_POST["passwordUI"])) {
        if (!preg_match($rePassword, $password)) {
            $err++;
        }
    }

    if (!$err) {
        $encryptedPass = md5($password);
        try {
            $user = logUser($email);
            // check if query return 1 obj(email unique)
            if (count($user) == 1) {
                // if accc is locked
                if ($user[0]->recovery_key != null) {
                    unset($_SESSION["lock_acc"][$user[0]->email]);
                    $msg = ["msg" => "Vas nalog je zakljucan proverite vas email za dalje informacije."];
                    http_response_code(401);
                    echo json_encode($msg);
                    die();
                }
                if ($encryptedPass == $user[0]->lozinka) {
                    // response succ
                    $_SESSION["user"] = $user[0];
                    $msg = ["msg" => "Uspesno logovanje"];
                    http_response_code(200);
                    echo json_encode($msg);
                } else {
                    //check if user try more then 3 times to login in 5 mins
                    $lockedAcc = countAttemps($user);
                    if ($lockedAcc) {
                        // 3rd time error password
                        $msg = ["msg" => "Vas account je zakljucan,usled vise od 3 pokusaja logovonja za 5 minuta.Proverite vas email"];
                        http_response_code(423);
                        echo json_encode($msg);
                    } else {
                        // 1st,2nd try
                        $msg = ["msg" => "Netacna lozinka"];
                        http_response_code(401);
                        echo json_encode($msg);
                    }
                }
            } else {
                //email is not in system
                $msg = ["msg" => "Ne postoji korisnik sa ovom email adresom"];
                http_response_code(401);
                echo json_encode($msg);
            }
        } catch (PDOException $exception) {
            http_response_code(500);
            logAction(LOG_ERR_FAJL, $exception->getMessage());
            $msg = ["msg" => "Problemi sa serverom"];
            echo json_encode($msg);
        }
    } else {
        http_response_code(404);
        $msg = ["msg" => "Email/lozinka su u neodgovarajucem formatu"];
        die();
    }
} else {
    http_response_code(404);
}
