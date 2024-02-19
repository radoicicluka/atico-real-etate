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
use App\Models\ZahtevZaRegistraciju;
use App\Models\Klijent;
use App\Models\Agent;
use App\Models\Obavestenje;
use App\Models\Oglas;
use App\Models\OmiljeniOglas;
use App\Models\PraceniOglasi;
use App\Models\Sadrzi;
use App\Models\Termin;
use App\Models\ZahtevZaOglase;
use App\Models\Zahtev;
use DateTime;

class Admin extends BaseController
{

    /**
     * Ispis početne stranice.
     * 
     * @return void
     */
    public function index()
    {
        echo view('sablon/header_admin');
        $db = db_connect();
        $model=new CustomModel($db);
        $data['oglasi'] = $model->dohvatiSvePrihvaceneOglase();
        echo view('stranice/index', $data);
    }

    /**
     * Izlogovanje klijenta. Funckija gasi sesiju i korisnika vraća na početnu stranicu kao gosta.
     * 
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    public function izlogujSe(){
        session()->destroy();
        return redirect()->to(site_url('/'));
    }
    
    /**
     * Prikaz profila admina.
     * 
     * @return string
     */
    public function profil(){
        echo view('sablon/header_admin');
        echo view('stranice/profilAdmin');
    }

    /**
     * Ispis zahteva za licitaciju koji su stigli administratoru.
     * 
     * @return string
     */
    public function zahtevi(){
        echo view("sablon/header_admin");

        if($this->request->getMethod() == 'post'){
            // treba izbrisati tog korisnika iz liste zahteva za registraciju
            // promeniti mu aktivan na 1 / 2 u zavistnoti da li je zahtev odbijen ili odobren
            $db = db_connect();
            $model=new CustomModel($db);
            $data = $model->pristigliZahteviAdmin();
            $data1 = $model->pristigliZahteviAdminPostavljanje();
            $zar = new ZahtevZaRegistraciju();
            $zar1 = new ZahtevZaOglase();
            $zahtev = new Zahtev();
            
            if($_POST){
                for($x=0; $x < sizeof($data); $x++){
                    $z = 'zahtev_' .$x;
                    if(isset($_POST[$z])){
                        $klijent = $model->pronadjiKlijenta($data[$x]['korIme']);
                        $agnet = $model->pronadjiAgenta($data[$x]['korIme']);
                        if($model->dohvatiZahtevGdeJeIdZah1($data[$x]['idZah'])->tipZahteva == 1){
                            if($_POST[$z] == 1){
                            // prihvatio je korisnika
                            // azurira se korisnik tabela polje 'aktivan' na 1
                            if(isset($klijent)){
                                $d = [
                                    'aktivan' => 1
                                ];
                                $klj = new Klijent();
                                $klj->update($data[$x]['korIme'], $d);
                            }else{
                                $d = [
                                    'aktivan' => 1
                                ];
                                $agn = new Agent();
                                $agn->update($data[$x]['korIme'], $d);
                            }
                        }
                        elseif($_POST[$z] == 2){
                            if(isset($klijent)){
                                $d = [
                                    'aktivan' => 2
                                ];
                                $klj = new Klijent();
                                $klj->update($data[$x]['korIme'], $d);
                            }else{
                                $d = [
                                    'aktivan' => 2
                                ];
                                $agn = new Agent();
                                $agn->update($data[$x]['korIme'], $d);
                            }
                        }
                        
                        }
                        if($model->dohvatiZahtevGdeJeIdZah1($data[$x]['idZah'])->tipZahteva == 2){
                        
                        if($_POST[$z]==1){
                            $atributi = [
                                'ime' => $data[$x]['ime'],
                                'prezime' => $data[$x]['prezime'],
                                'email' => $data[$x]['email']
                            ];
                            
                            $korisnickoIme = $data[$x]['korIme'];
                            $kor = new Korisnik();
                            $kor->update($korisnickoIme,$atributi);

                            // novo obavestenje da su informacije promenjene
                            $obv = new Obavestenje();
                            $arr = [
                                'idOba' => null,
                                'korIme' => $data[$x]['korIme'],
                                'tekst' => 'Vasa promena informacija naloga je potvrdjena.',
                                'datumVreme' => date("Y-m-d h:i:s")
                            ];
                            $obv->insert($arr);
                        }
                    }
                    if($model->dohvatiZahtevGdeJeIdZah1($data[$x]['idZah'])->tipZahteva == 4){
                        
                        if($_POST[$z]==1){
                            
                            $db = db_connect();
                            $model = new CustomModel($db);
                            
                            $agencija = $model->pronadjiAgenta($data[$x]['ime'])->agencija;
                            $agent = $data[$x]['ime'];
                            
                            $noviAgent = $model->dohvatiRazlicitogAgenta($agencija, $agent)->korIme;
                            
                            $attr = [
                                'korImeAgent'=> $noviAgent
                            ];
                            
                            $ogls = new Oglas();
                            
                            $idOglasa = $data[$x]['prezime'];
                            $ogls->update($idOglasa,$attr);

                            // novo obavestenje da su informacije promenjene
                            $obv = new Obavestenje();
                            $currentTime = new DateTime(); //za trenutno vreme
                            $currentTime->modify('+2 hours');
                            $arr = [
                                'idOba' => null,
                                'korIme' => $data[$x]['korIme'],
                                'tekst' => 'Agent je uspesno promenjen.',
                                'datumVreme' => $currentTime->format('Y-m-d H:i:s')
                            ];
                            $obv->insert($arr);
                        }
                    }
                    $idZah = $model->dohvatiIDzahtevaZaRegistraciju($data[$x]['korIme']);
                        $zar->delete($idZah->idZah);
                        $zahtev->delete($idZah->idZah);                        
                    }
                }
                
                for($x=0; $x < sizeof($data1); $x++){
                    $z = 'zahtev1_' .$x;
                    if(isset($_POST[$z])){
                        $klijent = $model->pronadjiOglas($data1[$x]['idO']);
                        
                        if($_POST[$z] == 1){
                            $d = [
                                    'aktivan' => 1
                                ];
                                $klj = new Oglas();
                                $klj->update($data1[$x]['idO'], $d);

                                // novo obavestenje da je korisniku odobren oglas
                                $obv = new Obavestenje();
                                $arr = [
                                    'idOba' => null,
                                    'korIme' => $data1[$x]['korImeKlijent'],
                                    'tekst' => 'Vas oglas je odobren.',
                                    'datumVreme' => date("Y-m-d h:i:s")
                                ];
                                $obv->insert($arr);
                                
                            }
                            elseif($_POST[$z] == 2){
                                $d = [
                                    'aktivan' => 2
                                ];
                                $klj = new Oglas();
                                $klj->update($data1[$x]['idO'], $d);
                                
                                // novo obavestenje da je korisniku nije odobren oglas
                                $obv = new Obavestenje();
                                $arr = [
                                    'idOba' => null,
                                    'korIme' => $data1[$x]['korImeKlijent'],
                                    'tekst' => 'Vas oglas je odbijen.',
                                    'datumVreme' => date("Y-m-d h:i:s")
                                ];
                                $obv->insert($arr);
                        }
                        $idZah = $model->dohvatiIDzahtevaZaOglas($data1[$x]['idO']);
                        $zar1->delete($idZah->idZah);
                        $zahtev->delete($idZah->idZah);
                        
                    }
                }
            }
        }

        return view('stranice/pristigliZahtevi');
    }
    
    /**
     * Pregled informacija naloga datog korisnika.
     * 
     * @param string $id Korisničko ime
     * @return void
     */
    public function prikaziKorisnika($id){
        echo view('sablon/header_admin');
        // nije osposobljenja metoda za pregled korisnickih podataka
        $data['kor'] = $id;
        echo view('stranice/profilAgent-Admin', $data);
    }
    
    /**
     * Pregled informacija oglasa za admina.
     * 
     * @param int $id ID oglasa
     * @return void
     */
    public function prikaziOglas($id){
        echo view('sablon/header_admin');
        $data['kor'] = $id;
        echo view('stranice/profilAgent-Admin', $data);
    }
    
    /**
     * Ispis stranice oglasa.
     * 
     * @param int $idO
     * @return void
     */
    public function oglas($idO){
        echo view('sablon/header_admin');

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
     * Uklanjanje korisničkog naloga korisnika iz baze podataka.
     */
    public function uklanjanjeKorisnika(){
        echo view('sablon/header_admin');
        $db = db_connect();
        $model=new CustomModel($db);
        $sviKlijenti = $model->spajanjeSvihKlijenta();
        $sviAgenti = $model->spajanjeSvihAgenta();


        if($_POST){
            foreach($sviKlijenti as $k){
                if(isset($_POST[$k->korIme])){
                    if($_POST[$k->korIme] == 1){
                        // uklanjanje klijenta
                        
                        // ako je klijent imao oglas onda se brise oglas
                        $oglasiKlijenta = $model->spajanjeKlijentaSaNjegovimOglasom($k->korIme);
                        $zahtevReg = $model->dohvatiZahtevGdeJekorIme($k->korIme);
                        $praceni = $model->dohvatiPracene($k->korIme);
                        $lajkovani = $model->dohvatiLajkovane($k->korIme);

                        foreach($praceni as $p){
                            // brisanje liste korisnikovih pracenih oglasa 
                            $po = new PraceniOglasi();
                            $po->delete($k->korIme);
                        }
                        
                        foreach($lajkovani as $p){
                            // brisanje liste korisnikovih omiljenih oglasa
                            $po = new OmiljeniOglas();
                            $po->delete($k->korIme);
                        }

                        foreach($zahtevReg as $z){
                            // brisanje zahteva za registraciju
                            $z1 = new Zahtev();
                            $z2 = new ZahtevZaRegistraciju();
                            
                            $z1->delete(intval($z->idZah));
                            $z2->delete(intval($z->idZah));
                        }
                        foreach($oglasiKlijenta as $o){
                            // prolazak kroz svaki klijentov oglas, i brisemo tabele
                            // oglas, zahtev, zahtev_za_oglas, praceni_oglasi, omiljeni_oglasi, sadrzi
                            
                            // pravimo obavestenje za agenta da se oglas za koji je on zaduzen izbrisao
                            $obv = new Obavestenje();
                            $arr = [
                                'idOba' => null,
                                'korIme' => $o->korImeAgent,
                                'tekst' => 'Oglas za koji ste bili zaduzeni je izbrisan.',
                                'datumVreme' => date("Y-m-d h:i:s")
                            ];
                            $obv->insert($arr);

                            $poglas = $model->praceniOglasiPrekoidO($o->idO);
                            $ooglas = $model->omiljeniOglasiPrekoidO($o->idO);

                            foreach($poglas as $p){
                                $po = new PraceniOglasi();
                                $po->delete($p->korImeKlijent);
                            }
    
                            foreach($ooglas as $p){
                                $po = new OmiljeniOglas();
                                $po->delete($p->korImeKlijent);
                            }

                            $zahtev = $model->dohvatiZahtevGdeJeidO($o->idO);
                            
                            foreach($zahtev as $z){
                                $z1 = new Zahtev();
                                $z2 = new ZahtevZaOglase();

                                $z1->delete(intval($z->idZah));
                                $z2->delete(intval($z->idZah));
                            }

                            $sadrziTabela = $model->sadrziGdeImeidO($o->idO);

                            foreach($sadrziTabela as $sadrz){
                                $sdrz = new Sadrzi();
                                $sdrz->delete(intval($o->idO));
                            }

                            $ogls = new Oglas();
                            $ogls->delete(intval($o->idO));
                        }  
                        $agnt = new Korisnik();
                        $agnt->delete($k->korIme);
                        $agnt = new Klijent();
                        $agnt->delete($k->korIme);
                    }
                }
            }
            foreach($sviAgenti as $k){
                if(isset($_POST[$k->korIme])){
                    if($_POST[$k->korIme] == 1){
                        // dohvatamo sve oglase za koje je agent zaduzen
                        // brisemo ga iz tih oglasa i 'dodeljujemo novog agenta'
                        
                        // echo "<pre>";
                        // print_r($noviAgent);
                        // echo "</pre>";
                        
                        $agOglasi = $model->agentoviOglasi($k->korIme); 
                        // brisanje agenta iz njegovih zaduzenih oglasa
                        $agenti = $model->spajanjeSvihAgentaIzIsteAgencije($k->agencija);
                            
                            
                        foreach($agOglasi as $ao){
                            // za svaki oglas od ovog agenta brisemo ga iz tog oglasa i dohvatamo novog
                            if(sizeof($agenti)>1){
                                $noviAgent = $model->dohvatiRazlicitogAgenta($k->agencija, $k->korIme);
                                $ogls = new Oglas();
                                $arr = [
                                    'korImeAgent' => $noviAgent->korIme,
                                ];
                                $ogls->update($ao->idO, $arr);
                            }else{
                                $ogls = new Oglas();
                                $arr = [
                                    'korImeAgent' => null,
                                    'aktivan' => 0
                                ];
                                
                                $ogls->update($ao->idO, $arr);
                            }
                            
                        }
                        //brisanje agentovih termina
                        $termini = $model->agentoviTermini($k->korIme);
                        foreach($termini as $t){
                            $obv = new Obavestenje();
                            $arr = [
                                'idOba' => null,
                                'korIme' => $t->korImeKlijent,
                                'tekst' => 'Termin koji ste zakazali je obrisan.',
                                'datumVreme' => date("Y-m-d h:i:s")
                            ];
                            $obv->insert($arr);
                            $ter = new Termin();
                            $ter->delete(intval($t->idTer));
                        }

                        // brisanje zahteva za registraciju agenta
                        $zahtevReg = $model->dohvatiZahtevGdeJekorIme($k->korIme);
                        foreach($zahtevReg as $z){
                            // brisanje zahteva za registraciju
                            $z1 = new Zahtev();
                            $z2 = new ZahtevZaRegistraciju();
                            
                            $z1->delete(intval($z->idZah));
                            $z2->delete(intval($z->idZah));
                        }

                        // ukloni korisnika
                        $agnt = new Korisnik();
                        $agnt->delete($k->korIme);
                        $agnt = new Agent();
                        $agnt->delete($k->korIme);
                        
                    }
                }
            }
        }
        // treba dodati obavestenja kad se neki korisnik izbrise, a ima postavljen oglas ili zaduzen oglas!

        echo view('stranice/uklanjanjeKorisnikaAdmin');
    }
    
    /**
     * Promena lozinke administratora.
     * 
     * @return string
     */
    public function promenaLozinke(){
        $data['kor'] = 'admin';
        echo view('stranice/promenaLozinke',$data);
    }

    /**
     * Promena informacija naloga administratora. Funkcija omogućava promenu imena, prezimena i e-pošte agenta.
     * 
     * @return string
     */
    public function promenaInfNaloga(){
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
                $model->update($ime, $attr);
                return redirect()->to(site_url('admin'));
            }else{
                $data['validation'] = $this->validator;
            }
        }
        return view('stranice/promenaInformacijaNaloga', $data);
    }

    /**
     * Uklanjanje oglasa iz baze podataka.
     * 
     * @return string
     */
    public function brisanjeOglasa(){
        echo view('sablon/header_admin');
        $db = db_connect();
        $model=new CustomModel($db);
        $oglasi = $model->dohvatiSveOglase();
        $data['oglasi'] = $oglasi;

        if($_POST){       
            foreach($oglasi as $o){
                if(isset($_POST['oglas_'.$o->idO])){
                    $obv = new Obavestenje();
                    $arr = [
                        'idOba' => null,
                        'korIme' => $o->korImeKlijent,
                        'tekst' => 'Vas oglas je obrisan.',
                        'datumVreme' => date("Y-m-d h:i:s")
                    ];
                    $obv->insert($arr);
                    $obv1 = new Obavestenje();
                    $arr = [
                        'idOba' => null,
                        'korIme' => $o->korImeAgent,
                        'tekst' => 'Oglas za koji ste vi zaduzeni je obrisan.',
                        'datumVreme' => date("Y-m-d h:i:s")
                    ];
                    $obv1->insert($arr);

                    $poglas = $model->praceniOglasiPrekoidO(intval($o->idO));
                    $ooglas = $model->omiljeniOglasiPrekoidO(intval($o->idO));

                    foreach($poglas as $p){
                        $po = new PraceniOglasi();
                        $trenutni = [
                            'korImeKlijent' => $p->korImeKlijent,
                            'idO' => $p->idO
                        ];
                        $po->where($trenutni)->delete();
                    }

                    foreach($ooglas as $p){
                        $po = new OmiljeniOglas();
                        $trenutni = [
                            'korImeKlijent' => $p->korImeKlijent,
                            'idO' => $p->idO
                        ];
                        $po->where($trenutni)->delete();
                    }

                    $zahtev = $model->dohvatiZahtevGdeJeidO(intval($o->idO));
                    
                    foreach($zahtev as $z){
                        $z1 = new Zahtev();
                        $z2 = new ZahtevZaOglase();

                        $z1->delete(intval($z->idZah));
                        $z2->delete(intval($z->idZah));
                    }

                    $sadrziTabela = $model->sadrziGdeImeidO($o->idO);

                    foreach($sadrziTabela as $sadrz){
                        $sdrz = new Sadrzi();
                        $sdrz->delete(intval($o->idO));
                    }

                    $ogls = new Oglas();
                    $ogls->delete(intval($o->idO));
                }
            }
        }

        $oglasi = $model->dohvatiSveOglase();
        $data['oglasi'] = $oglasi;

        return view('stranice/pregledOglasaAdmin', $data);
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
            echo view('sablon/header_admin');
            return view('stranice/index', $data);
            
        }
        echo view('sablon/header_admin');
        return view('stranice/index', $data);
    }

}  