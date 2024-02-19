<!-- Nikola Lazić 2020/0318 -->
<!-- Stefan Dumić 2020/0012 -->
        <div class="row">    
            <div class="col-sm-12 text-center border-bottom">
                <h3 class="h3">Promena informacija oglasa</h3>
            </div>
            <div class="row main col-sm-12">
                <div class="col-sm-9 mx-auto">
                    <form class="row g-3" method="post">
                        <div class="col-md-6">
                            <label for="inputNaziv" class="form-label"><b>Naziv</b></label>
                            <input type="text" value="<?= $oglas->naziv ?>" class="form-control" id="inputNaziv" name="naziv" placeholder="Naziv oglasa">
                        </div>
                        
                        <div class="col-md-3">
                            <label for="inputCena" class="form-label"><b>Cena</b></label>
                            <input type="number" value="<?= $oglas->cena ?>" class="form-control" id="inputCena" name='cena' placeholder="Cena u €">
                        </div>
                        
                        <div class="col-md-12 input-group">
                            <span class="input-group-text">Opis</span>
                            <textarea class="form-control" name="opis" aria-label="With textarea"><?= $oglas->opis ?></textarea>
                        </div>
                        <label for="cena" class="form-label"><b>Dodatne specifikacije</b></label>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="Sank" name="Sank" value="1">
                                        <label class="form-check-label" for="Sank">Šank</label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="Prozor u kuhinji" name="Prozor_u_kuhinji" value="1">
                                        <label class="form-check-label" for="Prozor u kuhinji">Prozor u kuhinji</label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="Prozor u kupatilu" name="Prozor_u_kupatilu" value="1">
                                        <label class="form-check-label" for="Prozor u kupatilu">Prozor u kupatilu</label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="Garaza" name="Garaza" value="1">
                                        <label class="form-check-label" for="Garaza">Garaža</label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="Lift" name="Lift" value="1">
                                        <label class="form-check-label" for="Lift">Lift</label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="Podrum" name="Podrum" value="1">
                                        <label class="form-check-label" for="Podrum">Podrum</label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="Obezbedjenje" name="Obezbedjenje" value="1">
                                        <label class="form-check-label" for="Obezbedjenje">Obezbedjenje</label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="Video nadzor" name="Video nadzor" value="1">
                                        <label class="form-check-label" for="Video nadzor">Video nadzor</label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="Interfon" name="Interfon" value="1">
                                        <label class="form-check-label" for="Interfon">Interfon</label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="Bazen" name="Bazen" value="1">
                                        <label class="form-check-label" for="Bazen">Bazen</label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="Dvoriste" name="Dvoriste" value="1">
                                        <label class="form-check-label" for="Dvoriste">Dvorište</label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="Terasa" name="Terasa" value="1">
                                        <label class="form-check-label" for="Terasa">Terasa</label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="Klima uredjaj" name="Klima uredjaj" value="1">
                                        <label class="form-check-label" for="Klima uredjaj">Klima uredjaj</label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="Podno grejanje" name="Podno grejanje" value="1">
                                        <label class="form-check-label" for="Podno grejanje">Podno grejanje</label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="Opremljen" name="Opremljen" value="1">
                                        <label class="form-check-label" for="Opremljen">Opremljen</label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="Optika" name="Optika" value="1">
                                        <label class="form-check-label" for="Optika">Optika</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if(isset($validation)) : ?>
                            <div class="text-danger text-center">
                                <?= $validation->listErrors() ?>
                                <?php if(isset($msg)) : ?>
                                    <?= $msg ?>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                        <div class="col-md-3 mx-auto">
                            <button type="submit" class="btn btn-outline-secondary" style="width: 100%;">Sačuvaj</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
