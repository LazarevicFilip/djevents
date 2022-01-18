<?php
if (isset($_SESSION["user"]) && $_SESSION["user"]->naziv == "Admin") {
    require_once "config/connection.php";
    include "models/functions.php";
    $meni = getAll("meni");
} else {
    header("Location: err404.php");
}

?>
<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="index.php"><i class="fas fa-arrow-left"></i> DJ EVENTS Admin Panel</a>
</nav>

<div class="container">
    <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse">
            <div class="mt-3 pt-3">
                <ul class="nav flex-column">
                    <?php
                    foreach ($meni as $m) :
                    ?>
                        <?php
                        if ($m->prikaz_nav == 3 || $m->prikaz_nav == 4) :
                        ?>
                            <li class="nav-item">
                                <a class="nav-link white-color" href="index.php<?= $m->putanja ?>">
                                    <?= $m->naziv ?>
                                </a>
                            </li>
                        <?php
                        endif;

                        ?>
                    <?php
                    endforeach;
                    ?>

                </ul>
            </div>
        </nav>
    </div>
</div>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
        <p class="lead">Admin : <?= $_SESSION["user"]->ime . " " . $_SESSION["user"]->prezime ?></p>
    </div>
</main>