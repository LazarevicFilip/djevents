<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    header("Content-type: application/json");
    require_once("../../config/connection.php");
    include("../functions.php");

    try {
        $limit = '';
        if (isset($_POST["limitEvent"])) {
            $limit = $_POST["limitEvent"];
            $events = ["events" => getUpComingEvents($limit), "pages" => countEvents()->numEvents];
            echo json_encode($events);
        } else {
            $limit = $_POST["limitUsers"];
            $users = ["users" => getUsers($limit)];
            echo json_encode($users);
        }
        http_response_code(200);
    } catch (PDOException $ex) {
        http_response_code(500);
    }
}
