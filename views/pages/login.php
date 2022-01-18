<div class="container">
    <div class="row d-flex justify-content-center mt-5">
        <div class="col-md-7">
            <div class="login">
                <h1 class="text-white mb-2"><i class="fas fa-user  mr-3"></i>Prijavi se</h1>
                <form>
                    <div class="form-group my-4">
                        <label for="emailLog">Email adresa</label>
                        <input type="email" class="form-control" id="emailLog" aria-describedby="emailHelp">
                        <small class="form-text text-danger hide">Primer - marko@markovic.com</small>
                    </div>
                    <div class="form-group my-4">
                        <label for="passwordLog">Lozinka</label>
                        <input type="password" class="form-control" id="passwordLog">
                        <small class="form-text text-danger hide">Lozinka mora sadrzati barem 8 karaktera,po jedno veliko i malo slovo i jedan broj.</small>
                    </div>
                    <p class="mb-3">Nemas nalog? <a class="text-primary" href="index.php?page=register">Registruj se!</a></p>
                    <input type="button" id="btnLog" class="w-100 btn btn-purple" value="Login" />
                </form>
                <div id="msg"></div>
                <?php
                // messages that show after user try to unlock acc if is locked 
                if (isset($_GET["messageErr"])) {
                    echo "<p class='alert alert-danger mt-5'>{$_GET['messageErr']}</p>";
                }
                if (isset($_GET["messageSucc"])) {
                    echo "<p class='alert alert-success mt-5'>{$_GET['messageSucc']}</p>";
                }
                ?>
            </div>
        </div>
    </div>
</div>