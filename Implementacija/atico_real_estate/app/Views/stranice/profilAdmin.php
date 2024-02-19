<!-- Stefan Dumić 2020/0012 -->
<?php use App\Models\CustomModel; ?>

        <div class="row col-sm-12">
            <div class="col-sm-12 text-center border-bottom">
                <h3 class="h3">Profil admina <?php echo $_SESSION['autor'] ?></h3>
            </div>

            <div class="col-sm-4 mt-3">
                <table class="table table-striped mt-3">
                    <thead>
                        <tr>
                            <th scope="col">Korisničko ime</th>
                            <td><?php echo $_SESSION['autor'] ?></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $db = db_connect();
                            $model=new CustomModel($db); 
                            $data = $model->proveriKorIme($_SESSION['autor']);
                        ?>
                        <tr>
                            <th>Ime</th>
                            <td> <?= $data->ime ?></td>
                        </tr>
                        <tr>
                            <th>Prezime</th>
                            <td><?= $data->prezime ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?= $data->email ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="col-sm-8 mt-3">
                <div class="vstack gap-2 col-sm-6 mx-auto">
                    <a href="<?php echo site_url('admin') ?>"><button type="button" class="btn btn-outline-secondary w-100">Pregled svih oglasa</button></a>
                    <a href="<?php echo site_url('admin/zahtevi') ?>"><button type="button" class="btn btn-outline-secondary w-100">Zahtevi</button></a>
                    <a href="<?php echo site_url('admin/uklanjanjeKorisnika') ?>"><button type="button" class="btn btn-outline-secondary w-100">Ukloni korisnika</button></a>
                    <a href="<?php echo site_url('admin/promenaLozinke') ?>"><button type="button" class="btn btn-outline-secondary w-100">Promena lozinke</button></a>
                    <a href="<?php echo site_url('admin/promenaInfNaloga') ?>"><button type="button" class="btn btn-outline-secondary w-100">Promena informacija naloga</button></a>
                    <a href="<?php echo site_url('admin/brisanjeOglasa') ?>"><button type="button" class="btn btn-outline-secondary w-100">Brisanje oglasa</button></a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

    </div>
</body>
</html>