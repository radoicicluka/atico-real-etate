<!-- Stefan Dumić 2020/0012 -->
<?php use App\Models\CustomModel; ?>
          <div class="row">
            <div class="text-center border-bottom">
                <h4 class="h4">Brisanje korisnika</h4>
            </div>
            <div class="pristigliZahteviMain col-sm-12 row">
                <?php 
                  $db = db_connect();
                  $model=new CustomModel($db);
                  $sviKlijenti = $model->spajanjeSvihKlijenta();
                  $sviAgenti = $model->spajanjeSvihAgenta();
                ?>
                <div class="col-sm-6 mx-auto">
                  <form method="post">
                    <table class="table  table-striped text-center mt-3">
                        <thead>
                          <tr>
                            <th>Korisničko ime</th>
                            <th>Tip naloga</th>
                            <th>Email</th>
                            <th>Aktivan</th>
                            <th>Obriši</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach($sviKlijenti as $k) : ?>
                            <tr>
                              <td><a href="<?php echo base_url('admin/prikaziKorisnika/'.$k->korIme); ?>"> <?= $k->korIme ?> </a></td>
                              <td>Klijent</td>
                              <td><?= $k->email ?></td>
                              <td><?= $k->aktivan ?></td>
                              <td><input class="form-check-input" value='1' type="checkbox" name="<?= $k->korIme ?>"></td>
                            </tr>
                          <?php endforeach; ?>
                          <?php foreach($sviAgenti as $k) : ?>
                            <tr>
                              <td><a href="<?php echo base_url('admin/prikaziKorisnika/'.$k->korIme); ?>"> <?= $k->korIme ?> </a></td>
                              <td>Agent</td>
                              <td><?= $k->email ?></td>
                              <td><?= $k->aktivan ?></td>
                              <td><input class="form-check-input" value='1' type="checkbox" name="<?= $k->korIme ?>"></td>
                            </tr>
                          <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div style="text-align: center;">
                        <button type="submit" class="btn btn-outline-secondary">Sačuvaj</button>
                    </div>
                  </form> 
                </div>

            </div>
        </div>
    </div>
</body>
</html>