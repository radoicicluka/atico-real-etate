<!-- Stefan Dumić 2020/0012 -->
<!-- Luka Radoičić 2020/0085 -->
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
                  $data = $model->pristigliZahteviAgent();
                ?>
                <?php if(!empty($data)): ?>
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
                        <?php for($x=0; $x < sizeof($data); $x++) : ?>
                            <?php if($model->dohvatiZahtevGdeJeIdZah1($data[$x]['idZah'])->tipZahteva == 5) : ?>
                                <tr>
                                    <td> Klijent <?= $model->dohvatiImeVlasnikaOglasa($data[$x]['idO']); ?> želi da pokrene licitaciju za oglas čiji je 
                                    <a href="<?= site_url('agent/oglas/'.$data[$x]['idO'])?>">ID=<?= $data[$x]['idO']; ?> (<?= $model->dohvatiNaslovOglasa($data[$x]['idO']); ?>)</a></td>
                                    <td><input type="radio" name="zahtev <?= $x ?>" value='1'></td>
                                    <td><input type="radio" name="zahtev <?= $x ?>" value='2'></td>
                                </tr>
                            <?php endif; ?>
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