<?php
$users = getUsers();
$pages = countPages("countUsers");
?>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <table class="table table-dark">
                <thead>
                    <tr>
                        <th scope="col">RB</th>
                        <th scope="col">Korisnik</th>
                        <th scope="col">Email</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody id="usersTable">
                    <?php
                    $rb = 1;
                    foreach ($users as $user) :
                    ?>
                        <tr>
                            <td><?= $rb ?></td>
                            <td><?= $user->ime . " " . $user->prezime ?></td>
                            <td><?= $user->email ?></td>
                            <td><a href="#" class="btn btn-danger deleteUser white-color" data-id="<?= $user->id_korisnik ?>">Obrisi</a></td>
                        </tr>
                    <?php
                        $rb++;
                    endforeach;
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<section>
    <div class="container mt-2">
        <div class="row">
            <div id="res" class="my-5 col-md-12">

            </div>
            <nav aria-label="Page navigation example" class="mx-auto">
                <ul class="pagination">
                    <?php
                    for ($i = 0; $i < $pages; $i++) :
                    ?>
                        <li class="page-item"><a class="page-link" data-limit="<?= $i ?>" href="#"><?= $i + 1 ?></a></li>
                    <?php
                    endfor;
                    ?>
                </ul>
            </nav>
        </div>
    </div>
</section>