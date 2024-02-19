<!-- Nikola Lazić 2020/0318 -->
<!-- Stefan Dumić 2020/0012 -->
<!-- Luka Radoičić 2020/0085 -->


                    <!-- ovaj deo se dohvata iz baze podataka sve do * -->
                    
                    <form method="post">
                    <?php foreach ($oglasi as $oglas):?>
                    <div class="card mb-3 mx-auto" style="max-width: 80%;">
            
                        <div class="row g-0">
                            <div class="col-md-4">
                                <a href="<?php echo base_url("agent/oglas/$oglas->idO"); ?>">
                                    <img src="<?php echo base_url('/uploads/oglas'. $oglas->idO."/slika1.jpg");?>" class="img-fluid rounded-start" alt="slika">
                                </a>
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <h5 class="card-title">"<?= $oglas->naziv ?>"</h5>
                                            <p class="card-text"><?= $oglas->opis ?></p>
                                        </div>
                                        <div class="col-md-3"> 
                                            <?php if($oglas->prodat == 0):?>
                                            <button type="submit" name="obrisi <?= $oglas->idO ?>" value="1" id="dugme" class="btn btn-outline-secondary" >Označi kao prodat</button>
                                            <?php else: ?>
                                            <button class="btn btn-outline-secondary">Prodat</button>
                                            <?php endif; ?>
                                            
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
                    
                    
                    
                    
                    
                        
                    <!-- * -->
                
            
        
    </div>
</body>
</html>