<!-- Nikola Lazić 2020/0318 -->
<!-- Stefan Dumić 2020/0012 -->

<div class="row">
            <div class="text-center border-bottom">
                <h4 class="h4">Obaveštenja</h4>
            </div>
            <div class="pristigliZahteviMain col-sm-12 row">
                
                <div class="col-sm-6 mx-auto">
                  <form method="post">
                    <table class="table  table-striped text-center mt-3">
                        <thead>
                          <tr>
                            <th scope="col">Datum i vreme</th>
                            <th scope="col">Obaveštenja</th>
                          </tr>
                        </thead>
                        <tbody>

                          <?php foreach($obavestenja as $obavestenje): ?>
                          <tr>
                            <td><?= $obavestenje->datumVreme ?></td>
                            <td><?= $obavestenje->tekst ?></td>
                          </tr>
                          <?php endforeach; ?>
                        </tbody>
                    </table>

                    <div style="text-align: center;">
                        <button type="submit" class="btn btn-outline-secondary">Obriši</button>
                    </div>
                  </form>
                </div>

            </div>
        </div>
    </div>
</body>
</html>