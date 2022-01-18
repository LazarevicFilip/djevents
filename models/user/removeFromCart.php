<?php
session_start();
header("Content-type: application/json");
if (isset($_POST["id"]) && isset($_SESSION["cart"])) {
    // get id
    $id = $_POST["id"];
    // arr sort to get arr index from 0
    sort($_SESSION["cart"]);
    foreach ($_SESSION["cart"] as $key => $val) {

        if ($val["id"] == $id) {
            array_splice($_SESSION["cart"], $key, 1);
        }
    }
    http_response_code(200);
    echo json_encode(["arr" => $_SESSION["cart"]]);
} else {
    header("Location: ../../index.php?page=event");
}
