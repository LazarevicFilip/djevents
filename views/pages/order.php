<?php
if(empty($_SESSION["cart"])){
    header("Location: index.php?page=event");
}
if(empty($_SESSION["user"])){
    header("Location: index.php?page=login");
}
$rb = 1;
?>
<div class="container mt-5">
    <div class="row mt-5">
        <div class="col-md-12">
            <h3 class="my-3">Pregled porudzbine</h3>
            <table class="table table-striped table-dark">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Dogadjaj</th>
                    <th scope="col">Cena karte</th>
                    <th scope="col">Kolicna</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($_SESSION["cart"] as $item):
                    ?>
                        <tr>
                            <th scope="row"><?=$rb++?></th>
                            <td><?=$item["name"]?></td>
                            <td class="cartPrice"><?=$item["price"]?></td>
                            <td class="cartQuantity"><?=$item["quantity"]?></td>
                        </tr>
                    <?php

                    endforeach;
                    ?>
                <tr>
                    <td class="text-right font-weight-bold" colspan="4">Dostava: + <span class="delivery">300</span> RSD</td>
                </tr>
                <tr>

                    <td class="text-right font-weight-bold" colspan="4">Ukupno: <span id="sumPrice"></span> RSD</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <h3 class="py-3 my-2">Unesite informacije za dostovu</h3>
            <form method="POST" action="models/user/makeOrder.php">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <input type="hidden" name="price" id="priceOrder">
                        <label for="fname">Ime</label>
                        <input type="text" class="form-control" name="fname" value="<?=$_SESSION["user"]->ime?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="lname">Prezime</label>
                        <input type="text" class="form-control" name="lname" value="<?=$_SESSION["user"]->prezime?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="fname">Email</label>
                        <input type="text" class="form-control" name="email" value="<?=$_SESSION["user"]->email?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="lname">Telefon</label>
                        <input type="text" class="form-control" name="phone" placeholder="Primer: +38164555333">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="fname">Ulica i broj</label>
                        <input type="text" class="form-control" name="street" placeholder="Primer: Kraljevacka 22">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="lname">Postanski broj</label>
                        <input type="text" class="form-control" name="postalCode" placeholder="Primer: 25000">

                    </div>
                </div>


                <input type="submit" name="btnOrder" class="mt-2 btn btn-purple w-100" value="Potvrdi" />
            </form>

            <?php
            if(isset($_GET["msg"])):
                ?>
                <p class="alert alert-danger mt-4"><?=$_GET["msg"]?></p>
            <?php
            endif;
            ?>
            <?php
            if(isset($_GET["success"])):
                ?>
                <p class="alert alert-success mt-4"><?=$_GET["success"]?></p>
            <?php
            endif;
            ?>
        </div>

    </div>
</div>
<script>

    setTimeout(()=>{
        if(document.querySelector(".alert-success")){
            location.href = "index.php?page=events"
        }
    },2000)
</script>
