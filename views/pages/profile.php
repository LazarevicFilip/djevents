<?php
if (!isset($_SESSION["user"])) {
    header("Location: views/pages/errPage.php");
    die();
} else {
    global $user;
    $dateRegister = explode(" ", $user->vreme_registracije);
}
?>
<div class="container my-5">
    <div class="row">
        <div class="col-md-6 profile">
            <h2 class="text-white text-uppercase"> Korisnik: <?= $_SESSION["user"]->ime . " " . $_SESSION["user"]->prezime  ?></h2>
            <p class="size-small">Korisnik od: <?= $dateRegister[0] ?> <span class="text-uppercase ml-4 badge badge-info"><?= $_SESSION["user"]->naziv ?></span></p>
            <div class="ml-1 mb-2 d-flex align-items-center text-white">
                <p class="mr-4 ">EMAIL: </p>
                <i class="fas fa-envelope"></i>
                <p class="ml-2  font-italic"><?= $user->email ?> </p>
            </div>

        </div>
        <div class="col-md-6 mb-5">
            <h2 class="text-uppercase mb-2">Promeni Lozinku</h2>
            <form>
                <input type="hidden" id="hiddenEmail" value="<?= $_SESSION["user"]->email ?>">
                <div class="my-4">
                    <input type="password" class="form-control" id="currentPass" placeholder="Trenutna lozinka">
                    <small class="form-text text-danger hide">Lozinka mora sadrzati barem 8 karaktera,po jedno veliko i malo slovo i jedan broj.</small>
                </div>
                <div class="my-4">
                    <input type="password" class="form-control" id="newPass" placeholder="Nova lozinka">
                </div>
                <div class="my-4">
                    <input type="password" class="form-control" id="reNewPass" placeholder="Potvrdi novu lozinka">
                    <small class="form-text text-danger hide">Lozinke se ne poklapaju</small>
                </div>
                <input type="button" id="btnChange" class="w-100 btn btn-purple mt-1" value="Promeni" />
            </form>
            <div id="msg"></div>
        </div>
    </div>
</div>