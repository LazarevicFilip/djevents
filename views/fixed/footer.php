<footer class="section-footer mt-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <h3><span>DJ</span> Events</h3>
                <a href="https://www.twitter.com/" target="_blank"><i class="fab fa-twitter fa-3x"></i></a>
                <a href="https://www.facebook.com/" target="_blank"><i class="fab fa-facebook fa-3x"></i></a>
                <a href="https://www.youtube.com/" target="_blank"><i class="fab fa-youtube fa-3x"></i></a>
            </div>
            <div class="col-lg-3 col-md-6">
                <h3>Navigacija</h3>
                <ul>
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
            </div>
            <div class="col-lg-3 col-md-6">
                <h3>Korisni Linkovi</h3>
                <ul>
                    <li><a href="assets/xml/sitemap.xml" target="_blank">Sitemap</a></li>
                    <li><a href="djevents.pdf" target="_blank">Documentation</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6">
                <h3>Subscribe</h3>
                <p>Primaj obavestenja od nas.</p>
                <form name=email-form method="POST" date-netlify='true'>
                    <div class="email-form">
                        <input type="email" name="email" id="emailFooter" class="control" placeholder="Email" size='40'>
                        <button type="submit" value="Submit" class="form-control submit">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</footer>