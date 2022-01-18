<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["serachParamUI"])) {
    header("Content-type: application/json");
    require_once "../../config/connection.php";
    include "../functions.php";

    $parametar = trim($_POST["serachParamUI"]);

    $compereParametar = "%$parametar%";

    try {
        $filteredEvents = [];
        // ako se prosledi prazan str,2 karaktera su 2 procenta(%)
        if (strlen($compereParametar) == 2) {
            // inicijalan prikaz
            $filteredEvents = ["events" => getUpComingEvents(), "pages" => countEvents()->numEvents];
        } else {
            if (isset($_POST["limitEvent"])) {
                $limit = $_POST["limitEvent"];
                $filteredEvents = ["events" => filterEvents($compereParametar, $limit), "pages" => filterEventsCount($compereParametar)->num];
            } else {
                $filteredEvents = ["events" => filterEvents($compereParametar), "pages" => filterEventsCount($compereParametar)->num, "1" => 1];
            }
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
