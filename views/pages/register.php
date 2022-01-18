<div class="container">
    <div class="row d-flex justify-content-center mt-5">
        <div class="col-md-8 login">
            <h1 class="text-white"><i class="fas fa-user  mr-3"></i>Registruj se</h1>
            <form>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="fname">Ime</label>
                        <input type="text" class="form-control" id="fname">
                        <small class="form-text text-danger hide">Primer - Marko</small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="lname">Prezime</label>
                        <input type="text" class="form-control" id="lname">
                        <small class="form-text text-danger hide">Primer - Markovic</small>
                    </div>
                </div>
                <div class="form-group">
                    <label for="emailRegister">Email</label>
                    <input type="text" class="form-control" id="emailRegister">
                    <small class="form-text text-danger hide">Primer - marko@markovic.com</small>
                </div>
                <div class="form-group">
                    <label for="password">Lozinka</label>
                    <input type="password" class="form-control" id="password">
                    <small class="form-text text-danger hide">Lozinka mora sadrzati barem 8 karaktera,po jedno veliko i malo slovo i jedan broj.</small>
                </div>
                <div class="form-group mb-4">
                    <label for="passwordConf">Potvrdi Lozinku</label>
                    <input type="password" class="form-control" id="passwordConf">
                    <small class="form-text text-danger hide">Lozinke se ne poklapaju</small>
                </div>

                <input type="button" id="btnReg" class=" btn btn-purple w-100" value="Potvrdi" />
            </form>
            <div id="msg"></div>
        </div>
    </div>
</div>