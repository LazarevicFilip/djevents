<?php
header("Content-type: application/json");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once "../../config/connection.php";
    include "../functions.php";


    $oldPass = md5($_POST["currPass"]);
    $newPass = md5($_POST["newPass"]);
    $reNewPass = md5($_POST["renewPass"]);
    $email = $_POST["email"];

    $rePassword = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/";

    if ($newPass !== $reNewPass) {
        echo json_encode(["msg" => "Lozinke se nepodudaraju."]);
        http_response_code(401);
        die();
    }
    if (!preg_match($rePassword, $_POST["newPass"])) {
        echo json_encode(["msg" => "Nova lozinka nije u dobro formatu."]);
        http_response_code(401);
        die();
    }

    try {
        $user =  getUser($email, $oldPass);
        if ($user) {
            $result = updatePass($email, $newPass);
            if ($result) {
                echo json_encode(["msg" => "Uspeno ste promenili lozinku."]);
                http_response_code(200);
                die();
            }
        } else {
            echo json_encode(["msg" => "Netacna lozinka."]);
            http_response_code(401);
            die();
        }
    } catch (PDOException $exception) {
        http_response_code(500);
        logAction(LOG_ERR_FAJL, $exception->getMessage());
        $msg = ["msg" => "Problemi sa serverom."];
        echo json_encode($msg);
    }
} else {
    http_response_code(404);
}
