<!-- Stefan Dumić 2020/0012 -->

<!-- Luka Radoičić 2020/0085 -->
<div class="row">    

      <div class="col-sm-12 text-center border-bottom">
          <h3 class="h3">Otkazivanje termina</h3>
      </div>

      <div class="row main col-sm-12">

        <div class="col-sm-8 mx-auto mb-3">
          <table class="table  table-striped text-center mt-3">
            <thead>
              <tr>
                <?php if(isset($termin->idO)) : ?>
                  <th scope="col">Lokacija</th>
                  <th scope="col">Adresa</th>
                <?php endif; ?>
                <th scope="col">Termin</th>
                <th scope="col">Status</th>
              </tr>
            </thead>
            <tbody>
              <tr>
              <?php if(isset($termin->idO)) : ?>
                <td><?= $termin->grad ?></td>
                <td><?= $termin->adresa ?></td>
                <?php endif; ?>
                <td><?= $termin->datumVreme?></td>
                <?php if(isset($termin->korImeKlijent)): ?>
                  <td><input type="checkbox" checked style="pointer-events: none;"></td>
                  <?php else: ?>
                    <td><input type="checkbox" style="pointer-events: none;"></td>
                    <?php endif; ?>
                    <?php if(isset($termin->idO)) : ?>
                    <td><a href="<?php echo base_url('agent/oglas/'. $termin->idO) ?>">Oglas</a></td>
                    <?php endif; ?>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="col-sm-9 mx-auto">
          <form class="row g-3" method="post">
            <div class="col-md-4 mt-3 mx-auto">
              <button class="btn btn-outline-secondary w-100" type="submit" value="izbrisi" name='action'>Izbriši</button>
            </div>
            <?php if(isset($termin->idO)) : ?>
              <div class="col-md-4 mt-3 mx-auto">
                <button class="btn btn-outline-secondary w-100" type="submit" value="otkazi" name='action'>Otkaži</button>
              </div>
            <?php endif; ?>
            <div class="col-md-4 mt-3 mx-auto">
              <a href="<?php echo base_url('agent/raspored'); ?>"><button type="button" class="btn btn-outline-secondary w-100">Povratak na raspored</button></a>
            </div>
          </form>
        </div>
      </div>
  </div>
</body>
</html>