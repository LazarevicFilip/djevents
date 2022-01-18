<?php

$events = getUpComingEvents();
$pages = countPages("countEvents");

?>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <table class="table table-dark">
                <thead>
                    <tr>
                        <th scope="col">RB</th>
                        <th scope="col">Event</th>
                        <th scope="col">Datum</th>
                        <th scope="col">Grad</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody id="eventsTable">
                    <?php
                    $rb = 1;
                    foreach ($events as $event) :
                    ?>
                        <tr>
                            <td><?= $rb ?></td>
                            <td><?= $event->ime ?></td>
                            <td><?= $event->datum ?></td>
                            <td><?= $event->naziv ?></td>
                            <td><a href="index.php?page=admin-edit&id=<?= $event->id_event ?>" class="btn btn-primary editEvent white-color">Izmeni</a></td>
                            <td><a href="#" class="btn btn-danger deleteEvent white-color" data-id="<?= $event->id_event ?>">Obrisi</a></td>
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
            <div id="res" class="my-5">

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