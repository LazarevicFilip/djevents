<?php
if (isset($_GET["id"])) {
    $singleEvent = getSingleEvent($_GET["id"]);
    $preformers = getPreformers($_GET["id"]);
    $dir = "assets/uploaded_img/";
    // var_dump($singleEvent);
    // var_dump($_SESSION["cart"]);
} else {
    header("Location: index.php?page=event");
}
?>

<div class="container py-5 ">
    <div class="row ">
        <div class="mx-auto col-md-9">
            <a href="index.php?page=events">
                <i class=" mb-4 fas fa-arrow-left fa-2x"></i>
            </a>
            <p>Naziv Eventa:</p>
            <h1 class="my-2 text-white"><?= $singleEvent->ime ?></h1>
            <img src=" <?= $dir . $singleEvent->putanja ?>" alt="<?= $singleEvent->ime ?>">
            <p class="mt-3">Opis Eventa:</p>
            <p class="my-3 font-weight-bold lead text-white "><?= $singleEvent->opis ?></p>
            <p class="mt-3">Izvodjaci:</p>
            <?php foreach ($preformers as $preformer) :
            ?>
                <p class="my-2 font-weight-bold lead text-white "><?= $preformer->naziv ?></p>
            <?php
            endforeach
            ?>
            <div class="d-flex justify-content-between align-items-center mt-4">
                <div>
                    <p>Adresa Eventa:</p>
                    <p class="my-2 font-weight-bold lead text-white "><?= $singleEvent->adresa . ", " . $singleEvent->naziv ?></p>
                </div>
                <div>
                    <p>Datum Eventa:</p>
                    <p class="my-2 font-weight-bold lead text-white "><?= $singleEvent->datum ?></p>
                </div>
                <div>
                    <p>Cena Karte:</p>
                    <p class="my-2 font-weight-bold lead text-warning "><?= $singleEvent->cena ?> RSD</p>
                </div>
            </div>
            <?php
            if (isset($_SESSION["user"])) :
            ?>
                <a id="addToCart" data-id="<?= $_GET["id"] ?>" href="#" class="btn btn-purple mt-4 w-100">Dodaj u korpu</a>
            <?php
            else :
            ?>
                <p class="h3 text-center  text-warning mt-5 ">Morate biti logovoni da bi kupili kartu.<a class="text-primary" href="index.php?page=login"> Prijavi se!</a></p>
            <?php
            endif;
            ?>

        </div>
    </div>
</div>