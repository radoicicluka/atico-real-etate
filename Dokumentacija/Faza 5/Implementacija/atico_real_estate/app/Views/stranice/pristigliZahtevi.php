<!-- Nikola Lazić 2020/0318 -->
<!-- Stefan Dumić 2020/0012 -->
<?php use App\Models\CustomModel; ?>
        <div class="row">
            <div class="text-center border-bottom">
                <h4 class="h4">Pristigli zahtevi</h4>
            </div>
            <div class="pristigliZahteviMain col-sm-12 row">
                
              <div class="col-sm-6 mx-auto">
                <?php 
                  $db = db_connect();
                  $model=new CustomModel($db);
                  $data = $model->pristigliZahteviAdmin();
                  $data1 = $model->pristigliZahteviAdminPostavljanje();
                ?>
                <?php if(!empty($data) || !empty($data1)): ?>
                  <form method="post">
                    <table class="table  table-striped text-center mt-3">
                      <thead>
                        <tr>
                          <th>Zahtevi</th>
                          <th>Prihvati</th>
                          <th>Odbij</th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php if(!empty($data)): ?>
                        <?php for($x=0; $x < sizeof($data); $x++) : ?>
                          <?php if($model->dohvatiZahtevGdeJeIdZah1($data[$x]['idZah'])->tipZahteva == 1) : ?>
                          <tr>
                            <td> Korisnik <a href="<?php echo base_url('admin/prikaziKorisnika/'.$data[$x]['korIme']); ?>"> <?= $data[$x]['korIme'] ?> </a>  se registrovao na sajt </td>
                            <td><input type="radio" name="zahtev <?= $x ?>" value='1'></td>
                            <td><input type="radio" name="zahtev <?= $x ?>" value='2'></td>
                          </tr>
                          <?php endif; ?>
                          <?php if($model->dohvatiZahtevGdeJeIdZah1($data[$x]['idZah'])->tipZahteva == 2) : ?>
                          <tr>
                            <td> Korisnik <a href="<?php echo base_url('admin/prikaziKorisnika/'.$data[$x]['korIme']); ?>"> <?= $data[$x]['korIme'] ?> </a>  želi da promeni ime u <?php echo $data[$x]['ime']; ?>, prezime u <?php echo $data[$x]['prezime']; ?> i email u <?php echo $data[$x]['email']; ?> </td>
                            <td><input type="radio" name="zahtev <?= $x ?>" value='1'></td>
                            <td><input type="radio" name="zahtev <?= $x ?>" value='2'></td>
                          </tr>
                          <?php endif; ?>
                          <?php if($model->dohvatiZahtevGdeJeIdZah1($data[$x]['idZah'])->tipZahteva == 4) : ?>
                          <tr>
                            <td> Korisnik <a href="<?php echo base_url('admin/prikaziKorisnika/'.$data[$x]['korIme']); ?>"> <?= $data[$x]['korIme'] ?> </a>  želi da promeni agenta <a href="<?php echo base_url('admin/prikaziKorisnika/'.$data[$x]['ime']); ?>"><?= $data[$x]['ime'] ?> </a> za oglas ciji je ID <a href="<?php echo base_url('admin/oglas/'.$data[$x]['prezime']); ?>"> <?= $data[$x]['prezime'] ?> </a> </td>
                            <td><input type="radio" name="zahtev <?= $x ?>" value='1'></td>
                            <td><input type="radio" name="zahtev <?= $x ?>" value='2'></td>
                          </tr>
                          <?php endif; ?>
                          
                        <?php endfor ; ?>
                        <?php endif ;?>
                        <?php for($x=0; $x < sizeof($data1); $x++) : ?>
                          <tr>
                            <td> Korisnik <a href="<?php echo base_url('admin/prikaziKorisnika/'.$data1[$x]['korImeKlijent']); ?>"> <?= $data1[$x]['korImeKlijent'] ?> </a>  želi da postavi oglas čiji je ID <a href="<?php echo base_url('admin/oglas/'.$data1[$x]['idO']); ?>"> <?= $data1[$x]['idO'] ?> </a> </td>
                            <td><input type="radio" name="zahtev1 <?= $x ?>" value='1'></td>
                            <td><input type="radio" name="zahtev1 <?= $x ?>" value='2'></td>
                          </tr>
                        <?php endfor ; ?>
                      </tbody>
                    </table>
                    <div style="text-align: center;">
                      <button type="submit" class="btn btn-outline-secondary">Sačuvaj</button>
                    </div>
                  </form>
                <?php endif; ?>
                <?php if(empty($data)):?>
                  <table class="table  table-striped text-center mt-3">
                      <thead>
                        <tr>
                          <th colspan="3">Nema zahteva</th>
                        </tr>
                      </thead>
                <?php endif; ?>
              </div>
            </div>
        </div>
    </div>
</body>
</html>