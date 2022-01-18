<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    header("Content-type: application/json");
    include_once("../../config/connection.php");
    include_once("../functions.php");
    if ($_SESSION["user"]->naziv == "Admin" && isset($_POST["idUI"])) {
        $id = $_POST["idUI"];
        try {

            $delete = delete($id, "korisnici", "id_korisnik");

            if ($delete) {
                $users = getUsers();
                $msg = ["msg" => "Uspesno brisanje.", "users" => $users];
                http_response_code(200);
                echo json_encode($msg);
            }
        } catch (PDOException $ex) {
            $conn->rollback();
            $msg = ['msg' => $ex->getMessage()];
            http_response_code(500);
            echo json_encode($msg);
        }
    }
} else {
    header('Location: ../err404.php');
}
