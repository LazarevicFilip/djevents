<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    header("Content-type: application/json");
    include_once("../../config/connection.php");
    if ($_SESSION["user"]->naziv == "Admin" && isset($_POST["idUI"])) {
        include_once("../functions.php");
        $id = $_POST["idUI"];
        try {

            $conn->beginTransaction();
            delete($id, "event_izvodjac", "id_event");
            delete($id, "events", "id_event");
            $conn->commit();

            $events = getUpComingEvents();
            $msg = ["msg" => "You have successfully deleted a post.", "events" => $events];
            http_response_code(200);
            echo json_encode($msg);
        } catch (PDOException $ex) {
            $conn->rollback();
            $msg = ['msg' => $ex->getMessage()];
            http_response_code(500);
            echo json_encode($msg);
        }
    }
} else {
    header('Location: ../../views/pages/errPage.php');
}
