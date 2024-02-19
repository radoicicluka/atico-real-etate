<!-- Stefan Dumić 2020/0012 -->


    <div class="row">
        <form method="post">
        <?php foreach ($oglasi as $oglas):?>
            <div class="card mb-3 mx-auto" style="max-width: 80%;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <a href="<?php echo base_url("admin/oglas/$oglas->idO"); ?>">
                            <img src="<?php echo base_url('/uploads/oglas'. $oglas->idO."/slika1.jpg");?>" class="img-fluid rounded-start" alt="slika">
                        </a>
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-9">
                                    <h5 class="card-title">"<?= $oglas->naziv ?>"</h5>
                                    <p class="card-text"><?= $oglas->opis ?></p>
                                    <div class="row">
                                        <p class="card-text col-sm-4">Aktivan: <?= $oglas->aktivan ?></p>
                                        <p class="card-text col-sm-4">Agencija: <?= $oglas->agencija ?></p>
                                        <p class="card-text col-sm-4">Agent: <?= $oglas->korImeAgent ?></p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" value="1" name="oglas <?= $oglas->idO ?>" class="btn btn-outline-secondary mb-2" style="width: 100%;">Obrisi</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            </form>
            <?php if(empty($oglasi)): ?>
                <div class="row" >
                    <div class="text-center border-bottom">
                        <h4 class="h4">Nema oglasa</h4>
                        </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>