<?php
$events = getUpComingEvents();
$pages = countPages("countEvents");
?>
<div class="container">
    <div class="row d-flex justify-content-between align-items-center my-5">
        <div class="col-md-4 text-uppercase mt-3">
            <h3 class="text-white">Predstojeci Dogadjaji</h3>
        </div>
        <div class="col-md-4 mt-3">
            <div class="d-flex  align-items-center">
                <span class="hide-on-sm">Pretrazi po datumu:</span>
                <input type="date" id="filterDate" class="form-control mr-2" />
            </div>
        </div>
        <div class="col-md-4 mt-3">
            <div class="d-flex justify-content-center align-items-center relative">
                <input type="text" id="search" class="form-control mr-2" placeholder="Pretrazi po nazivu,gradu..." />
                <i class="fas fa-search absolute"></i>
                <!-- <input type="button" id="btnSearch" value="Pretrazi" class=" btn btn-purple" /> -->
            </div>
        </div>
        <div class="col-md-2 ml-auto d-none" id="clearFilters">
            <div class="d-flex justify-content-center  align-items-center mt-5">
                <a href="#" class="text-uppercase text-white font-weight-bold text-decoration-underline">Clear filters</a>
                <i class="fas fa-times-circle ml-1 text-white"></i>
            </div>

        </div>
    </div>
</div>
<div class="container">
    <div class="row d-flex justify-content-between align-items" id="events">
        <?php
        foreach ($events as $event) :
            $dir = "assets/img-small/";
        ?>
            <div class="col-md-12 item d-flex justify-content-between align-items-center w-100">
                <div class="item-img w-30">
                    <img src="<?= $dir . $event->putanja ?>" width="200px" alt="">
                </div>
                <div class="item-info text-center">
                    <p><?= $event->datum . " " . $event->vreme ?></p>
                    <h4 class="text-white font-weight-bold"><?= $event->ime ?></h4>
                </div>
                <a href="index.php?page=eventDetails&id=<?= $event->id_event ?>" class="btn btn-purple">Detaljnije</a>
            </div>
        <?php
        endforeach;
        ?>
    </div>
</div>
<section>
    <div class="container mt-2">
        <div class="row">
            <nav aria-label="Page navigation example" class="mx-auto">
                <ul class="pagination" id="paginationLinks">
                    <?php
                    for ($i = 0; $i < $pages; $i++) :
                    ?>
                        <li class="page-item"><a class="page-link page-link-pagination" data-limit="<?= $i ?>" href="#"><?= $i + 1 ?></a></li>
                    <?php
                    endfor;
                    ?>
                </ul>
            </nav>
        </div>
    </div>
</section>