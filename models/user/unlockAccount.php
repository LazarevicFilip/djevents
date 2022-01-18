<?php
if (isset($_GET["id"]) && isset($_GET["recovery_key"])) {

    require_once "../../config/connection.php";
    require_once "../functions.php";
    // get data
    $id = addslashes($_GET["id"]);
    $key = addslashes($_GET["recovery_key"]);
    // get user
    $user = getRecoverKey($id);

    try {
        if ($user->recovery_key == $key) {
            global $conn;
            $query = "UPDATE korisnici SET recovery_key = ? WHERE id_korisnik = ?";
            $update = $conn->prepare($query);
            $result = $update->execute([null, $id]);

            if ($result) {
                unset($_SESSION["lock_acc"][$user->email]);
                header("Location: ../../index.php?page=login&messageSucc=Uspesno ste otkljucali nalog.");
            } else {
                header("Location: ../../index.php?page=login&messageErr=Nalog i dalje zakljucan,kontaktirajte administratotra.");
            }
        } else {
            header("Location: ../../index.php?page=login&messageErr=Recovery kljuc nije dobar.");
        }
    } catch (PDOException $exception) {
        http_response_code(500);
        logAction(LOG_ERR_FAJL, $exception->getMessage());
        header("Location: ../../index.php?page=login&messageErr=Problemi sa serverom.");
    }
} else {
    header("Location: ../../index.php?page=login");
    die();
}
