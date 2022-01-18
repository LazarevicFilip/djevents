<?php
session_start();
require_once "config.php";

logAction(LOG_FAJL, "pristupio stranici");
try {
    $conn = new PDO("mysql:host=" . SERVER . ";dbname=" . DATABASE . ";charset=utf8", USERNAME, PASSWORD);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $ex) {
    logAction(LOG_ERR_FAJL, $exception->getMessage());
    echo $ex->getMessage();
}

function executeQuery($query)
{
    global $conn;
    return $conn->query($query)->fetchAll();
}

function logAction($file, $message)
{

    $user = "(neautorizovan)";
    if (isset($_SESSION["user"])) {
        $user = $_SESSION["user"]->email;
    }
    $date = date('d-m-Y H:i:s');
    $open = fopen($file, "a");
    if ($open) {
        fwrite($open, "$user\t{$_SERVER['PHP_SELF']}\t{$_SERVER['REMOTE_ADDR']}\t$date\t$message\n"); //$_SERVER['HTTP_REFERER']
        fclose($open);
    }
}
