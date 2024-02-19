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
use App\Models\Licitacija;
use App\Models\Obavestenje;
use App\Models\Oglas;
use App\Models\Sadrzi;
use App\Models\Termin;
use App\Models\Zahtev;
use App\Models\ZahtevZaLicitaciju;
use App\Models\ZahtevZaOglase;
use App\Models\ZahtevZaRegistraciju;
use DateTime;

/**
 * Agent - kontroler klasa za rad sa agentom
 * 
 * @version 1.0
 */
class Agent extends BaseController
{
    /**
     * Ispis početne stranice.
     * 
     * @return void
     */
    public function index()
    {
        echo view('sablon/header_agent');
        $db = db_connect();
        $model=new CustomModel($db);
        $data['oglasi'] = $model->dohvatiSvePrihvaceneOglase();
        echo view('stranice/index', $data);
        
    }

    /**
     * Izlogovanje agenta. Funckija gasi sesiju i korisnika vraća na početnu stranicu kao gosta.
     * 
     * @return string
     */
    public function izlogujSe(){
        session()->destroy();
        return redirect()->to(site_url('gost'));
    }

    /**
     * Prikaz profila agenta.
     * 
     * @return string
     */
    public function profil(){
        echo view("sablon/header_agent");
        $data['korIme'] = $_SESSION['autor'];
        return view("stranice/profilAgent",$data);
    }

    /**
     * Ispis svih oglasa za koje je trenutni agent zadužen
     * 
     * @return string
     */
    public function pregledOglasa(){
        echo view("sablon/header_agent");
           
        $db = db_connect();
        $model = new CustomModel($db);
        
        $oglasi = $model->agentoviOglasi($_SESSION['autor']);
        $data['oglasi'] = $oglasi;
        
        
        if($_POST){
            foreach($oglasi as $oglas){
                
                if(isset($_POST["obrisi_".$oglas->idO])){
                    $ogl = new Oglas();
                    
                    $arr = [
                        'prodat' =>1
                    ];
                    $ogl->update($oglas->idO,$arr);
                    
                   
                }
            }
            
            
        }
        $oglasi = $model->agentoviOglasi($_SESSION['autor']);
        $data['oglasi'] = $oglasi;
        return view("stranice/pregledOglasaAgent",$data);
        
    }

    /**
     * Ispis agentovih termina za razgledanje.
     * 
     * @return string
     */
    public function raspored(){
        echo view("sablon/header_agent");

        $db = db_connect();
        $model=new CustomModel($db);
        $termini = $model->dohvatiTermine($_SESSION['autor']);
        $data['termini'] = $termini;

        return view('stranice/terminiAgenta', $data);
    }

    /**
     * Ispis zahteva za licitaciju koji su stigli agentu.
     * 
     * @return string
     */
    public function zahtevi(){
        echo view("sablon/header_agent");
        if($this->request->getMethod() == 'post'){
            $db = db_connect();
            $model = new CustomModel($db);
            $zahtevLicitacijaModel = new ZahtevZaLicitaciju($db);
            $zahtevModel = new Zahtev($db);
            $data = $model->pristigliZahteviAgent();
            if($_POST){
                for($x = 0; $x < count($data); $x++){
                    $z = 'zahtev_'.$x;
                    if (isset($_POST[$z])){
                        $idO = $data[$x]['idO'];
                        $cena = $data[$x]['cena'];
                        $kraj = $data[$x]['datum'];
                        $model1 = new Oglas($db);
                        $oglas = $model1->getOglas($idO);
                        $lic = new Licitacija($db);
                        $attr = [
                            'idLic' => null,
                            'korImeKlijent' => null, //'korImeKlijent' => $oglas->korImeKlijent,
                            'idO' => $idO,
                            'trenutnaCena' => $cena,
                            'vremeKraj' => $kraj
                        ];
                        $lic->insert($attr);
                        $klijenti = $model->dohvatiSveKojiPrateOglas($idO);
                        foreach($klijenti as $klijent){
                            $currentTime = new DateTime(); //za trenutno vreme
                            $currentTime->modify('+2 hours');
                            $obv = new Obavestenje();
                            $arr = [
                                'idOba' => null,
                                'korIme' => $klijent->korImeKlijent,
                                'tekst' => 'Oglas sa id: '.$idO.' je stavljen na licitaciju.',
                                'datumVreme' => $currentTime->format('Y-m-d H:i:s')
                            ];
                            $obv->insert($arr);
                        }  
                    }
                    $idZah = $data[$x]['idZah'];
                    $zahtevLicitacijaModel->delete($idZah);
                    $zahtevModel->delete($idZah);
                }
            }
        }
        return view('stranice/pristigliZahteviAgenta');
    }

    public function detaljnije($idTer){
        echo view("sablon/header_agent");

        $db = db_connect();
        $model=new CustomModel($db);
        // provera termina da li je zakazan
        // ako je zakazan uradimo join tabele termin sa oglasom po idO i prosledimo kao $data
        $proveraTermin = $model->dohvatiTermin($idTer);
        if($proveraTermin->idO){
            $ter = $model->dohvatiTerminSaOglasom($idTer);
            $data['termin'] = $ter;
        }else{
            $data['termin'] = $proveraTermin;
        }
        
        if($this->request->getMethod() == 'post'){
            if($_POST['action'] == 'izbrisi'){
                // brisanje termina
                // $ter = $model->dohvatiTermin($idTer);
                if(isset($ter->korImeKlijent)){
                    // slanje obavestenja klijentu da je termin obrisan
                    $obv = new Obavestenje();
                    $arr = [
                        'idOba' => null,
                        'korIme' => $ter->korImeKlijent,
                        'tekst' => 'Termin koji ste zakazali je obrisan.',
                        'datumVreme' => date("Y-m-d h:i:s")
                    ];
                    $obv->insert($arr);
                }
                $termin = new Termin();
                $termin->delete($idTer);
                
                return redirect()->to(site_url('agent/raspored'));
            }
            if($_POST['action'] == 'otkazi'){
                // otkazivanje termina
                
                // slanje obavestenja klijentu da je termin otkazan
                $obv = new Obavestenje();
                $arr = [
                    'idOba' => null,
                    'korIme' => $ter->korImeKlijent,
                    'tekst' => 'Termin koji ste zakazali je otkazan.',
                    'datumVreme' => date("Y-m-d h:i:s")
                ];
                $obv->insert($arr);

                $termin = new Termin();
                $arr = [
                    'korImeAgent' => $_SESSION['autor'],
                    'korImeKlijent' => null,
                    'idO' => null
                ];
                $termin->update($idTer, $arr);
                return redirect()->to(site_url('agent/raspored'));
            }
        }

        return view('stranice/otkazivanjeTerminaAgent', $data);
    }

    /**
     * Ispis oglasa sa svim njegovim osnovnim i dodatnim specifikacijama.
     * 
     * @param int $idO
     * @return string
     */
    public function oglas($idO){
        echo view('sablon/header_agent');

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
     * Kreiranje novog slobodnog termina agenta.
     * 
     * @return string
     */
    public function noviTermin(){
        echo view("sablon/header_agent");

        if($_POST){
            // napravi novi termin i dodaj ga
            $noviTermin = new Termin();
            $arr = [
                'idTer' => null,
                'korImeAgent' => $_SESSION['autor'],
                'datumVreme' => $_POST['datum']
            ];
            $noviTermin->insert($arr);
            return redirect()->to(site_url('agent/raspored'));
        }

        return view('stranice/dodavanjeNovogTerminaAgent');
    }

    // mislim da je ova metoda visak ds200012d
    public function sacuvajNoviTermin(){
        echo view("sablon/header_agent");
        return view('stranice/terminiAgenta');
    }

    /**
     * Promena lozinke agenta.
     * 
     * @return string
     */
    public function promenaLozinke(){
        helper(['form']);
        $data = [];

        if($this->request->getMethod() == 'post'){
            $rules = [
                'old' => 'required',
                'new' => 'required|min_length[6]|max_length[16]'
                ];
            
            if($this->validate($rules)){
                $db = db_connect();
                $model=new Korisnik($db);
                $k = $model->getKorisnik($_SESSION['autor']);
                $lozinka = $k->lozinka;
                if($k == null) $data['msg'] = "Korisnik ne potoji";
                if($lozinka == $_POST['old']){
                    $attr = array(
                        'korIme' => $_SESSION['autor'],
                        'email' => $k->email,
                        'lozinka' => $_POST['new'],
                        'ime' => $k->ime,
                        'prezime' => $k->prezime
                    );
                    $ime = $_SESSION['autor'];
                    $k->lozinka = $_POST['new'];
                    $model->update($ime, $attr);

                    // pravljenje obavestenja da je agent uspesno promenio lozinku
                    $obv = new Obavestenje();
                    $arr = [
                        'idOba' => null,
                        'korIme' => $_SESSION['autor'],
                        'tekst' => 'Uspesna promena lozinke.',
                        'datumVreme' => date("Y-m-d h:i:s")
                    ];
                    $obv->insert($arr);

                    return redirect()->to(site_url('agent'));
                }
                $data['msg'] = 'Pogrešna šifra!';
            }else{
                $data['validation'] = $this->validator;
            }

            
        }
        return view('stranice/promenaLozinke', $data);
    }

    /**
     * Promena informacija naloga agenta. Funkcija omogućava promenu imena, prezimena i e-pošte agenta.
     * 
     * @return string
     */
    public function promenaInformacijaNaloga(){
        
        $db = db_connect();
        $model=new CustomModel($db);
        $podaci = $model->proveriKorIme($_SESSION['autor']);
        $data['podaci'] = $podaci;

        if($this->request->getMethod() == 'post'){
            $rules = [
                // Ne trebaju polja da budu required!
                'ime' => 'required',
                'prezime' => 'required',
                'email' => 'required'
                ];
            
            if($this->validate($rules)){
                $db = db_connect();
                $model=new Korisnik($db);
                $k = $model->getKorisnik($_SESSION['autor']);
                $attr = array(
                    'korIme' => $_SESSION['autor'],
                    'email' => $_POST['email'],
                    'lozinka' => $k->lozinka,
                    'ime' => $_POST['ime'],
                    'prezime' => $_POST['prezime']
                );
                $ime = $_SESSION['autor'];
                $model1 = new Zahtev();
                $attr1 = [
                    'IdZah' => null,
                    'tipZahteva' =>2
                ];
                $model1->insert($attr1);
                $db = db_connect();
                $noviModel = new CustomModel($db);
                
                $poslednjiId = $noviModel->getLastRowZahtev()->idZah;
                
                $zahtevZaReg = new ZahtevZaRegistraciju();
                
                $attribut = [
                    'idZah' =>  $poslednjiId,
                    'korIme' => $_SESSION['autor'],
                    'email' => $_POST['email'],
                    'ime' => $_POST['ime'],
                    'prezime' => $_POST['prezime']
                    
                ];
                
                $zahtevZaReg->insert($attribut);

                // pravljenje obavestenja da je agent uspesno promenio informacije naloga
                $obv = new Obavestenje();
                    $arr = [
                        'idOba' => null,
                        'korIme' => $_SESSION['autor'],
                        'tekst' => 'Uspesna promena informacija naloga.',
                        'datumVreme' => date("Y-m-d h:i:s")
                    ];
                $obv->insert($arr);
                
                return redirect()->to(site_url('klijent'));

            }else{
                $data['validation'] = $this->validator;
            }

            
        }
        return view('stranice/promenaInformacijaNaloga', $data);
    }

    /**
     * Ispis pristiglih obaveštenja agenta.
     * 
     * @return string
     */
    public function obavestenja(){
        echo view('sablon/header_agent');
        $db = db_connect();
        $model=new CustomModel($db);
        $obavestenja = $model->dohvatiObavestenja($_SESSION['autor']);
        $data['obavestenja'] = $obavestenja;

        if($this->request->getMethod() == 'post'){
            // obrisati obavestenja za tog korisnika
            foreach($obavestenja as $o){
                // prolazimo kroz sva obavestenja i brisemo
                $modelO = new Obavestenje();
                $modelO->delete($o->idOba);
            }
            return redirect()->to(site_url($_SESSION['tip']."/obavestenja"));
        }

        return view('stranice/obavestenja', $data);
    }

    /**
     * Uporedjivanje dva oglasa. Biranjem ID-a dva oglasa
     * mou se uporediti ti oglasi.
     * 
     * @return string
     */
    function uporedjivanjeOglasa(){
        helper(['form']);
        echo view('sablon/header_agent');
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
                    if($s1->idS == 14) $data['podno2'] = 'Da';
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
                if($opstina != '0'){
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
            echo view('sablon/header_agent');
            return view('stranice/index', $data);
            
        }
        echo view('sablon/header_agent');
        return view('stranice/index', $data);
    }

}  