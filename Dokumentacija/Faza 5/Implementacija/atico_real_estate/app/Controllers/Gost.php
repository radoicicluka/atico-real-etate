<?php
/**
 * Luka Radoičić 2020/0085
 * Bora Miletić 2020/0319
 * Nikola Lazić 2020/0318
 * Stefan Dumić 2020/0012
 */
namespace App\Controllers;

use App\Models\CustomModel;
use App\Models\Korisnik;
use App\Models\Klijent;
use App\Models\Agent;
use App\Models\DodateSpecifikacije;
use App\Models\Oglas;
use App\Models\Sadrzi;
use App\Models\Zahtev;
use App\Models\ZahtevZaRegistraciju;
use Config\Services;

/**
 * Gost - kontroler klasa za rad sa gostom
 * 
 * @version 1.0
 */
class Gost extends BaseController
{

    /**
     * Ispis početne stranice.
     * 
     * @return void
     */
    public function index()
    {
        echo view('sablon/header_gost');

        $db = db_connect();
        $model = new CustomModel($db);
        $arry = $model->dohvatiSvePrihvaceneOglase();
        $ogl = new Oglas();

        // if($this->request->getMethod() == 'post'){
        //     // echo '<pre>';
        //     // print_r($_POST);
        //     // echo '</pre>';
        //     // $ops = $model->filterOpstina($_POST['opstina']);
        //     // $ops1 = $ops->filterBrSoba($_POST['brojSoba']);
        //     $data['oglasi'] = '';// treba da se postavi dobijena tabela posle svih filtera
        // }
        //  else{
        //     $data['oglasi'] = $model->dohvatiSveOglase();
        //  }
        
        $data['oglasi'] = $arry;
        return view('stranice/index', $data);
    }

    /**
     * Ispis stranice oglasa za gosta.
     * 
     * @param int $idO
     * @return void
     */
    public function oglas($idO){
        echo view('sablon/header_gost');

        $db = db_connect();
        $model=new Oglas($db);
        $k = $model->getOglas($idO);

        $data['oglas'] = $k;
        // print_r($k->cena);


        $model = new Sadrzi($db);
        $spec1 = $model->dohvatiDodatneSpecifikacije($idO);
        $data['sank1'] = ' - ';
        $data['kuhP1'] = ' - ';
        $data['kupP1'] = ' - ';
        $data['garaza1'] = ' - ';
        $data['lift1'] = ' - ';
        $data['podrum1'] = ' - ';

        $data['obezbedjenje1'] = ' - ';
        $data['video1'] = ' - ';
        $data['interfon1'] = ' - ';
        $data['bazen1'] = ' - ';
        $data['dvoriste1'] = ' - ';

        $data['terasa1'] = ' - ';
        $data['klima1'] = ' - ';
        $data['podno1'] = ' - ';
        $data['opremljen1'] = ' - ';
        $data['optika1'] = ' - ';
        foreach($spec1 as $s1){
            if($s1->idS == 1) $data['sank1'] = 'Da';
            if($s1->idS == 2) $data['kuhP1'] = 'Da';
            if($s1->idS == 3) $data['kupP1'] = 'Da';
            if($s1->idS == 4) $data['garaza1'] = 'Da';
            if($s1->idS == 5) $data['lift1'] = 'Da';
            if($s1->idS == 6) $data['podrum1'] = 'Da';
            if($s1->idS == 7) $data['obezbedjenje1'] = 'Da';
            if($s1->idS == 8) $data['video1'] = 'Da';
            if($s1->idS == 9) $data['interfon1'] = 'Da';
            if($s1->idS == 10) $data['bazen1'] = 'Da';
            if($s1->idS == 11) $data['dvoriste1'] = 'Da';
            if($s1->idS == 12) $data['terasa1'] = 'Da';
            if($s1->idS == 13) $data['klima1'] = 'Da';
            if($s1->idS == 14) $data['podno1'] = 'Da';
            if($s1->idS == 15) $data['opremljen1'] = 'Da';
            if($s1->idS == 16) $data['optika1'] = 'Da';
        }
        echo view('stranice/oglas',$data);
    }

    /**
     * Prelazak na stranicu za registraciju.
     * 
     * @return void
     */
    public function registracija(){
        echo view('stranice/registracija');
    }

    /**
     * Registracija korisnika čime se kreira novi nalog agenta.
     * 
     * @return string
     */
    public function registracijaAgent(){
        helper('form');
        $data = [];

        //value="1" Lux.com
        //value="2" Diamond
        //value="3" Metropolitan
        //value="4" Kosmopolis

        if($this->request->getMethod() == 'post'){
            $rules = ['email' => 'required',
                    'lozinka' => 'required|min_length[6]|max_length[16]',
                    'korIme' => 'required',
                    'prezime' => 'required',
                    'ime' => 'required',
                    'agencija' => 'required'
                ];

            if($this->validate($rules)){
                $db = db_connect();
                $model=new CustomModel($db);
                $var = $model->proveriKorIme($_POST['korIme']);
                if(!$var){
                    // provera email-a
                    $var = $model->proveriemail($_POST['email']);
                    if(!$var){
                        $agenc = "";
                        if($_POST['agencija'] == 1){
                            $agenc = "Lux.com";
                        }elseif($_POST['agencija'] == 2){
                            $agenc = "Diamond";
                        }elseif($_POST['agencija'] == 3){
                            $agenc = "Metropolitan";
                        }elseif($_POST['agencija'] == 4){
                            $agenc = "Kosmopolis";
                        }

                        $nnovi = new Agent();
                        $arr = [
                            "korIme" => $_POST['korIme'],
                            "aktivan" => 0,
                            "agencija" => $agenc
                        ];
                        $nnovi->insert($arr);
                        $novi = new Korisnik();
                        $novi->insert($_POST);

                        $noviZahtev = new Zahtev();
                        $noviZahtevZaRegistraciju = new ZahtevZaRegistraciju();
                        $arr1 = [
                            'idZah' => null,
                            'tipZahteva' => 1
                        ];
                        
                        $idz = $noviZahtev->insert($arr1);

                        $arr = [
                            'idZah' => $idz,
                            'korIme' => $_POST['korIme']
                        ];
                        $noviZahtevZaRegistraciju->insert($arr);


                        return redirect()->to(site_url('gost'));

                    }else{
                        $data['msg'] = 'Email je zauzet!';
                    }

                }else{
                    $data['msg'] = 'Korisnicko ime je zauzeto!';
                }
            }else{
                $data['validation'] = $this->validator;
            }
        }
        return view('stranice/registracijaAgent', $data);
    }

    /**
     * Registracija korisnika čime se kreira novi nalog klijenta.
     * 
     * @return string
     */
    public function registracijaKlijent(){
        helper('form');
        $data = [];

        if($this->request->getMethod() == 'post'){
            $rules = ['email' => 'required',
                    'lozinka' => 'required|min_length[6]|max_length[16]',
                    'korIme' => 'required',
                    'prezime' => 'required',
                    'ime' => 'required'
                ];

            if($this->validate($rules)){
                $db = db_connect();
                $model=new CustomModel($db);
                // provera korIme
                $var = $model->proveriKorIme($_POST['korIme']);
                if(!$var){
                    // provera email-a
                    $var = $model->proveriemail($_POST['email']);
                    if(!$var){
                        $nnovi = new Klijent();
                        $arr = [
                            "korIme" => $_POST['korIme'],
                            "aktivan" => 0
                        ];
                        $nnovi->insert($arr);
                        $novi = new Korisnik();
                        $novi->insert($_POST);

                        $noviZahtev = new Zahtev();
                        $noviZahtevZaRegistraciju = new ZahtevZaRegistraciju();
                        $arr1 = [
                            'idZah' => null,
                            'tipZahteva' => 1
                        ];

                        $idz = $noviZahtev->insert($arr1);

                        $arr = [
                            'idZah' => $idz,
                            'korIme' => $_POST['korIme']
                        ];
                        $noviZahtevZaRegistraciju->insert($arr);

                        return redirect()->to(site_url('gost'));

                    }else{
                        $data['msg'] = 'Email je zauzet!';
                    }

                }else{
                    $data['msg'] = 'Korisnicko ime je zauzeto!';
                }
            }else{
                $data['validation'] = $this->validator;
            }
        }
        return view('stranice/registracijaKlijent', $data);
    }

    /**
     * Prijava neulogovanog korisnika čime prelazi u ulogovanog korisnika (klijenta, agenta ili administratora).
     * 
     * @return string
     */
    public function prijava(){
        helper(['form']);
        $data = [];
        $mask = 0;
        if($this->request->getMethod() == 'post'){
            $rules = ['email' => 'required',
                    'password' => 'required|min_length[6]|max_length[16]'];
            
            if($this->validate($rules)){
                $db = db_connect();
                $model=new CustomModel($db);
                if($cc = $model->pronadjiKorisnika($_POST['email'],$_POST['password'])){

                    if($klij = $model->pronadjiKlijenta($cc->korIme)){
                        if($klij->aktivan == 1){
                            $_SESSION['autor'] = $cc->korIme;
                            $_SESSION['tip'] = "Klijent";
                            return redirect()->to(site_url('Klijent'));
                        }
                        else{
                            $mask = 1;
                        }
    
                    }elseif($agn = $model->pronadjiAgenta($cc->korIme)){
                        if($agn->aktivan ==1){
                            $_SESSION['autor'] = $cc->korIme;
                            $_SESSION['tip'] = "Agent";
                            return redirect()->to(site_url('Agent'));
                        }
                        else{
                            $mask = 1;
                        }
                    }else{
                        $_SESSION['autor'] = $cc->korIme;
                        $_SESSION['tip'] = "Admin";
                        return redirect()->to(site_url('Admin'));
                    }
                }
                if($mask) {
                    $data['msg'] = 'Korisnik jos nije odobren!';
                }
                else{
                    $data['msg'] = 'Email i/ili šifra nisu tačni!';
                }
            }else{
                $data['validation'] = $this->validator;
            }

            
        }
        return view('stranice/prijava', $data);
    }
           
    public function ispisTabele()
    {
        $db = db_connect();
        $model=new CustomModel($db);
        echo '<pre>';
        print_r($model->where());
        echo '<pre>';
    }   

    public function join()
    {
        $db = db_connect();
        $model=new CustomModel($db);
        echo '<pre>';
        print_r($model->join());
        echo '<pre>';
    }  
    public function like()
    {
        $db = db_connect();
        $model=new CustomModel($db);
        echo '<pre>';
        print_r($model->like());
        echo '<pre>';
    }  
    public function gruping()
    {
        $db = db_connect();
        $model=new CustomModel($db);
        echo '<pre>';
        print_r($model->grouping());
        echo '<pre>';
    }

    /**
     * Uporedjivanje dva oglasa. Biranjem ID-a dva oglasa
     * mou se uporediti ti oglasi.
     * 
     * @return string
     */
    function uporedjivanjeOglasa(){
        helper(['form']);
        echo view('sablon/header_gost');
        $data = [];
        $db = db_connect();
        $model = new CustomModel($db);
        $oglasi = $model->dohvatiSveOglase();
        $data['oglasi'] = $oglasi;


        if($this->request->getMethod() == 'post'){
            $rules = [
                'id1' => 'required',
                'id2' => 'required'
            ];
            
            if($this->validate($rules)){
                $model=new Oglas($db);
                $idO1 = $_POST['id1'];
                $idO2 = $_POST['id2'];
                $oglas1 = $model->getOglas($idO1);
                $oglas2 = $model->getOglas($idO2);
                if (!$oglas1 && !$oglas2) $data['msg'] = "Oglasi ".$idO1." i ".$idO2." ne postoje.";
                else if(!$oglas1) $data['msg'] = "Oglas ".$idO1." ne postoji.";
                else if(!$oglas2) $data['msg'] = "Oglas ".$idO2." ne postoji.";
                $data['oglas1'] = $oglas1;
                $data['oglas2'] = $oglas2;

                $model = new Sadrzi($db);
                $spec1 = $model->dohvatiDodatneSpecifikacije($idO1);
                $spec2 = $model->dohvatiDodatneSpecifikacije($idO2);
                $data['sank1'] = ' - ';
                $data['kuhP1'] = ' - ';
                $data['kupP1'] = ' - ';
                $data['garaza1'] = ' - ';
                $data['lift1'] = ' - ';
                $data['podrum1'] = ' - ';

                $data['obezbedjenje1'] = ' - ';
                $data['video1'] = ' - ';
                $data['interfon1'] = ' - ';
                $data['bazen1'] = ' - ';
                $data['dvoriste1'] = ' - ';

                $data['terasa1'] = ' - ';
                $data['klima1'] = ' - ';
                $data['podno1'] = ' - ';
                $data['opremljen1'] = ' - ';
                $data['optika1'] = ' - ';
                foreach($spec1 as $s1){
                    if($s1->idS == 1) $data['sank1'] = 'Da';
                    if($s1->idS == 2) $data['kuhP1'] = 'Da';
                    if($s1->idS == 3) $data['kupP1'] = 'Da';
                    if($s1->idS == 4) $data['garaza1'] = 'Da';
                    if($s1->idS == 5) $data['lift1'] = 'Da';
                    if($s1->idS == 6) $data['podrum1'] = 'Da';
                    if($s1->idS == 7) $data['obezbedjenje1'] = 'Da';
                    if($s1->idS == 8) $data['video1'] = 'Da';
                    if($s1->idS == 9) $data['interfon1'] = 'Da';
                    if($s1->idS == 10) $data['bazen1'] = 'Da';
                    if($s1->idS == 11) $data['dvoriste1'] = 'Da';
                    if($s1->idS == 12) $data['terasa1'] = 'Da';
                    if($s1->idS == 13) $data['klima1'] = 'Da';
                    if($s1->idS == 14) $data['podno1'] = 'Da';
                    if($s1->idS == 15) $data['opremljen1'] = 'Da';
                    if($s1->idS == 16) $data['optika1'] = 'Da';
                }
                $data['sank2'] = ' - ';
                $data['kuhP2'] = ' - ';
                $data['kupP2'] = ' - ';
                $data['garaza2'] = ' - ';
                $data['lift2'] = ' - ';
                $data['podrum2'] = ' - ';
                $data['obezbedjenje2'] = ' - ';
                $data['video2'] = ' - ';
                $data['interfon2'] = ' - ';
                $data['bazen2'] = ' - ';
                $data['dvoriste2'] = ' - ';
                $data['terasa2'] = ' - ';
                $data['klima2'] = ' - ';
                $data['podno2'] = ' - ';
                $data['opremljen2'] = ' - ';
                $data['optika2'] = ' - ';
                foreach($spec2 as $s2){
                    if($s2->idS == 1) $data['sank2'] = 'Da';
                    if($s2->idS == 2) $data['kuhP2'] = 'Da';
                    if($s2->idS == 3) $data['kupP2'] = 'Da';
                    if($s2->idS == 4) $data['garaza2'] = 'Da';
                    if($s2->idS == 5) $data['lift2'] = 'Da';
                    if($s2->idS == 6) $data['podrum2'] = 'Da';
                    if($s2->idS == 7) $data['obezbedjenje2'] = 'Da';
                    if($s2->idS == 8) $data['video2'] = 'Da';
                    if($s2->idS == 9) $data['interfon2'] = 'Da';
                    if($s2->idS == 10) $data['bazen2'] = 'Da';
                    if($s2->idS == 11) $data['dvoriste2'] = 'Da';
                    if($s2->idS == 12) $data['terasa2'] = 'Da';
                    if($s2->idS == 13) $data['klima2'] = 'Da';
                    if($s2->idS == 14) $data['podno2'] = 'Da';
                    if($s2->idS == 15) $data['opremljen2'] = 'Da';
                    if($s2->idS == 16) $data['optika2'] = 'Da';
                }
                return view('stranice/uporedjivanjeOglasa', $data);
            }
            $data['validation'] = $this->validator;
            return view('stranice/index', $data);
        }
        
    }

    /**
     * Filtriranje glasa na osnovu osnovnih i dodatnih specifikacija.
     * 
     * @return string
     */
    function filter(){
        helper(['form']);
        $data = [];
        $data['filter'] = 1;
        if($this->request->getMethod() == 'post'){
            $db = db_connect();
            $model = new CustomModel($db);
            $oglasi = $model->dohvatiSvePrihvaceneOglase();


            $opstina = $_POST['opstina'];
            if(isset($opstina)) {
                if($opstina != "0"){
                    $oglasi2 = [];
                    $j = 0;
                    for($i = 0; $i < count($oglasi); $i++){
                        if ($oglasi[$i]->opstina == $opstina) $oglasi2[$j++] = $oglasi[$i];
                    }
                    $oglasi = $oglasi2;
                }
            }


            $brSoba = $_POST['brojSoba'];
            if(isset($brSoba)) {
                if($brSoba != 0){
                    $oglasi2 = [];
                    $j = 0;
                    if ($brSoba != 5){
                        for($i = 0; $i < count($oglasi); $i++){
                            if ($oglasi[$i]->brSoba == $brSoba) $oglasi2[$j++] = $oglasi[$i];
                        }
                    }
                    else {
                        for($i = 0; $i < count($oglasi); $i++){
                            if ($oglasi[$i]->brSoba >= $brSoba) $oglasi2[$j++] = $oglasi[$i];
                        }
                    }
                    $oglasi = $oglasi2;
                }
            }

            $kv = $_POST['kvadratura'];
            if(isset($kv)) {
                if($kv != 0){
                    if($kv == 8){
                        $min = 140;
                        $max = 10000;
                    }
                    else {
                        $max = $kv * 20;
                        $min = $max - 20;
                    }
                    $oglasi2 = [];
                    $j = 0;
                    for($i = 0; $i < count($oglasi); $i++){
                        if ($oglasi[$i]->kvadratura > $min && $oglasi[$i]->kvadratura < $max) $oglasi2[$j++] = $oglasi[$i];
                    }
                    $oglasi = $oglasi2;
                }
            }

            $minCena = $_POST['min'];
            $maxCena = $_POST['max'];
            if($minCena != '' || $maxCena != '') {
                $oglasi2 = [];
                $j = 0;
                if ($minCena != '' && $maxCena != ''){
                    for($i = 0; $i < count($oglasi); $i++){
                        if ($oglasi[$i]->cena >= $minCena && $oglasi[$i]->cena <= $maxCena) $oglasi2[$j++] = $oglasi[$i];
                    }
                }
                else if($minCena != ''){
                    for($i = 0; $i < count($oglasi); $i++){
                        if ($oglasi[$i]->cena >= $minCena) $oglasi2[$j++] = $oglasi[$i];
                    }
                }
                else{
                    for($i = 0; $i < count($oglasi); $i++){
                        if ($oglasi[$i]->cena <= $maxCena) $oglasi2[$j++] = $oglasi[$i];
                    }
                }
                $oglasi = $oglasi2;
            }

            // FILTRIRANJE PO DODATNIM SPECIFIKACIJAMA
            $j = 0;
            $oglasi2 = [];
            $model = new Sadrzi($db);
            for($i = 0; $i < count($oglasi); $i++){
                // $spec = $model->dohvatiDodatneSpecifikacije($oglasi[$i]->idO);
                $uslov = true;
                if(isset($_POST['sank']) && !$model->oglasSadrziSpecifikaciju($oglasi[$i]->idO, 1)) $uslov = false;
                if(isset($_POST['kuhP']) && !$model->oglasSadrziSpecifikaciju($oglasi[$i]->idO, 2)) $uslov = false;
                if(isset($_POST['kupP']) && !$model->oglasSadrziSpecifikaciju($oglasi[$i]->idO, 3)) $uslov = false;
                if(isset($_POST['Garaza']) && !$model->oglasSadrziSpecifikaciju($oglasi[$i]->idO, 4)) $uslov = false;
                if(isset($_POST['Lift']) && !$model->oglasSadrziSpecifikaciju($oglasi[$i]->idO, 5)) $uslov = false;
                if(isset($_POST['Podrum']) && !$model->oglasSadrziSpecifikaciju($oglasi[$i]->idO, 6)) $uslov = false;
                if(isset($_POST['Obezbedjenje']) && !$model->oglasSadrziSpecifikaciju($oglasi[$i]->idO, 7)) $uslov = false;
                if(isset($_POST['Video']) && !$model->oglasSadrziSpecifikaciju($oglasi[$i]->idO, 8)) $uslov = false;
                if(isset($_POST['Interfon']) && !$model->oglasSadrziSpecifikaciju($oglasi[$i]->idO, 9)) $uslov = false;
                if(isset($_POST['Bazen']) && !$model->oglasSadrziSpecifikaciju($oglasi[$i]->idO, 10)) $uslov = false;
                if(isset($_POST['Dvoriste']) && !$model->oglasSadrziSpecifikaciju($oglasi[$i]->idO, 11)) $uslov = false;
                if(isset($_POST['Terasa']) && !$model->oglasSadrziSpecifikaciju($oglasi[$i]->idO, 12)) $uslov = false;
                if(isset($_POST['Klima']) && !$model->oglasSadrziSpecifikaciju($oglasi[$i]->idO, 13)) $uslov = false;
                if(isset($_POST['Podno']) && !$model->oglasSadrziSpecifikaciju($oglasi[$i]->idO, 14)) $uslov = false;
                if(isset($_POST['Opremljen']) && !$model->oglasSadrziSpecifikaciju($oglasi[$i]->idO, 15)) $uslov = false;
                if(isset($_POST['Optika']) && !$model->oglasSadrziSpecifikaciju($oglasi[$i]->idO, 16)) $uslov = false;
                if($uslov) $oglasi2[$j++] = $oglasi[$i];
            }
            $oglasi = $oglasi2;
            
            $data['oglasi'] = $oglasi;
            echo view('sablon/header_gost');
            return view('stranice/index', $data);
            
        }
        echo view('sablon/header_gost');
        return view('stranice/index', $data);
    }

}   