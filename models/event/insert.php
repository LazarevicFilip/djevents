<?php
header("Content-type: application/json");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once "../../config/connection.php";
    include "../functions.php";
    if ($_SESSION["user"]->naziv == "Admin") {
        //promernjive
        $name = addslashes($_POST["nameUI"]);
        $adress = addslashes($_POST["adressUI"]);
        $cityID = $_POST["cityUI"];
        $artistAll = trim(addslashes($_POST["artistUI"]));
        $date = addslashes($_POST["dateUI"]);
        $time = addslashes($_POST["timeUI"]);
        $desc = addslashes($_POST["descUI"]);
        $price = addslashes($_POST["priceUI"]);
        //file
        $file = $_FILES["fileUI"];
        $fileName = $file["name"];
        $tmpFIle = $file["tmp_name"];
        $size = $file["size"];
        $type = $file["type"];
        $errFile = $file["error"];
        //regex
        $reEventName = "/^[A-Z][A-z\d]{1,20}(\s[A-Z][A-z\d]{1,20})*$/";
        $reArtist = "/^[A-z\d]{2,15}(\s[A-Za-z\d]{2,20})*(,[A-z\d]{2,15}(\s[A-Za-z\d]{2,20})*)*$/";
        $reAdress = "/^([A-ZŠĐĆČŽ][a-zšđčćž]{2,15}|[0-9])+(\s[A-ZŠĐĆČŽ[a-zšđčćž0-9\.\-]{2,20})+$/";
        $rePrice = "/^([1-9][0-9]{1,3}\.[0-9]{2}|0)$/";
        //provera dal je idGrad u id-vima iz baze
        $allCities = getAll("grad");
        $citiesArr = [];
        foreach ($allCities as $city) {
            array_push($citiesArr, $city->id_grad);
        }
        $err = 0;

        if (time() > strtotime($date)) {
            $err++;
            echo json_encode(["msg" => "Datum koji ste izabrali je u proslosti!"]);
            http_response_code(401);
            die();
        }
        validData($name, $reEventName, $err);
        validData($adress, $reAdress, $err);
        validData($artistAll, $reArtist, $err);
        validData($price, $rePrice, $err);

        if (isset($cityID)) {
            if (!in_array($cityID, $citiesArr)) {
                $err++;
            }
        }

        if (!isset($time)) {
            $err++;
        }
        if (!isset($date)) {
            $err++;
        }
        if (!isset($desc)) {
            $err++;
        }
        $uploadErr = 0;
        $allowedFormat = ["image/jpg", "image/jpeg", "image/png"];
        if (!in_array($type, $allowedFormat)) {
            $uploadErr++;
            echo json_encode(["msg" => "Format slike mora da bude .jpg, .jpeg, .png "]);
            http_response_code(401);
            die();
        }
        if ($size > 200000) {
            $uploadErr++;
            echo json_encode(["msg" => "Slika ne sme da bude veca od 2mb"]);
            http_response_code(401);
            die();
        }
        if (!$uploadErr && !$err) {

            $newFileName = imgResize($fileName, $tmpFIle);

            $artist = explode(",", $artistAll);

            try {
                $status = 1;
                $conn->beginTransaction();
                $priceObj = selectPrice($price);
                $priceID = '';
                if (count($priceObj) == 0) {
                    insertPrice($price);
                    $priceID = $conn->lastInsertId();
                } else {
                    $priceID = $priceObj[0]->id_cena;
                }
                $insert = insertEvent($name, $adress, $cityID, $date, $time, $desc, $status, $newFileName, $priceID);
                $eventID = $conn->lastInsertId();
                $artistID = '';
                foreach ($artist as $art) {
                    $a = selectArt($art);
                    if (count($a) == 0) {
                        insertArtist($art);
                        $artistID = $conn->lastInsertId();
                    } else {
                        $artistID = $a[0]->id_izvodjac;
                    }
                    insertEventArtist($eventID, $artistID);
                }
                $conn->commit();
                echo json_encode(['msg' => 'Event uspesno kreiran']);
                http_response_code(201);
            } catch (PDOException $ex) {
                $conn->rollback();
                logAction(LOG_ERR_FAJL, $ex->getMessage());
                echo json_encode(['msg' => "Problemi sa serverom,probajte ponovo..."]);
                http_response_code(500);
            }
        }
    }
} else {
    http_response_code(404);
}
