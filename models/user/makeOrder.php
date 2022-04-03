<?php
if(isset($_POST["btnOrder"]) && $_SERVER["REQUEST_METHOD"] == "POST"){
    header("Content-type: text/html");
    include_once "../functions.php";
    include_once "../../config/connection.php";

    require_once "../../PHPMailer/includes/PHPMailer.php";
    require_once "../../PHPMailer/includes/SMTP.php";
    require_once "../../PHPMailer/includes/Exception.php";

    $reFirstName = "/^([A-Z][a-z]{2,15})+$/";
    $reLastName = "/^([A-Z][a-z]{2,20})+$/";
    $reEmail = "/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/";
    $rePhone = "/^\+381\d{7,9}$/";
    $rePostal = "/^\d{5}$/";
    $reStreet = "/^(\w{1,20}\s?)+$/";

    $fname = isset($_POST["fname"]) ? $_POST["fname"] : "";
    $lname = isset($_POST["lname"]) ? $_POST["lname"] : "";
    $street = isset($_POST["street"]) ? $_POST["street"] : "";
    $postalCode = isset($_POST["postalCode"]) ? $_POST["postalCode"] : "";
    $email = isset($_POST["email"]) ? $_POST["email"] : "";
    $phone = isset($_POST["phone"]) ? $_POST["phone"] : "";
    $price = $_POST["price"];

    function checkInput($reg,$input,$msg){
        if(!preg_match($reg,$input)){
            header("Location: ../../index.php?page=order&msg=$msg");
            die();
        }
    }
    checkInput($reFirstName,$fname,"Polje ime nije u dobrom formatu.");
    checkInput($reLastName,$lname,"Polje prezime nije u dobrom formatu.");
    checkInput($reEmail,$email,"Email nije u dobrom formatu.");
    checkInput($rePhone,$phone,"Telefon nije u dobrom formatu.");
    checkInput($rePostal,$postalCode,"Postanski broj  nije u dobrom formatu.");
    checkInput($reStreet,$street,"Ulica i broj nisu u dobrom formatu.");

    try {
        $response = "";
        global $conn;
        $conn->beginTransaction();
        $userID = ($_SESSION["user"]->id_korisnik);
        insertOrder($fname,$lname,$street,$postalCode,$email,$phone,$userID,$price);
        $orderID = $conn->lastInsertId();
        foreach ($_SESSION["cart"] as $item){
            insertOrderDetails($orderID,$item["name"],$item["quantity"],$item["price"]);
        }
        $conn->commit();
        success_order($_SESSION["user"]);
        $response = "Uspesno ste napravili porudzbinu";
        header("Location: ../../index.php?page=order&success=$response");

    }catch (Exception $ex){
        $conn->rollBack();
        logAction(LOG_ERR_FAJL, $ex->getMessage());
        http_response_code(500);
        header("Location: ../../index.php?page=order&msg=Doslo je do greske priliko obrade vaseg zahteva");
    }

}
?>
