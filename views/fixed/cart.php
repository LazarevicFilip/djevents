<div class="cart-content hidden" id="korpa">
    <div id="closeCart" class="close-cart font-weight-bold text-uppercase mb-4">Zatvori</div>

    <?php
    if (isset($_SESSION["user"])) :
    ?>
        <div id="cartItems">
            <?php
            if (isset($_SESSION["cart"])) :
            ?>
                <?php
                foreach ($_SESSION["cart"] as $item) :
                ?>
                    <div class="container">
                        <div class="row py-3 align-items-center border-bottom">
                            <div class="col-md-12 text-right">
                                <a href="#" data-id=<?= $item["id"] ?> class="deleteItemCart text-white size-small">X</a>
                            </div>
                            <div class="col-md-12 col-lg-5">
                                <img src="assets/uploaded_img/<?= $item["img"] ?>" alt="<?= $item["name"] ?>">
                            </div>
                            <div class="col-md-12 col-lg-5 cart-item-content text-center ml-2">
                                <h5 class="h4"><?= $item["name"] ?></h5>
                                <div class="text-white mt-3">
                                    <span class="mr-1"><?= $item["quantity"] ?> X </span>
                                    <span><?= $item["price"] ?> RSD</span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                endforeach;
                ?>
                <div class="mt-4 mb-5">
                    <!-- <div class="d-flex justify-content-between mb-3 text-white size-small py-2">
                <p>Dostava</p>
                <p>+199 RSD</p>
            </div> -->
                    <a href="" class="btn btn-purple w-100">Zavrsi kupovinu</a>
                </div>
        </div>

    <?php
            else :
    ?>
        <p class="h3 text-center">Vasa korpa je prazna</p>
    <?php
            endif;
    ?>

<?php
    else :
?>
    <p class="h3 text-center mt-5 ">Morate biti logovoni da biste kupili kartu.<a class="text-primary" href="index.php?page=login"> Prijavi se!</a></p>
<?php
    endif;
?>
</div>
</div>