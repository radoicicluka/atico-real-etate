<!-- Stefan Dumić 2020/0012 -->
<?php use App\Models\CustomModel; ?>

        <div class="row col-sm-12">
            <?php 
                    $db = db_connect();
                    $model=new CustomModel($db);
                    $kori = $model->proveriKorIme($kor);
                    $agent = $model->pronadjiAgenta($kor);
                    $klijent = $model->pronadjiKlijenta($kor);
            ?>
            <div class="col-sm-12 text-center border-bottom">
                <?php if(!empty($agent)): ?>
                    <h3> Tip naloga agent </h3>
                <?php endif; ?>
                <?php if(!empty($klijent)): ?>
                    <h3> Tip naloga klijent </h3>
                <?php endif; ?>
            </div>

            <div class="col-sm-5 mt-3 mx-auto">
                <table class="table table-striped mt-3">
                    <thead>
                        <tr>
                            <th>Korisničko ime</th>
                            <td><?= $kor ?></td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>Ime</th>
                            <td> <?= $kori->ime ?> </td>
                        </tr>
                        <tr>
                            <th>Prezime</th>
                            <td><?= $kori->prezime ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?= $kori->email ?></td>
                        </tr>
                        <?php if($agent) : ?>
                            <tr>
                                <th>Agencija</th>
                                <td><?= $agent->agencija ?></td>
                            </tr>
                        <?php endif; ?>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>