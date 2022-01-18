<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["dateUI"])) {
    header("Content-type: application/json");
    require_once "../../config/connection.php";
    include "../functions.php";

    $parametar = trim($_POST["dateUI"]);

    try {
        if (isset($_POST["limitEvent"])) {
            $filteredEvents = ["events" => getEventsByDate($parametar, $_POST["limitEvent"]), "pages" => getEventsByDateCount($parametar)->num];
        } else {
            $filteredEvents = ["events" => getEventsByDate($parametar), "pages" => getEventsByDateCount($parametar)->num];
        }


        http_response_code(200);
        echo json_encode($filteredEvents);
    } catch (PDOException $ex) {
        logAction(LOG_ERR_FAJL, $exception->getMessage());
        echo json_encode(['message' => $ex->getMessage()]);
        http_response_code(500);
    }
} else {
    http_response_code(400);
}
