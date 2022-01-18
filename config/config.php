<?php

// Osnovna podesavanja
define("BASE_URL", "http://127.0.0.1/phpSajt2");
define("ABSOLUTE_PATH", $_SERVER["DOCUMENT_ROOT"] . "/phpSajt2");

// Ostala podesavanja
define("ENV_FAJL", ABSOLUTE_PATH . "/config/.env");
define("LOG_FAJL", ABSOLUTE_PATH . "/data/log.txt");
define("LOG_ERR_FAJL", ABSOLUTE_PATH . "/data/log_err.txt");
define("OFFSET", 4);

// Podesavanja za bazu
define("SERVER", env("SERVER"));
define("DATABASE", env("DBNAME"));
define("USERNAME", env("USERNAME"));
define("PASSWORD", env("PASSWORD"));

function env($naziv)
{
    // $podaci = explode("\n",file_get_contents(BASE_URL."/config/.env"));
    $open = fopen(ENV_FAJL, "r");
    $podaci = file(ENV_FAJL);
    $vrednost = "";
    foreach ($podaci as $key => $value) {
        $konfig = explode("=", $value);
        if ($konfig[0] == $naziv) {
            $vrednost = trim($konfig[1]); // trim() zbog \n
        }
    }
    return $vrednost;
}
