<!-- Stefan Dumić 2020/0012 -->
<!-- Luka Radoičić 2020/0085 -->
		<div class="row">
			<div class="row col-sm-12 mb-3">
				<div class="col-sm-6" style="padding-left: 10%; padding-right: 10%;">
					<h4 class="h4"><?php echo $oglas1->naziv; ?></h4>
					<p class="p"><?php echo $oglas1->opis; ?></p>
				</div>
				<div class="col-sm-6" style="padding-left: 10%; padding-right: 10%;">
					<h4 class="h4"><?php echo $oglas2->naziv; ?></h4>
					<p class="p"><?php echo $oglas2->opis; ?></p>
				</div>
			</div>
			<div class="row col-sm-12 mb-3">
				<div class="col-sm-6 border-bottom" style="height:420px;">
					<div id="carouselExample" class="carousel slide mb-3">
						<div class="carousel-inner">
							<?php for($i=1; $i <= 3 ; $i++): ?>
								<?php if($i == 1) :?>
                                        <div class="carousel-item active" style="height:420px;">
                                    <?php else: ?>
                                        <div class="carousel-item" style="height:420px;">
                                    <?php endif; ?>	
									<img src="<?php echo base_url('/uploads/oglas'. $oglas1->idO."/slika". $i .".jpg");?>" class="img-fluid rounded " alt="slika". $i .".jpg">
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
				
				<div class="slikeOglasa col-sm-6 border-bottom" style="height:420px;">
					<div id="carouselExample1" class="carousel slide mb-3">
						<div class="carousel-inner">
							<?php for($i=1; $i <= 3 ; $i++): ?>
								<?php if($i == 1) :?>
                                        <div class="carousel-item active" style="height:420px;">
                                    <?php else: ?>
                                        <div class="carousel-item" style="height:420px;">
                                    <?php endif; ?>
                            		<img src="<?php echo base_url('/uploads/oglas'. $oglas2->idO."/slika". $i .".jpg");?>" class="img-fluid rounded" alt="slika". $i .".jpg">
                              	</div>
                            <?php endfor; ?>
						</div>
						<button class="carousel-control-prev" type="button" data-bs-target="#carouselExample1" data-bs-slide="prev">
							<span class="carousel-control-prev-icon" aria-hidden="true"></span>
							<span class="visually-hidden">Previous</span>
						</button>
						<button class="carousel-control-next" type="button" data-bs-target="#carouselExample1" data-bs-slide="next">
							<span class="carousel-control-next-icon" aria-hidden="true"></span>
							<span class="visually-hidden">Next</span>
						</button>
					</div>
				</div>
			</div>
			<div class="row col-sm-12 mb-3">
				<div class="specifikacijeOglasa col-sm-6 mb-3 mt-3">
					<div class="row">
						<div class="col-sm-4 text-center">
							<h5 class="h5 mb-3" >
								<b><?php echo $oglas1->kvadratura."m²" ?></b>
							</h5>
							<p class="p">Broj soba: <?php echo $oglas1->brSoba ?></p>
							<p class="p">Kuhinjski prozor: <?php echo $kuhP1 ?></p>
							<p class="p">Prozor u kupatilu: <?php echo $kupP1?> </p>
							<p class="p">Garaža: <?php echo $garaza1 ?></p>
							<p class="p">Lift: <?php echo $lift1 ?></p>
							<p class="p">Podrum/Ostava: <?php echo $podrum1 ?></p>
						</div>
						<div class="col-sm-4 text-center">
							<h5 class="h5 mb-3" >
								<b><?php echo $oglas1->opstina ?></b>
							</h5>
							<p class="p">Grejanje: <?php echo $oglas1->grejanje ?></p>
							<p class="p">Obezbedjenje: <?php echo $obezbedjenje1 ?></p>
							<p class="p">Video nadzor: <?php echo $video1 ?> </p>
							<p class="p">Interfon: <?php echo $interfon1 ?></p>
							<p class="p">Bazen: <?php echo $bazen1 ?></p>
							<p class="p">Dvorište: <?php echo $dvoriste1 ?></p>
						</div>
						<div class="col-sm-4 text-center">
							<h5 class="h5 mb-3" >
								<b><?php echo $oglas1->cena."€" ?></b>
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
				<div class="specifikacijeOglasa col-sm-6 mb-3 mt-3 border-start">
					<div class="row">
						<div class="col-sm-4 text-center">
							<h5 class="h5 mb-3" >
								<b><?php echo $oglas2->kvadratura."m²" ?></b>
							</h5>
							<p class="p">Broj soba: <?php echo $oglas2->brSoba ?></p>
							<p class="p">Kuhinjski prozor: <?php echo $kuhP2 ?></p>
							<p class="p">Prozor u kupatilu: <?php echo $kupP2?> </p>
							<p class="p">Garaža: <?php echo $garaza2 ?></p>
							<p class="p">Lift: <?php echo $lift2 ?></p>
							<p class="p">Podrum/Ostava: <?php echo $podrum2 ?></p>
						</div>
						<div class="col-sm-4 text-center">
							<h5 class="h5 mb-3" >
								<b><?php echo $oglas2->opstina ?></b>
							</h5>
							<p class="p">Grejanje: <?php echo $oglas2->grejanje ?></p>
							<p class="p">Obezbedjenje: <?php echo $obezbedjenje2 ?></p>
							<p class="p">Video nadzor: <?php echo $video2 ?> </p>
							<p class="p">Interfon: <?php echo $interfon2 ?></p>
							<p class="p">Bazen: <?php echo $bazen2 ?></p>
							<p class="p">Dvorište: <?php echo $dvoriste2 ?></p>
						</div>
						<div class="col-sm-4 text-center">
							<h5 class="h5 mb-3" >
								<b><?php echo $oglas2->cena."€" ?></b>
							</h5>
							<p class="p">Terasa: <?php echo $terasa2 ?></p>
							<p class="p">Klima uredjaj: <?php echo $klima2 ?></p>
							<p class="p">Podno grejanje: <?php echo $podno2 ?> </p>
							<p class="p">Opremljen: <?php echo $opremljen2 ?></p>
							<p class="p">Optika: <?php echo $optika2 ?></p>
							<p class="p">Šank: <?php echo $sank2 ?></p>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
</body>
</html>
