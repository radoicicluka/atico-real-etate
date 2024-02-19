<!-- Nikola Lazić 2020/0318 -->
<!-- Stefan Dumić 2020/0012 -->
        <div class="row">
            <div class="row main col-sm-12">
                <div class="">
                    <h3 class="text-center mb-3">Moji oglasi</h3>
                </div>
                <div class="oglasi col-sm-9 mx-auto mt-3">
                    <!-- ovaj deo se dohvata iz baze podataka sve do * -->
                    <?php foreach($oglasi as $oglas) :?>
                        <div class="card mb-3 mx-auto" style="max-width: 80%;">
                            <div class="row g-0">
                                <div class="col-md-4">
                                <a href="<?php echo site_url($_SESSION['tip']."/oglas/".$oglas->idO);?>">
                                    <img src="<?php echo base_url('/uploads/oglas'. $oglas->idO."/slika1.jpg");?>" class="img-fluid rounded-start" alt="slika">
                                </a>
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-9">
                                                <h5 class="card-title"><?= $oglas->naziv ?></h5>
                                                <p class="card-text"><?= $oglas->opis ?></p>
                                            </div>
                                            <div class="col-md-3">
                                                <a href="<?php echo site_url('klijent/promenaInformacijaOglasa/'. $oglas->idO) ?>"><button class="btn btn-outline-secondary w-100">Izmeni</button></a>
                                                <a href="<?php echo site_url('klijent/pokreniLicitaciju/'. $oglas->idO) ?>"><button class="btn btn-outline-secondary w-100 mt-2">Pokreni licitaciju</button></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach;?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
