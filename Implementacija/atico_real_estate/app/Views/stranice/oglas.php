<!-- Nikola Lazić 2020/0318 -->
<!-- Stefan Dumić 2020/0012 -->
<!-- Luka Radoičić 2020/0085 -->
<!-- Bora Miletić 2020/0319 -->
<?php use App\Models\CustomModel; ?>
<?php use App\Models\Zahtev; ?>
<?php use App\Models\ZahtevZaRegistraciju; ?>
<?php use App\Models\Oglas; ?>
<?php use App\Models\Licitacija; ?>
<?php use App\Models\Obavestenje; ?>
            <div class="row mainContent">
                <div class="naslovOglasa col-sm-12 mb-3">
                    <?php if(!$oglas->prodat) : ?>
                    <h4 class="h4"><?= $oglas->naziv ?> - <?= $oglas->cena ?> € </h4>
                    <?php endif; ?>
                    <?php if($oglas->prodat) : ?>
                    <h4 class="h4"><?= $oglas->naziv ?> - PRODAT </h4>
                    <?php endif; ?>
                </div>
                <div class="podaciOOglasu row col-sm-12 mb-3">
                    <div class="opisOglasa row col-sm-9 mb-3 border-bottom">
                        
                        <div class="konkretanOpis col-sm-9 mb-3">
                            <p class="p"><?= $oglas->opis ?></p>
                            <div class="row">
                                <p class="p col-sm-3">Opština: <?= $oglas->opstina ?></p>
                                <p class="p col-sm-3">Kvadratura: <?= $oglas->kvadratura ?> m²</p>
                                <p class="p col-sm-3">Grejanje: <?= $oglas->grejanje ?></p>
                                <p class="p col-sm-3">Broj soba: <?= $oglas->brSoba ?></p>
                            </div>
                        </div>
                        <div class="opisDugmici col-sm-3 mb-3">
                            <?php if(isset($_SESSION['tip']) && $_SESSION['tip'] == "Klijent") : ?>
                                <a href="<?php echo site_url($_SESSION['tip']."/lajkujOglas/".$oglas->idO);?>">
                                    <button type="button" class="btn btn-outline-secondary me-2 mb-2" style="width: 100%; <?php if($lajkovan) echo 'background-color: #bcbdd6;'?>">Lajkuj oglas</button>
                                </a>
                                <a href="<?php echo site_url($_SESSION['tip']."/pratiOglas/".$oglas->idO);?>">
                                    <button type="button" class="btn btn-outline-secondary me-2 mb-2" style="width: 100%; <?php if($pracen) echo 'background-color: #bcbdd6;'?>">Prati oglas</button> 
                                </a>       
                            <?php endif; ?>
                            <?php if(!isset($_SESSION['tip']) || ((isset($_SESSION['tip']) && $_SESSION['tip'] != "Klijent"))) : ?>
                                <button type="button" class="btn btn-outline-secondary me-2 mb-2" style="width: 100%;" disabled>Lajkuj oglas</button>
                                <button type="button" class="btn btn-outline-secondary me-2 mb-2" style="width: 100%;" disabled>Prati oglas</button>        
                            <?php endif; ?>
                        </div>
                        <div class="slikeOglasa col-sm-12 border-bottom" style="height:600px;">
                            <div id="carouselExample" class="carousel slide mb-3">
                                <div class="carousel-inner">
                                    
                                
                                <?php for($i=1; $i <= 3 ; $i++): ?>
                                    <?php if($i == 1) :?>
                                        <div class="carousel-item active" style="height:600px;">
                                    <?php else: ?>
                                        <div class="carousel-item" style="height:600px;">
                                    <?php endif; ?>
                                    <img src="<?php echo base_url('/uploads/oglas'. $oglas->idO."/slika". $i .".jpg");?>" class="img-fluid" alt="slika". $i .".jpg">
                                  </div>
                                <?php endfor; ?>
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                  <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                  <span class="visually-hidden">Next</span>
                                </button>
                              </div>
                        </div>
                        <div class="specifikacijeOglasa col-sm-12 mb-3 mt-3">
                            <div class="row">
                                <div class="col-sm-4 text-center">
                                <h5 class="h5 mb-3" >
								<b><?php echo $oglas->kvadratura."m²" ?></b>
							</h5>
							<p class="p">Broj soba: <?php echo $oglas->brSoba ?></p>
							<p class="p">Kuhinjski prozor: <?php echo $kuhP1 ?></p>
							<p class="p">Prozor u kupatilu: <?php echo $kupP1?> </p>
							<p class="p">Garaža: <?php echo $garaza1 ?></p>
							<p class="p">Lift: <?php echo $lift1 ?></p>
							<p class="p">Podrum/Ostava: <?php echo $podrum1 ?></p>
                                </div>
                                <div class="col-sm-4 text-center">
                                <h5 class="h5 mb-3" >
								<b><?php echo $oglas->opstina ?></b>
							</h5>
							<p class="p">Grejanje: <?php echo $oglas->grejanje ?></p>
							<p class="p">Obezbedjenje: <?php echo $obezbedjenje1 ?></p>
							<p class="p">Video nadzor: <?php echo $video1 ?> </p>
							<p class="p">Interfon: <?php echo $interfon1 ?></p>
							<p class="p">Bazen: <?php echo $bazen1 ?></p>
							<p class="p">Dvorište: <?php echo $dvoriste1 ?></p>
                                </div>
                                <div class="col-sm-4 text-center">
                                <h5 class="h5 mb-3" >
								<b><?php echo $oglas->cena."€" ?></b>
							</h5>
							<p class="p">Terasa: <?php echo $terasa1 ?></p>
							<p class="p">Klima uredjaj: <?php echo $klima1 ?></p>
							<p class="p">Podno grejanje: <?php echo $podno1 ?> </p>
							<p class="p">Opremljen: <?php echo $opremljen1 ?></p>
							<p class="p">Optika: <?php echo $optika1 ?></p>
							<p class="p">Šank: <?php echo $sank1 ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <?php if(isset($_SESSION['tip']) && $_SESSION['tip']=='Klijent'):?>
                    <div class="zakaziTermin col-sm-3 mb-3">
                        <div class="naslovZakaziTermin text-center mt-3">
                            <h4 class="h4">Zakazi termin</h4>
                            
                            <p class="p">Zakaši termin za rezgledanje ove nekretnine.</p>
                        </div>
                        <!-- Bora Miletic -->
                        <!-- dinamicki prikaz slobodnih termina i mogucnost zakazivanja -->
                        <?php 
                        $db = db_connect();
                        $model = new CustomModel($db);
                        $termini = $model->dohvatiSveSlobodneTermineAgenta($oglas->korImeAgent);                             
                        ?>
                        <form method="post" action="<?php echo site_url('klijent/zakaziTermin/'.$oglas->idO) ?>">
                            <div class="form-floating">
                                <select class="form-select" id="datumIVremeRazgledanja" name="termin">
                                    <?php foreach ($termini as $termin) : ?> 
                                        <option value="<?php echo $termin->idTer?>" selected><?php echo $termin->datumVreme?></option>
                                    <?php endforeach; ?>
                                </select>
                                <label for="datumIVremeRazgledanja">Dostupni termini</label>
                            </div>
                            <div class="terminDugmici mt-3 mb-3">
                                <button type="submit" class="btn btn-outline-secondary me-2 mb-2" style="width: 100%;">Zakaži termin</button>
                            </div>
                        </form>
                        
                        <form method="post">
                            <div class="terminDugmici mt-3 mb-3">
                                <?php if($oglas->korImeKlijent == $_SESSION['autor']) :?>
                                <button type="submit" class="btn btn-outline-secondary me-2 mb-2" name='promenaAgenta' value="4" style="width: 100%;">Promeni agenta</button>
                                <?php endif; ?>
                                
                                <?php if(isset($msg)) :?>
                                <p class='text-center'> <?= $msg ?> </p>
                                <?php endif;?>
                                
                            </div>
                        </form>
                        <!-- Bora Miletic -->
                        <?php //provera da li je oglas na licitaciji
                        $db = db_connect();
                        $model = new CustomModel($db);
                        $data = $model->daLiJeOglasNaLicitaciji($oglas->idO);
                        $currentTime = new DateTime(); //za trenutno vreme
                        $currentTime->modify('+2 hours');//na php-u je neka druga vremenska zona

                        if ($data && $data->vremeKraj) { //priprema za proveru da li se zavrsila licitacija
                            $vremeKraj = DateTime::createFromFormat('Y-m-d H:i:s', $data->vremeKraj);
                            $krajLicitacije = false;
                            if ($vremeKraj <= $currentTime) { //provera da li je kraj licitacije
                                $krajLicitacije = true;
                                if($data->korImeKlijent) { //provera da li je bilo ko dao ponudu
                                    $model=new Oglas($db);
                                    $k = $model->getOglas($oglas->idO);
                                    $attr = array(
                                        'idO' => $k->idO,
                                        'korImeKlijent' => $k->korImeKlijent,
                                        'korImeAgent' => $k->korImeAgent,
                                        'naziv' => $k->naziv,
                                        'opis' => $k->opis,
                                        'cena' => $data->trenutnaCena,
                                        'adresa' => $k->adresa,
                                        'brSoba' => $k->brSoba,
                                        'kvadratura' => $k->kvadratura,
                                        'opstina' => $k->opstina,
                                        'grejanje' => $k->grejanje,
                                        'aktivan' => $k->aktivan,
                                        'prodat' => 1,
                                        'grad' => $k->grad,
                                        'agencija' => $k->agencija
                                    );
                                    $model->update($k->idO, $attr);
                                    $lic = new Licitacija();
                                    $lic->delete($data->idLic);
                                    //obavestenja klijentu ciji je oglas i agentu koji je zaduzen da taj oglas da je nekretnina prodata
                                    $obv = new Obavestenje();
                                    $arr = [ //za klijenta
                                        'idOba' => null,
                                        'korIme' => $k->korImeKlijent,
                                        'tekst' => 'Oglas sa id: '.$k->idO.' je prodat za '.$data->trenutnaCena.'€.',
                                        'datumVreme' => $currentTime->format('Y-m-d H:i:s')
                                    ];
                                    $obv->insert($arr);
                                    $obv = new Obavestenje();
                                    $arr = [ //za agenta
                                        'idOba' => null,
                                        'korIme' => $k->korImeAgent,
                                        'tekst' => 'Oglas sa id: '.$k->idO.' je prodat za '.$data->trenutnaCena.'€.',
                                        'datumVreme' => $currentTime->format('Y-m-d H:i:s')
                                    ];
                                    $obv->insert($arr);
                                    $obv = new Obavestenje();
                                    //obavestenje za klijenta koji je kupio nekretninu
                                    $arr = [ 
                                        'idOba' => null,
                                        'korIme' => $data->korImeKlijent,
                                        'tekst' => 'Čestitamo, uspešno se kupili oglas sa id: '.$k->idO.' po ceni od '.$data->trenutnaCena.'€.',
                                        'datumVreme' => $currentTime->format('Y-m-d H:i:s')
                                    ];
                                    $obv->insert($arr);
                                    //obavestenje za sve klijente koji prate oglas da je nekretnina prodata
                                    $model = new CustomModel($db);
                                    $klijenti = $model->dohvatiSveKojiPrateOglas($k->idO);
                                    foreach($klijenti as $klijent){
                                        $obv = new Obavestenje();
                                        $arr = [
                                            'idOba' => null,
                                            'korIme' => $klijent->korImeKlijent,
                                            'tekst' => 'Oglas sa id: '.$k->idO.' je prodat za '.$data->trenutnaCena.'€.',
                                            'datumVreme' => $currentTime->format('Y-m-d H:i:s')
                                        ];
                                        $obv->insert($arr);
                                    }

                                } else { //ako nema ponuda, licitacija je gotova i brise se
                                    $lic = new Licitacija();
                                    $lic->delete($data->idLic);

                                }
                            }
                        }       
                        ?>
                        <?php if($data && !$krajLicitacije) :?>
                            <div class="naslovLicitacija text-center mt-3">
                                <h4 class="h4">Licitacija u toku</h4>
                                <p class="p">Trenutna cena: <?php echo $data->trenutnaCena ?> €</p>
                            </div>
                            <form method="post" action="<?php echo site_url('klijent/ponudaZaLicitaciju/'.$oglas->idO) ?>">
                                <div class="terminDugmici mt-3 mb-3">
                                    <label for="ponuda">Unesite vašu ponudu:</label>
                                    <input type="number" id="ponuda" name="ponuda" min="<?php echo ($data->trenutnaCena * 1.05)?>" class="form-control" placeholder="Mora biti 5% veca od trenutne" required>
                                    <button type="submit" class="btn btn-outline-secondary me-2 mb-2" style="width: 100%;">Prosledi ponudu</button>
                                </div>
                            </form>
                        <?php endif;?>

                    </div>
                    
                    <?php endif;?>
                </div>
            </div>
        </div>
    </body>
</html>
