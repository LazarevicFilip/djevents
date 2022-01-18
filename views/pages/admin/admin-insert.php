<?php

$citys = getAll("grad");

?>
<div class="container  ml-custom">
    <div class="row">
        <div class="col-md-12">
            <form>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="name">Naziv Eventa</label>
                        <input type="text" class="form-control" id="name">
                        <small class="form-text text-danger hide">Event mora poceti velikim slovom i sadrzati bar 2 karaktera.</small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="artist">Izvodjaci</label>
                        <input type="text" placeholder="Izvodjac1, Izvodjac2, Izvodjac3..." class="form-control" id="artist">
                        <small class="form-text text-danger hide">Nazivi izvodjaca moraju biti razdvojeni zarezom.</small>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="city">Grad</label>
                        <select id="city" class="form-control">
                            <option value="0">Izaberite</option>
                            <?php
                            foreach ($citys as $city) :
                            ?>
                                <option value="<?= $city->id_grad ?>"><?= $city->naziv ?></option>
                            <?php
                            endforeach;
                            ?>
                        </select>
                        <small class="form-text text-danger hide">Morate izabrati grad.</small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="adress">Mesto</label>
                        <input type="text" class="form-control" id="adress">
                        <small class="form-text text-danger hide">Nepostojeca adresa.</small>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="date">Datum</label>
                        <input type="date" class="form-control" id="date">
                        <small class="form-text text-danger hide">Morate izabrati datum.</small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="time">Vreme</label>
                        <input type="time" class="form-control" id="time">
                        <small class="form-text text-danger hide">Morate izabrati vreme.</small>
                    </div>
                </div>
                <div class="form-group ">
                    <label for="taDesc">Opis</label>
                    <textarea name="" id="taDesc" class="form-control" cols="20" rows="6"></textarea>
                    <small class="form-text text-danger hide">Opis eventa je obavezan.</small>
                </div>
                <div class="form-row mb-4 align-items-center">
                    <div class="form-group col-md-6 ">
                        <label for="imgPost">Slika Eventa</label>
                        <input type="file" id="file" class="form-control-file">
                        <small class="form-text text-danger hide">Morate izabrati sliku eventa.</small>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="eventPrice">Cena karte</label>
                        <input type="text" id="eventPrice" class="form-control" placeholder="Primer - 990.00">
                        <small class="form-text text-danger hide">Cena je u neodgovarajucem formatu.</small>
                    </div>
                    <div class="form-group col-md-3 mt-3">
                        <small class="form-text">*Ako je ulaz besplatan unesite 0.</small>
                    </div>
                </div>
                <input type="button" id="btnInsert" class=" btn btn-purple w-100" value="Potvrdi" />
            </form>
            <div id="msg">
                <?php
                if (isset($_GET["err"])) {
                    echo "`<p class='alert alert-danger mt-5'>Datum koji ste izabrali je u proslosti.</p>";
                }
                ?>
            </div>
        </div>
    </div>
</div>