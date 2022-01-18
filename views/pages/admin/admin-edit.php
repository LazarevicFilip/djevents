<?php
if (isset($_GET["id"])) {

    $singleEvent = getSingleEvent($_GET["id"]);
    $preformers = getPreformers($_GET["id"]);
    $dir = "assets/img-small/";
    $preformersStr = '';
    for ($i = 0; $i < count($preformers); $i++) {
        if ($i == 0) {
            $preformersStr .= $preformers[$i]->naziv;
        } else {
            $preformersStr .= "," . $preformers[$i]->naziv;
        }
    }
    //var_dump($preformersStr);
    $cities = getAll("grad");
    $dir = "assets/uploaded_img/";
} else {
    header("Location: index.php?page=admin-select");
}
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name">Naziv Eventa</label>
                        <input type="text" class="form-control" id="name" value="<?= $singleEvent->ime ?>">
                        <small class="form-text text-danger hide">Event mora poceti velikim slovom i sadrzati bar 2 karaktera.</small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="artist">Izvodjaci</label>
                        <input type="text" placeholder="Izvodjac1, Izvodjac2, Izvodjac3..." value="<?= $preformersStr ?>" class="form-control" id="artist">
                        <small class="form-text text-danger hide">Nazivi izvodjaca moraju biti razdvojeni zarezom.</small>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="city">Grad</label>
                        <select id="city" class="form-control">
                            <option value="0">Izaberite</option>
                            <?php
                            foreach ($cities as $city) :
                            ?>
                                <?php
                                if ($city->naziv == $singleEvent->naziv) :
                                ?>
                                    <option selected value=" <?= $city->id_grad ?>"><?= $city->naziv ?></option>
                                <?php
                                else :
                                ?>
                                    <option value=" <?= $city->id_grad ?>"><?= $city->naziv ?></option>
                                <?php
                                endif;
                                ?>
                            <?php
                            endforeach;
                            ?>
                        </select>
                        <small class="form-text text-danger hide">Morate izabrati grad.</small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="adress">Mesto</label>
                        <input type="text" class="form-control" value="<?= $singleEvent->adresa ?>" id="adress">
                        <small class="form-text text-danger hide">Nepostojeca adresa.</small>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="date">Datum</label>
                        <input type="date" class="form-control" value="<?= $singleEvent->datum ?>" id="date">
                        <small class="form-text text-danger hide">Morate izabrati datum.</small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="time">Vreme</label>
                        <input type="time" class="form-control" value="<?= $singleEvent->vreme ?>" id="time">
                        <small class="form-text text-danger hide">Morate izabrati vreme.</small>
                    </div>
                </div>
                <div class="form-group ">
                    <label for="taDesc">Opis</label>
                    <textarea name="" id="taDesc" class="form-control" cols="20" rows="6"><?= $singleEvent->opis ?></textarea>
                    <small class="form-text text-danger hide">Opis eventa je obavezan.</small>
                </div>
                <div class="form-group col-md-6 mb-4">
                    <label for="imgPost">Slika Eventa</label>
                    <input type="file" id="file" class="form-control-file">
                    <small class="form-text text-danger hide">Morate izabrati sliku eventa.</small>
                </div>
                <input type="button" id="btnInsert" class=" btn btn-purple w-100" value="Potvrdi" />
            </form>
            <div id="message"></div>
        </div>
    </div>
</div>