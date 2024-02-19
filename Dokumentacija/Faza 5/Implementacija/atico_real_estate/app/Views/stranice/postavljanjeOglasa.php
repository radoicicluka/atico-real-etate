<!-- Nikola Lazić 2020/0318 -->
<!-- Stefan Dumić 2020/0012 -->

        <div class="row">    
            <div class="col-sm-12 text-center border-bottom">
                <h3 class="h3">Postavljanje oglasa</h3>
            </div>
            <div class="row main col-sm-12">
                <div class="col-sm-9 mx-auto">
                    <form class="row g-3" method="post" enctype="multipart/form-data">
                        <div class="col-md-6">
                            <label for="naziv" class="form-label"><b>Naziv</b></label>
                            <input type="text" class="form-control" id="naziv" name="naziv" value="<?= set_value('naziv')?>" placeholder="Naziv oglasa">
                          </div>
                        <div class="col-md-6">
                          <label for="adresa" class="form-label"><b>Adresa</b></label>
                          <input type="text" class="form-control" id="adresa" name="adresa" value="<?= set_value('adresa')?>" placeholder="Unesite adresu">
                        </div>
                        <div class="col-md-6">
                            <label for="opstina" class="form-label"><b>Opština</b></label>
                            <select class="form-select" id="opstina" name="opstina" value="<?= set_value('opstina')?>">
                                <option value="0" selected>Izaberite</option>
                                <option value="Čukarica">Čukarica</option>
                                <option value="Novi Beograd">Novi Beograd</option>
                                <option value="Palilula">Palilula</option>
                                <option value="Rakovica">Rakovica</option>
                                <option value="Savski venac">Savski venac</option>
                                <option value="Stari grad">Stari grad</option>
                                <option value="Voždovac">Voždovac</option>
                                <option value="Vračar">Vračar</option>
                                <option value="Zemun">Zemun</option>
                                <option value="Barajevo">Zvezdara</option>
                                <option value="Barajevo">Barajevo</option>
                                <option value="Grocka">Grocka</option>
                                <option value="Lazarevac">Lazarevac</option>
                                <option value="Mladenovac">Mladenovac</option>
                                <option value="Obrenovac">Obrenovac</option>
                                <option value="Sopot">Sopot</option>
                                <option value="Surčin">Surčin</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                          <label for="grad" class="form-label"><b>Grad</b></label>
                          <input type="text" class="form-control" id="grad" name="grad" value="<?= set_value('grad')?>">
                        </div>
                        <div class="col-md-3">
                          <label for="grejanje" class="form-label"><b>Grejanje</b></label>
                          <input type="text" class="form-control" id="grejanje" name="grejanje" value="<?= set_value('grejanje')?>">
                        </div>
                        <div class="col-md-3">
                            <label for="cena" class="form-label"><b>Cena</b></label>
                            <input type="number" class="form-control" id="cena" name="cena" value="<?= set_value('cena')?>" placeholder="Cena u €">
                        </div>
                        <div class="col-md-3">
                            <label for="kvadratura" class="form-label"><b>Kvadratura</b></label>
                            <input type="number" class="form-control" id="kvadratura" name="kvadratura" value="<?= set_value('kvadratura')?>" placeholder="Kvadratura u (m²)">
                        </div>
                        <div class="col-md-3">
                            <label for="brojSoba" class="form-label"><b>Broj soba</b></label>
                            <input type="number" class="form-control" id="brojSoba" name="brojSoba" value="<?= set_value('brojSoba')?>">
                        </div>
                        <div class="col-md-12 input-group">
                            <span class="input-group-text">Opis</span>
                            <textarea class="form-control" name="opis" value="<?= set_value('opis')?>"></textarea>
                        </div>
                        <div class="input-group col-md-12">
                            <label class="input-group-text" for="slike"><b>Slike</b></label>
                            <input type="file" class="form-control" name="images[]" multiple>
                        </div>
                        <div class="input-group col-md-12">
                            <select class="form-select mb-3 mt-3" name="agencija" value="<?= set_value('agencija')?>" aria-label="Default select example">
                                <option selected>Agencija</option>
                                <option value="1">Lux.com</option>
                                <option value="2">Diamond</option>
                                <option value="3">Metropolitan</option>
                                <option value="4">Kosmopolis</option>
                            </select>
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
                            <button type="submit" class="btn btn-outline-secondary mb-5" style="width: 100%;">Postavi oglas</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
