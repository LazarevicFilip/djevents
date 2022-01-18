<?php
if (isset($_SESSION["user"]) && $_SESSION["user"]->naziv == "Admin") {
    $open = fopen(LOG_FAJL, "r");
    if ($open) {
        $array = file(LOG_FAJL);
        $allUrl = [];
        foreach ($array as $arr) {
            $x = explode("\t", $arr);
            array_push($allUrl, $x[1]);
        }
        $countUrl = array_count_values($allUrl);
        $totalNumOFLogs = 0;
        foreach ($countUrl as $x) {
            $totalNumOFLogs += $x;
        }
    }
} else {
    header("Location: err404.php");
}
?>
<section>
    <div class="container  my-3">
        <div class="row mb-5">
            <table class="table table-dark">
                <thead>
                    <tr>
                        <th scope="col">RB</th>
                        <th scope="col">Stranica</th>
                        <th scope="col">Posecenost(%)</th>
                    </tr>
                </thead>
                <tbody id="eventsTable">
                    <?php
                    $rb = 1;
                    foreach ($countUrl as $key => $value) :
                    ?>
                        <tr>
                            <td><?= $rb ?></td>
                            <td><?= $key ?></td>
                            <td><?= number_format($value / $totalNumOFLogs * 100, 2) ?></td>
                        </tr>
                    <?php
                        $rb++;
                    endforeach;
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</section>