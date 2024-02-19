<!-- Stefan Dumić 2020/0012 -->
<!-- Luka Radoičić 2020/0085 -->
<!-- Bora Miletić 2020/0319 -->

    <div class="row">    

      <div class="col-sm-12 text-center border-bottom">
          <h3 class="h3">Pokretanje licitacije</h3>
      </div>

      <div class="row main col-sm-12">

        <div class="col-sm-9 mx-auto">
          <form class="row g-3" method="post" action="<?= site_url('klijent/posaljiZahtevZaLicitaciju/'.$idO) ?>">
            <div class="col-md-4 mt-3 mx-auto">
              <label for="inputDatum" class="form-label"><b>Datum završetka licitacije</b></label>
              <input type="date" class="form-control" id="inputDatum" name="datum">
            </div>
            <div class="col-md-4 mt-3 mx-auto">
              <label for="inputVreme" class="form-label"><b>Vreme završetka licitacije</b></label>
              <input type="time" class="form-control" id="inputVreme" name="vreme">
            </div>
            <div class="col-md-4 mt-3 mx-auto">
                <label for="inputVreme" class="form-label"><b>Početna cena u €</b></label>
                <input type="number" class="form-control" id="inputVreme" name="cena">
            </div>
            <div class="col-md-3 mx-auto mt-3">
                <button type="submit" class="btn btn-outline-secondary" style="width: 100%;">Potvrdi</button>
          </form>
          <?php if(isset($datum)): ?>
            <p><?= $datum ?></p>
          <?php endif; ?>
          <?php if(isset($vreme)): ?>
            <p><?= $vreme ?></p>
          <?php endif; ?>
        </div>
      </div>
  </div>
</body>
</html>