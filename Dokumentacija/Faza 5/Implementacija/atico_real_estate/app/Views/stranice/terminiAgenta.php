<!-- Stefan Dumić 2020/0012 -->
<!-- Luka Radoičić 2020/0085 -->
        <div class="row">
            <div class="text-center border-bottom">
                <h4 class="h4">Termini</h4>
            </div>
            <div class="pristigliZahteviMain col-sm-12 row">
                
                <div class="col-sm-6 mx-auto">
                    <table class="table table-striped text-center mt-3">
                        <thead>
                          <tr>
                            <th scope="col">Termin</th>
                            <th scope="col">Rezervisan<th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach($termini as $t): ?>
                            <tr>
                              <td><?= $t->datumVreme ?></td>
                              <?php if(isset($t->korImeKlijent)): ?>
                                <td><input type="checkbox" checked style="pointer-events: none;"></td>
                                <?php else: ?>
                                  <td><input type="checkbox" style="pointer-events: none;"></td>
                                  <?php endif; ?>
                                  <td> <a href="<?php echo site_url("agent/detaljnije/". $t->idTer);?>"><button class="btn btn-outline-secondary">Detaljnije</button></a> </td>
                                  <!-- treba adaptrirati stranicu oglas.html konkretno deo koji se odnosi na zakazivanje termina -->
                            </tr>
                          <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div style="text-align: center;">
                        <a href="<?php echo base_url('agent/noviTermin'); ?>"><button type="button" class="btn btn-outline-secondary">Dodaj novi termin</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>