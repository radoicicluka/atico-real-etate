<!-- Nikola Lazić 2020/0318 -->
<!-- Stefan Dumić 2020/0012 -->
<!-- Luka Radoičić 2020/0085 -->
<!-- Bora Miletić 2020/0319 -->
<script src="<?php echo base_url('bootstrap/js/copy.js');?>"></script>
        <div class="row">    

            <div class="dobrodoslica col-sm-12 text-center border-bottom">
                <h3 class="h3">Dobrodošli na Atico Real Estate sajt!</h3>
            </div>

            <div class="row main col-sm-12">
                <!-- filteri -->
                <div class="col-sm-3">
                    <form method="post" name="filterForma" action="<?php echo site_url(($_SESSION['tip'] ?? 'gost').'/filter');?>">
                        <div class="text-center border-bottom">
                            <h4 class="h4">Primeni filtere</h4>
                        </div>

                        <!-- Opstina -->
                        <div class="mb-3 mt-3">
                            <label for="opstina" class="form-label"><b>Opština</b></label>
                            <select class="form-select" id="opstina" name="opstina">
                                <option value="0" selected>Izaberite</option>
                                <option value="Čukarica">Čukarica</option>
                                <option value="Novi Beograd">Novi Beograd</option>
                                <option value="Palilula">Palilula</option>
                                <option value="Rakovica">Rakovica</option>
                                <option value="Savski Venac">Savski Venac</option>
                                <option value="Stari grad">Stari grad</option>
                                <option value="Voždovac">Voždovac</option>
                                <option value="Vračar">Vračar</option>
                                <option value="Zemun">Zemun</option>
                                <option value="Zvezdara">Zvezdara</option>
                                <option value="Barajevo">Barajevo</option>
                                <option value="Grocka">Grocka</option>
                                <option value="Lazarevac">Lazarevac</option>
                                <option value="Mladenovac">Mladenovac</option>
                                <option value="Obrenovac">Obrenovac</option>
                                <option value="Sopot">Sopot</option>
                                <option value="Surčin">Surčin</option>
                            </select>
                        </div>
                            
                        <!-- Broj soba -->
                        <div class="mb-3">
                            <label for="brojSoba" class="form-label"><b>Broj soba</b></label>
                            <select class="form-select" id="brojSoba" name="brojSoba">
                                <option value="0" selected>Izaberite</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5+</option>
                            </select>
                        </div>

                        <!-- Kvadratura -->
                        <div class="mb-3">
                            <label for="kvadratura" class="form-label"><b>Kvadratura (m²)</b></label>
                            <select class="form-select" id="kvadratura" name="kvadratura">
                                <option value="0" selected>Izaberite</option>
                                <option value="1">0-20</option>
                                <option value="2">20-40</option>
                                <option value="3">40-60</option>
                                <option value="4">60-80</option>
                                <option value="5">80-100</option>
                                <option value="6">100-120</option>
                                <option value="7">120-140</option>
                                <option value="8">140+</option>
                            </select>
                        </div>

                        <!-- Cena -->
                        <div class="mb-3">
                            <label for="cena" class="form-label"><b>Cena u €</b></label>
                            <div class="row">
                                <div class="col">
                                  <input type="number" name='min' class="form-control" placeholder="Min" aria-label="Min">
                                </div>
                                <div class="col">
                                  <input type="number" name='max' class="form-control" placeholder="Max" aria-label="Max">
                                </div>
                            </div>
                        </div>

                        <label class="form-label"><b>Dodatne specifikacije</b></label>

                        <!-- Dodatne specifikacije -->
                        <div class="dodatneSpec mb-3">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="Sank" name="sank">
                                        <label class="form-check-label" for="Sank">Šank</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="Prozor u kuhinji" name="kuhP">
                                        <label class="form-check-label" for="Prozor u kuhinji">Prozor u kuhinji</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="Prozor u kupatilu" name="kupP">
                                        <label class="form-check-label" for="Prozor u kupatilu">Prozor u kupatilu</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="Garaza" name="Garaza">
                                        <label class="form-check-label" for="Garaza">Garaža</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="Lift" name="Lift">
                                        <label class="form-check-label" for="Lift">Lift</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="Podrum" name="Podrum">
                                        <label class="form-check-label" for="Podrum">Podrum</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="Obezbedjenje" name="Obezbedjenje">
                                        <label class="form-check-label" for="Obezbedjenje">Obezbedjenje</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="Video nadzor" name="Video">
                                        <label class="form-check-label" for="Video nadzor">Video nadzor</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="Interfon" name="Interfon">
                                        <label class="form-check-label" for="Interfon">Interfon</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="Bazen" name="Bazen">
                                        <label class="form-check-label" for="Bazen">Bazen</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="Dvoriste" name="Dvoriste">
                                        <label class="form-check-label" for="Dvoriste">Dvorište</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="Terasa" name="Terasa">
                                        <label class="form-check-label" for="Terasa">Terasa</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="Klima uredjaj" name="Klima">
                                        <label class="form-check-label" for="Klima uredjaj">Klima uredjaj</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="Podno grejanje" name="Podno">
                                        <label class="form-check-label" for="Podno grejanje">Podno grejanje</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="Opremljen" name="Opremljen">
                                        <label class="form-check-label" for="Opremljen">Opremljen</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="Optika" name="Optika">
                                        <label class="form-check-label" for="Optika">Optika</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="primeniFiltereDugme text-center mb-3">
                            <button type="submit" class="btn btn-outline-secondary me-2">Primeni filtere</button>
                        </div>
                    </form>
                </div>

                <div class="oglasi col-sm-6">                   
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
                <!-- uporedjivanje oglasa -->
                <div class="col-sm-3">
                <form method="post" action="<?php echo site_url(($_SESSION['tip'] ?? 'gost').'/uporedjivanjeOglasa');?>">
                        <div class="text-center border-bottom">
                            <h4 class="h4">Uporedjivanje oglasa</h4>
                            <p class="p">Kopirajte ID sa oglasa koji želite da uporedite</p>
                        </div>
                        <!-- ID -->
                        <div class="mb-3">
                            <div class="row mt-3">
                                <div class="col text-center">
                                    <input name="id1" value="<?php set_value('id1')?>" type="text" name="id1" class="form-control" placeholder="Prvi oglas" aria-label="Prvi oglas">
                                </div>
                                <div class="col">
                                    <input name="id2" value="<?php set_value('id2')?>" type="text" name="id2" class="form-control" placeholder="Drugi oglas" aria-label="Drugi oglas">
                                </div>
                            </div>
                        </div>
                        <div class="primeniFiltereDugme text-center mb-3">
                            <?php if(isset($_SESSION['tip'])) : ?>
                            <a href="<?php echo site_url($_SESSION['tip']."/uporedjivanjeOglasa") ?>"><button type="submit" class="btn btn-outline-secondary me-2">Uporedi</button></a>
                            <?php endif; ?>
                            <?php if(!isset($_SESSION['tip'])) : ?>
                            <a href="<?php echo site_url("Gost/uporedjivanjeOglasa") ?>"><button type="submit" class="btn btn-outline-secondary me-2">Uporedi</button></a>
                            <?php endif; ?>


                            <?php if(isset($validation)) : ?>
                            <div class="text-danger">
                            <?= $validation->listErrors() ?>
                            </div>
                            <?php endif; ?>

                            <?php if(isset($msg)) : ?>
                            <div class="text-danger">
                            <p>
                                <?= $msg ?>
                            </p>
                            </div>
                            <?php endif; ?>



                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<script>
    function copyToClipboard(text) {
        var tempInput = document.createElement('input'); // Dinamicki kreira input element u koji smesta vrednost ID-a oglasa
        tempInput.value = text;                          
        document.body.appendChild(tempInput);            
        tempInput.select();
        document.execCommand('copy');                   // Zatim kopira (cuva na clipboard) ono sto se nalazi u tom input elementu
        document.body.removeChild(tempInput);           // I na kraju brise input element
    }
</script>