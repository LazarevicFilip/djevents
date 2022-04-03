<?php
include "models/functions.php";
$meni = getAll("meni");
if (isset($_SESSION["user"])) {
    $user = $_SESSION["user"];
}
?>

<body>
    <div class="menu-btn">
        <i class="fas fa-bars fa-2x"></i>
    </div>
    <header>
        <div class="container">
            <div class="row mt-1">
                <div class="header-content py-1 d-flex w-100  align-items-center justify-content-between">
                    <div class="logo">
                        <a href="index.php">
                            <h3 class="text-uppercase"><span>DJ</span> Events</h3>
                        </a>
                    </div>
                    <nav class="ml-5 menu">
                        <ul class="d-flex ">
                            <?php
                            foreach ($meni as $link) :

                            ?>
                                <?php
                                if (isset($user) && $user->naziv == "Admin" && ($link->prikaz_nav == 1 || $link->prikaz_nav == 2 || $link->prikaz_nav == 3)) :
                                ?>
                                    <li class='mr-3'><a href='index.php<?= $link->putanja ?>'><?= $link->naziv ?></a></li>
                                <?php
                                endif;
                                ?>
                                <?php
                                if (isset($user) && $user->naziv == "Korisnik" && ($link->prikaz_nav == 1 || $link->prikaz_nav == 2)) :
                                ?>
                                    <li class='mr-3'><a href='index.php<?= $link->putanja ?>'><?= $link->naziv ?></a></li>
                                <?php
                                endif;
                                ?>
                                <?php
                                if (!isset($user) && $link->prikaz_nav == 1) :
                                ?>
                                    <li class='mr-3'><a href='index.php<?= $link->putanja ?>'><?= $link->naziv ?></a></li>
                                <?php
                                endif;
                                ?>
                            <?php
                            endforeach;
                            ?>
                        </ul>
                    </nav>
                    <div class="user-action d-flex align-items-center">
                        <?php
                        if (!isset($user)) :
                        ?>
                            <a href="index.php?page=login" class="btn btn-black mr-3">
                                <i class="fas fa-sign-in-alt"></i>
                                <span>Prijavi se</span>
                            </a>
                        <?php
                        else :
                        ?>
                            <a href="models/logout.php" class="btn btn-black mr-3">
                                <i class="fas fa-sign-in-alt"></i>
                                <span>Odjavi se</span>
                            </a>
                        <?php
                        endif
                        ?>
                        <?php
                        if(isset($_GET["page"]) && $_GET["page"] != "order"):
                        ?>
                        <span id="cart" class="mr-3 text-uppercase cart">
                            <?php
                            if (isset($_SESSION["cart"])) :
                                ?>
                                Korpa(<?= count($_SESSION["cart"]) ?>)
                            <?php
                            else :
                                ?>
                                Korpa(0)
                            <?php
                            endif;
                            ?>
                        </span>
                        <?php
                        endif;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </header>