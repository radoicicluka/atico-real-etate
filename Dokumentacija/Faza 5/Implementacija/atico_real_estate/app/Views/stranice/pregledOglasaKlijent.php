<!-- Stefan Dumić 2020/0012 -->
<!-- Bora Miletić 2020/0319 -->
<div class="row">
            <div class="row main col-sm-12">
                <h3 class="text-center col-sm-12">
                    <?php echo $littleTitle ?>
                </h3>
                <div class="filteri col-sm-3" hidden>
                    <form>
                        <div class="filterNaslov text-center border-bottom">
                            <h4 class="h4">Primeni filtere</h4>
                        </div>
                        <!-- Opstina -->
                        <div class="mb-3 mt-3">
                            <label for="opstina" class="form-label"><b>Opština</b></label>
                        </div>
                        <div class="primeniFiltereDugme text-center mb-3">
                            <button type="submit" class="btn btn-outline-secondary me-2">Primeni filtere</button>
                        </div>
                    </form>
                </div>
                <div class="oglasi col-sm-9 mx-auto mt-3">
                <!-- ovaj deo se dohvata iz baze podataka sve do * -->
                <?php foreach ($oglasi as $oglas) : ?>
                        <div class="card mb-3 mx-auto" style="max-width: 640px;">
                            <div class="row g-0">
                                <div class="col-md-4">
                                <?php if(isset($_SESSION['tip'])) : ?>
                                    <a href="<?php echo site_url($_SESSION['tip']."/oglas/".$oglas->idO);?>">
                                        <img src="<?php echo base_url('/uploads/oglas'. $oglas->idO."/slika1.jpg");?>" class="img-fluid rounded-start" alt="slika" style="image-resolution: 20dpi;">
                                    </a>
                                <?php endif; ?>
                                <?php if(!isset($_SESSION['tip'])) : ?>
                                    <a href="<?php echo site_url("gost/oglas/". $oglas->idO);?>">
                                        <img src="<?php echo base_url('/uploads/oglas'. $oglas->idO."/slika1.jpg");?>" class="img-fluid rounded-start" alt="slika" style="image-resolution: 20dpi;">
                                    </a>
                                <?php endif; ?>
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-10">
                                                <h5 class="card-title"><?php echo $oglas->naziv ?></h5>
                                            </div>
                                            <div class="col-sm-2">
                                            <button class="btn btn-outline-secondary" id="<?php echo $oglas->idO;?>" onclick="copyToClipboard(<?php echo $oglas->idO;?>)">ID</button>
                                            </div>
                                        </div>
                                        <p class="card-text"><?php echo $oglas->opis ?></p>
                                    </div>
                                </div>
                            </div>    
                        </div>
                <?php endforeach; ?>
                    <!-- * -->
                    
                    
                </div>
            </div>
        </div>
    </div>
</body>
</html>
