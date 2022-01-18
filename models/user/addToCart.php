<?php
header("Content-type: application/json");

if (isset($_POST["id"])) {
    include_once("../../config/connection.php");
    include_once("../functions.php");
    if (isset($_SESSION["user"])) {

        $event = getSingleEvent($_POST["id"]);
        // var_dump($event);

        // first item to session 
        if (!isset($_SESSION["cart"])) {
            $_SESSION["cart"] = [$_POST["id"] => ["id" => $event->id_event, "name" => $event->ime, "img" => $event->putanja, "price" => $event->cena, "quantity" => 1]];
        } else {
            // get a array of all items ids
            $arrOfIndexes = [];
            foreach ($_SESSION["cart"] as $key => $val) {
                $arrOfIndexes[] = $key;
            }
            if (in_array($_POST["id"], $arrOfIndexes)) {
                // if item is in array increment quantity
                $_SESSION["cart"][$_POST["id"]]["quantity"]++;
            } else {
                // new item in arr
                // $_SESSION["cart"][$_POST["id"]] = [$_POST["id"], 1];
                $_SESSION["cart"][$_POST["id"]] = ["id" => $event->id_event, "name" => $event->ime, "img" => $event->putanja, "price" =>  $event->cena, "quantity" => 1];
            }
        }
        http_response_code(200);
        echo json_encode(["msg" => "Dodato.", "arr" => $_SESSION["cart"]]);
    }
} else {
    header("Location: ../../index.php?page=login");
}


// var_dump($_SESSION["cart"]);
