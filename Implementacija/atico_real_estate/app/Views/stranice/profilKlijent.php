<!-- Stefan Dumić 2020/0012 -->
<!-- Luka Radoičić 2020/0085 -->
<?php use App\Models\CustomModel; ?>

        <div class="row col-sm-12">
            <div class="col-sm-12 text-center border-bottom">
                <h3 class="h3">Profil klijenta <?php echo $_SESSION['autor'] ?></h3>
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
                    <a href="<?php echo site_url('klijent') ?>"><button type="button" class="btn btn-outline-secondary w-100">Pregled svih oglasa</button></a>
                    <a href="<?php echo site_url('klijent/postaviOglas') ?>"><button type="button" class="btn btn-outline-secondary w-100">Postavi oglas</button></a>
                    <a href="<?php echo site_url('klijent/omiljeniOglasi') ?>"><button type="button" class="btn btn-outline-secondary w-100">Omiljeni oglasi</button></a>
                    <a href="<?php echo site_url('klijent/praceniOglasi') ?>"><button type="button" class="btn btn-outline-secondary w-100">Praćeni oglasi</button></a>
                    <a href="<?php echo site_url('klijent/postavljeniOglasi') ?>"><button type="button" class="btn btn-outline-secondary w-100">Pregled postavljenih oglasa</button></a>
                    <a href="<?php echo site_url('klijent/promenaLozinke') ?>"><button type="button" class="btn btn-outline-secondary w-100">Promena lozinke</button></a>
                    <a href="<?php echo site_url('klijent/promenaInformacijaNaloga') ?>"><button type="button" class="btn btn-outline-secondary w-100">Promena informacija naloga</button></a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

    </div>
</body>
</html>