<?php namespace App\Controllers;
/**
 * Luka Radoičić 2020/0085
 * Bora Miletić 2020/0319
 * Nikola Lazić 2020/0318
 * Stefan Dumić 2020/0012
 */
use App\Models\CustomModel;
use App\Models\Korisnik;
use App\Models\Obavestenje;
use App\Models\Oglas;
use App\Models\Sadrzi;
use App\Models\Zahtev;
use App\Models\ZahtevZaOglase;
use App\Models\ZahtevZaRegistraciju;
use App\Models\OmiljeniOglas;
use App\Models\PraceniOglasi;
use App\Models\ZahtevZaLicitaciju;
use App\Models\Licitacija;
use App\Models\Termin;

/**
 * Klijent - kontroler klasa za rad sa klijentom
 * 
 * @version 1.0
 */
class Klijent extends BaseController
{
    /**
     * Ispis početne stranice.
     * 
     * @return void
     */
    public function index()
    {
        echo view('sablon/header_klijent');
        $db = db_connect();
        $model=new CustomModel($db);
        $data['oglasi'] = $model->dohvatiSvePrihvaceneOglase();
        echo view('stranice/index', $data);
    }

    /**
     * Izlogovanje klijenta. Funckija gasi sesiju i korisnika vraća na početnu stranicu kao gosta.
     * 
     * @return string
     */
    public function izlogujSe(){
        session()->destroy();
        return redirect()->to(site_url('/'));
    }

    /**
     * Ispis pristiglih obaveštenja klijenta.
     * 
     * @return string
     */
    public function obavestenja(){
        echo view('sablon/header_klijent');
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
     * Prikaz profila klijenta.
     * 
     * @return string
     */
    public function profil(){
        echo view('sablon/header_klijent');
        echo view('stranice/profilKlijent');
    }

    /**
     * Postavljanje oglasa od strane klijenta.
     * 
     * @return string
     */
    public function postaviOglas(){
        echo view('sablon/header_klijent');
        helper('form');
        $data = [];
        
        if($this->request->getMethod() == 'post'){
            $rules = [
                    'naziv' => 'required',
                    'cena' => 'required',
                    'grad' => 'required',
                    'adresa' => 'required',
                    'kvadratura' => 'required',
                    'brojSoba' => 'required',
                    'opis' => 'required|min_length[20]|max_length[1000]',
                    'opstina' => 'required',
                    'grejanje' => 'required',
                    'agencija' => 'required',
                    'images' => [
                        'rules' => 'uploaded[images.0]|ext_in[images.0,jpg,jpeg,png]',
                        'label' => 'images'
                    ]                  
                ];
            if($this->validate($rules)){
                // dodati novi oglas 
                // dodati sve dodatne specifikacije u tabelu sadrzi za tad idO
                
                $ogl = new Oglas();
                $zah = new Zahtev();
                $zahOgl = new ZahtevZaOglase();
                
                
                $agenc ='';
                switch($_POST['agencija']){
                    case 1:
                        $agenc = 'Lux.com';
                        break;
                    case 2:
                        $agenc = 'Diamond';
                        break;
                    case 3:
                        $agenc = 'Metropolitan';
                        break;
                    case 4:
                        $agenc = 'Kosmopolis';
                        break;
                }
                $db = db_connect();
                $model=new CustomModel($db);
                
                if($model->najmanjeOglasa($agenc) != null){
                    
                    if($model->checkUsersExistInOtherTable($agenc)===1){
                        $korMin = $model->najmanjeOglasa($agenc)->korImeAgent;
                        $arr = [
                        'idO' => null,
                        'korImeKlijent' => $_SESSION['autor'],
                        'korImeAgent' => $korMin,
                        "naziv" => $_POST['naziv'],
                        "cena" => $_POST['cena'],
                        "grad" => $_POST['grad'],
                        "adresa" => $_POST['adresa'],
                        "kvadratura" => $_POST['kvadratura'],
                        "brSoba" => $_POST['brojSoba'],
                        "opis" => $_POST['opis'],
                        "opstina" => $_POST['opstina'],
                        "grejanje" => $_POST['grejanje'],
                        "aktivan" => 0,
                        "prodat" => 0,
                        "agencija" => $agenc
                    ];
                    }else{
                        $korisnik = $model->korisnikKojiNijeUDrugojTabeli($agenc)->korIme;
                        $arr = [
                        'idO' => null,
                        'korImeKlijent' => $_SESSION['autor'],
                        'korImeAgent' => $korisnik,
                        "naziv" => $_POST['naziv'],
                        "cena" => $_POST['cena'],
                        "grad" => $_POST['grad'],
                        "adresa" => $_POST['adresa'],
                        "kvadratura" => $_POST['kvadratura'],
                        "brSoba" => $_POST['brojSoba'],
                        "opis" => $_POST['opis'],
                        "opstina" => $_POST['opstina'],
                        "grejanje" => $_POST['grejanje'],
                        "aktivan" => 0,
                        "prodat" => 0,
                        "agencija" => $agenc
                    ];
                                
                    }
                    
                }else{
                    $agent = $model->dohvatiAgenciju($agenc)->korIme;
                    $arr = [
                    'idO' => null,
                    'korImeKlijent' => $_SESSION['autor'],
                    'korImeAgent' => $agent,
                    "naziv" => $_POST['naziv'],
                    "cena" => $_POST['cena'],
                    "grad" => $_POST['grad'],
                    "adresa" => $_POST['adresa'],
                    "kvadratura" => $_POST['kvadratura'],
                    "brSoba" => $_POST['brojSoba'],
                    "opis" => $_POST['opis'],
                    "opstina" => $_POST['opstina'],
                    "grejanje" => $_POST['grejanje'],
                    "aktivan" => 0,
                    "prodat" => 0,
                    "agencija" => $agenc
                    
                ];
                }
                
                $arr1 = [
                    'idZah' => null,
                    'tipZahteva' => 0
                ];
                
                $oog = $ogl->insert($arr);
                $var = strval($oog);
                if ($imagefile = $this->request->getFiles()) {
                    $i = 1;
                    foreach ($imagefile['images'] as $img) {
                        if ($img->isValid() && !$img->hasMoved()) {
                            $img->move('./uploads/oglas'.$var, 'slika'.$i++. '.' . $img->getExtension());
                        }
                    }
                }
                
                $zah->insert($arr1);
                $db = db_connect();
                $model = new CustomModel($db);
                $idOglasa = $model->getLastRowOglas()->idO;
                $idZahteva = $model->getLastRowZahtev()->idZah;
                
                $arr2 =[
                    'idZah' => $idZahteva,
                    'idO' => $idOglasa
                ];
                
                $zahOgl->insert($arr2);
                // dodati sve dodatne spec u tableu sadrzi 
                if(isset($_POST['sank'])){
                    $d = [ 
                        'idS' => 1,
                        'idO' => $oog
                    ];
                    $sad = new Sadrzi();
                    $sad->insert($d);  
                }
                if(isset($_POST['Prozor_u_kuhinji'])){
                    $d = [ 
                        'idS' => 2,
                        'idO' => $oog
                    ];
                    $sad = new Sadrzi();
                    $sad->insert($d);  
                } 
                if(isset($_POST['Prozor_u_kupatilu'])){
                    $d = [ 
                        'idS' => 3,
                        'idO' => $oog
                    ];
                    $sad = new Sadrzi();
                    $sad->insert($d);  
                } 
                if(isset($_POST['Garaza'])){
                    $d = [ 
                        'idS' => 4,
                        'idO' => $oog
                    ];
                    $sad = new Sadrzi();
                    $sad->insert($d);  
                } 
                if(isset($_POST['Lift'])){
                    $d = [ 
                        'idS' => 5,
                        'idO' => $oog
                    ];
                    $sad = new Sadrzi();
                    $sad->insert($d);  
                } 
                if(isset($_POST['Podrum'])){
                    $d = [ 
                        'idS' => 6,
                        'idO' => $oog
                    ];
                    $sad = new Sadrzi();
                    $sad->insert($d);  
                } 
                if(isset($_POST['Obezbedjenje'])){
                    $d = [ 
                        'idS' => 7,
                        'idO' => $oog
                    ];
                    $sad = new Sadrzi();
                    $sad->insert($d);  
                } 
                if(isset($_POST['Video_nadzor'])){
                    $d = [ 
                        'idS' => 8,
                        'idO' => $oog
                    ];
                    $sad = new Sadrzi();
                    $sad->insert($d);  
                } 
                if(isset($_POST['Interfon'])){
                    $d = [ 
                        'idS' => 9,
                        'idO' => $oog
                    ];
                    $sad = new Sadrzi();
                    $sad->insert($d);  
                } 
                if(isset($_POST['Bazen'])){
                    $d = [ 
                        'idS' => 10,
                        'idO' => $oog
                    ];
                    $sad = new Sadrzi();
                    $sad->insert($d);  
                } 
                if(isset($_POST['Dvoriste'])){
                    $d = [ 
                        'idS' => 11,
                        'idO' => $oog
                    ];
                    $sad = new Sadrzi();
                    $sad->insert($d);  
                } 
                if(isset($_POST['Terasa'])){
                    $d = [ 
                        'idS' => 12,
                        'idO' => $oog
                    ];
                    $sad = new Sadrzi();
                    $sad->insert($d);  
                } 
                if(isset($_POST['Klima_uredjaj'])){
                    $d = [ 
                        'idS' => 13,
                        'idO' => $oog
                    ];
                    $sad = new Sadrzi();
                    $sad->insert($d);  
                } 
                if(isset($_POST['Podno_grejanje'])){
                    $d = [ 
                        'idS' => 14,
                        'id0' => $oog
                    ];
                    $sad = new Sadrzi();
                    $sad->insert($d);  
                } 
                if(isset($_POST['Opremljen'])){
                    $d = [ 
                        'idS' => 15,
                        'idO' => $oog
                    ];
                    $sad = new Sadrzi();
                    $sad->insert($d);  
                } 
                if(isset($_POST['Optika'])){
                    $d = [ 
                        'idS' => 16,
                        'idO' => $oog
                    ];
                    $sad = new Sadrzi();
                    $sad->insert($d);  
                }
                return redirect()->to(site_url('klijent'));
            }else{
                $data['msg'] = "Fajlovi ne smeju imati specijalne karaktere kao i space!";
                $data['validation'] = $this->validator;
            }
        }
        return view('stranice/postavljanjeOglasa',$data);
    }

    /**
     * Pregled omiljenih oglasa klijenta.
     * 
     * @return void
     */
    public function omiljeniOglasi(){
        echo view('sablon/header_klijent');
        $data['littleTitle'] = "Omiljeni oglasi";
        $db = db_connect();
        $model=new CustomModel($db);
        $korisnik = $_SESSION['autor'];
        $data['oglasi'] = $model->dohvatiLajkovane($korisnik);
        echo view('stranice/pregledOglasaKlijent',$data);
        
    }

    /**
     * Pregled praćenih oglasa klijenta.
     * 
     * @return void
     */
    public function praceniOglasi(){
        echo view('sablon/header_klijent');
        $data['littleTitle'] = "Praćeni oglasi";
        $db = db_connect();
        $model=new CustomModel($db);
        $korisnik = $_SESSION['autor'];
        $data['oglasi'] = $model->dohvatiPracene($korisnik);    
        echo view('stranice/pregledOglasaKlijent',$data);
    }

    /**
     * Pregled oglasa koje je postavio klijent.
     * 
     * @return void
     */
    public function postavljeniOglasi(){
        echo view('sablon/header_klijent');
        $db = db_connect();
        $model=new CustomModel($db);
        $oglasi = $model->klijentoviOglasi($_SESSION['autor']);
        $data['oglasi'] = $oglasi;
        echo view('stranice/pregledKlijentovihPostavljenihOglasa', $data);
    }

    /**
     * Promena lozinke klijenta.
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
                    // obavestenje da je klijent uspesno promenio lozinku
                    $obv = new Obavestenje();
                    $arr = [
                        'idOba' => null,
                        'korIme' => $_SESSION['autor'],
                        'tekst' => 'Uspesna promena lozinke.',
                        'datumVreme' => date("Y-m-d h:i:s")
                    ];
                    $obv->insert($arr);
                    return redirect()->to(site_url('klijent'));
                }
                $data['msg'] = 'Pogrešna šifra!';
            }else{
                $data['validation'] = $this->validator;
            }
        }
        return view('stranice/promenaLozinke', $data);
    }

    /**
     * Promena informacija naloga klijenta. Funkcija omogućava promenu imena, prezimena i e-pošte agenta.
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
     * Menjanje informacija oglasa koji je postavio dati klijent.
     * 
     * @param int $idO
     * @return string
     */
    public function promenaInformacijaOglasa($idO){
        echo view('sablon/header_klijent');
        $oglas = new Oglas();
        $oglas = $oglas->where('idO',$idO)->where('korImeKlijent', $_SESSION['autor'])->get()->getRow();
        if(empty($oglas)){
            return redirect()->to(site_url('klijent/profil'));
        }
        $data['oglas'] = $oglas;
        if($_POST){
            // azuriraj informacije oglasa
            $ogls = new Oglas();
            $arr = [
                'naziv' => $_POST['naziv'],
                'cena' => $_POST['cena'],
                'opis' => $_POST['opis']
            ];
            $ogls->update($idO, $arr);
            // izbrisi sve vec postojece dodatne specifikacije
            $db = db_connect();
            $model = new CustomModel($db);
            $sadrziTabela = $model->sadrziGdeImeidO($idO);
            foreach($sadrziTabela as $sadrz){
                $sdrz = new Sadrzi();
                $sdrz->delete(intval($idO));
            }
            // azuriraj dodatne specifikacije
            if(isset($_POST['sank'])){
                $d = [ 
                    'idS' => 1,
                    'idO' => $idO
                ];
                $sad = new Sadrzi();
                $sad->insert($d);  
            }
            if(isset($_POST['Prozor_u_kuhinji'])){
                $d = [ 
                    'idS' => 2,
                    'idO' => $idO
                ];
                $sad = new Sadrzi();
                $sad->insert($d);  
            } 
            if(isset($_POST['Prozor_u_kupatilu'])){
                $d = [ 
                    'idS' => 3,
                    'idO' => $idO
                ];
                $sad = new Sadrzi();
                $sad->insert($d);  
            } 
            if(isset($_POST['Garaza'])){
                $d = [ 
                    'idS' => 4,
                    'idO' => $idO
                ];
                $sad = new Sadrzi();
                $sad->insert($d);  
            } 
            if(isset($_POST['Lift'])){
                $d = [ 
                    'idS' => 5,
                    'idO' => $idO
                ];
                $sad = new Sadrzi();
                $sad->insert($d);  
            } 
            if(isset($_POST['Podrum'])){
                $d = [ 
                    'idS' => 6,
                    'idO' => $idO
                ];
                $sad = new Sadrzi();
                $sad->insert($d);  
            } 
            if(isset($_POST['Obezbedjenje'])){
                $d = [ 
                    'idS' => 7,
                    'idO' => $idO
                ];
                $sad = new Sadrzi();
                $sad->insert($d);  
            } 
            if(isset($_POST['Video_nadzor'])){
                $d = [ 
                    'idS' => 8,
                    'idO' => $idO
                ];
                $sad = new Sadrzi();
                $sad->insert($d);  
            } 
            if(isset($_POST['Interfon'])){
                $d = [ 
                    'idS' => 9,
                    'idO' => $idO
                ];
                $sad = new Sadrzi();
                $sad->insert($d);  
            } 
            if(isset($_POST['Bazen'])){
                $d = [ 
                    'idS' => 10,
                    'idO' => $idO
                ];
                $sad = new Sadrzi();
                $sad->insert($d);  
            } 
            if(isset($_POST['Dvoriste'])){
                $d = [ 
                    'idS' => 11,
                    'idO' => $idO
                ];
                $sad = new Sadrzi();
                $sad->insert($d);  
            } 
            if(isset($_POST['Terasa'])){
                $d = [ 
                    'idS' => 12,
                    'idO' => $idO
                ];
                $sad = new Sadrzi();
                $sad->insert($d);  
            } 
            if(isset($_POST['Klima_uredjaj'])){
                $d = [ 
                    'idS' => 13,
                    'idO' => $idO
                ];
                $sad = new Sadrzi();
                $sad->insert($d);  
            } 
            if(isset($_POST['Podno_grejanje'])){
                $d = [ 
                    'idS' => 14,
                    'id0' => $idO
                ];
                $sad = new Sadrzi();
                $sad->insert($d);  
            } 
            if(isset($_POST['Opremljen'])){
                $d = [ 
                    'idS' => 15,
                    'idO' => $idO
                ];
                $sad = new Sadrzi();
                $sad->insert($d);  
            } 
            if(isset($_POST['Optika'])){
                $d = [ 
                    'idS' => 16,
                    'idO' => $idO
                ];
                $sad = new Sadrzi();
                $sad->insert($d);  
            }
            // obavestiti sve korisnike koji prate oglas da su informacije promenje 
            //dohvati sve korisnike koji prate oglas
            $kor = $model->dohvatiPraceneidO($idO);
            foreach($kor as $k){
                $obv = new Obavestenje();
                $arr = [
                    'idOba' => null,
                    'korIme' => $k->korImeKlijent,
                    'tekst' => 'Oglas ID='. $idO .' koji pratite je izmenjen.',
                    'datumVreme' => date("Y-m-d h:i:s")
                ];
                $obv->insert($arr);
            }
            return redirect()->to(site_url('klijent/profil'));
        }
        return view('stranice/promenaInformacijaOglasa',$data);
    }
    
    /**
     * Prelazak klijenta na formu za početne informacije za licitaciju oglasa.
     * 
     * @param int $idO
     * @return void
     */
    public function pokreniLicitaciju($idO){
        echo view('sablon/header_klijent');
        $data['idO'] = $idO;
        echo view('stranice/formaZaLicitaciju', $data);
    }

    /**
     * Slanje zahteva agentu za pokretanje licitacije nad postavljenim oglasom.
     * 
     * @param int $idO
     * @return string
     */
    public function posaljiZahtevZaLicitaciju($idO){
        echo view('sablon/header_klijent');
        $db = db_connect();
        if($this->request->getMethod() == 'post'){
            $rules = [
                'datum' => 'required',
                'vreme' => 'required',
                'cena' => 'required'
            ];

            if($this->validate($rules)){
                
                $model = new Zahtev($db);
                $zahtev = [
                    'IdZah' => null,
                    'tipZahteva' => 5
                ];
                $model->insert($zahtev);
    

                $model = new CustomModel($db); 
                $idZah = $model->getLastRowZahtev()->idZah;


                $model= new ZahtevZaLicitaciju($db);
                $datum = $_POST['datum'];
                $vreme = $_POST['vreme'];
                $zahtev = [
                    'idZah' => $idZah,
                    'idO' => $idO,
                    'datum' => $datum." ".$vreme,
                    'cena' => $_POST['cena']
                ];
                $model->insert($zahtev);

                return redirect()->to(site_url('klijent/postavljeniOglasi'));
            }else{
                $data['validation'] = $this->validator;
            }
            
        }
        // $data['datum'] = $_POST['datum'];
        // $data['vreme'] = $_POST['vreme'];

        return view('stranice/formaZaLicitaciju', $data);
    }

    /**
     * Ispis stranice oglasa za klijenta.
     * 
     * @param int $idO
     * @return void
     */
    public function oglas($idO){
        echo view('sablon/header_klijent');
        $db = db_connect();
        $model=new Oglas($db);
        $k = $model->getOglas($idO);
        $data['oglas'] = $k;
        // print_r($k->cena);

        //provera lajkovanih
        $model=new CustomModel($db);
        $korisnik = $_SESSION['autor'];
        $listaLajkovanih = $model->dohvatiLajkovane($korisnik);
        $data['lajkovan'] = false; 
        foreach($listaLajkovanih as $oglas) {
            if($oglas->idO == $idO){
                $data['lajkovan'] = true;
                break; 
            }
        }

        //provera pracenih
        $model=new CustomModel($db);
        $korisnik = $_SESSION['autor'];
        $listaLajkovanih = $model->dohvatiPracene($korisnik);
        $data['pracen'] = false; 
        foreach($listaLajkovanih as $oglas) {
            if($oglas->idO == $idO){
                $data['pracen'] = true;
                break; 
            }
        }


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
        if($_POST){
            if(isset($_POST['promenaAgenta'])){
                    $db = db_connect();
                    $model = new CustomModel($db);
                    $ogls = $model->oglasPrekoidO1($idO);
                    $agenti = $model->spajanjeSvihAgentaIzIsteAgencije($ogls->agencija);

                    if(sizeof($agenti) >1){ 
                        $zahtev = new Zahtev();
                        $info = [
                            'idZah' => null,
                            'tipZahteva' => 4
                        ];
                        $zahtev->insert($info);

                        $zahtevZaReg = new ZahtevZaRegistraciju();
                        $info1 = [
                            'idZah' =>$model->getLastRowZahtev()->idZah,
                            'korIme' => $_SESSION['autor'],
                            'ime' => $ogls->korImeAgent,
                            'prezime' => $idO
                        ];
                        $zahtevZaReg->insert($info1);
                        $data['msg'] = 'Uspesno poslat zahtev za promenu agenta!';
                    }else{
                        $data['msg'] = 'Nije moguce poslati zahtev za promenu agenta!';
                    }
                }
            }
        echo view('stranice/oglas',$data);
    }

    /**
     * Uporedjivanje dva oglasa. Biranjem ID-a dva oglasa
     * mou se uporediti ti oglasi.
     * 
     * @return string
     */
    function uporedjivanjeOglasa(){
        helper(['form']);
        echo view('sablon/header_klijent');
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
            echo view('sablon/header_klijent');
            return view('stranice/index', $data);
            
        }
        echo view('sablon/header_klijent');
        return view('stranice/index', $data);
    }

    /**
     * Lajkovanje oglasa čime se on čuva u listi klijentovih lajkovanih oglasa.
     * 
     * @param int $idO
     * @return string
     */
    function lajkujOglas($idO) {
        $db = db_connect();
        $model=new CustomModel($db);
        $korisnik = $_SESSION['autor'];
        $listaLajkovanih = $model->dohvatiLajkovane($korisnik);
        $data['lajkovan'] = false; 
        foreach($listaLajkovanih as $oglas) {
            if($oglas->idO == $idO){
                $data['lajkovan'] = true;
                break; 
            }
        }
        $trenutni = [
            'korImeKlijent' => $korisnik,
            'idO' => $idO
        ];
        $d = new OmiljeniOglas();
        if($data['lajkovan'] == false) { //ako nije lajkovan, ubaci u listu lajkovanih
            $d->insert($trenutni);
            $data['lajkovan'] = true;
        } else {
            $d->where($trenutni)->delete();
            $data['lajkovan'] = false; 
        }
        $model = new Oglas($db);
        $oglas = $model->getOglas($idO);
        $data['oglas'] = $oglas;

        //provera pracenih
        $model=new CustomModel($db);
        $korisnik = $_SESSION['autor'];
        $listaLajkovanih = $model->dohvatiPracene($korisnik);
        $data['pracen'] = false; 
        foreach($listaLajkovanih as $oglas) {
            if($oglas->idO == $idO){
                $data['pracen'] = true;
                break; 
            }
        }
        
        //prosledjivanje dodatnih specifikacija
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
        echo view('sablon/header_klijent');
        return view('stranice/oglas', $data);
    }

    /**
     * Praćenje oglasa čime se on čuva u listi klijentovih praćeih oglasa.
     * Klijent dobija obaveštenje pri svakoj promeni praćenog oglasa.
     * 
     * @param int $idO
     * @return string
     */
    function pratiOglas($idO) {
        $db = db_connect();
        $model=new CustomModel($db);
        $korisnik = $_SESSION['autor'];
        $listaLajkovanih = $model->dohvatiPracene($korisnik);
        $data['pracen'] = false; 
        foreach($listaLajkovanih as $oglas) {
            if($oglas->idO == $idO){
                $data['pracen'] = true;
                break; 
            }
        }
        $trenutni = [
            'korImeKlijent' => $korisnik,
            'idO' => $idO
        ];
        $d = new PraceniOglasi();
        if($data['pracen'] == false) { //ako nije pracen, ubaci u listu pracenih
            $d->insert($trenutni);
            $data['pracen'] = true;
        } else {
            $d->where($trenutni)->delete();
            $data['pracen'] = false; 
        }
        $model = new Oglas($db);
        $oglas = $model->getOglas($idO);
        $data['oglas'] = $oglas;

        //provera lajkovanih
        $model=new CustomModel($db);
        $korisnik = $_SESSION['autor'];
        $listaLajkovanih = $model->dohvatiLajkovane($korisnik);
        $data['lajkovan'] = false; 
        foreach($listaLajkovanih as $oglas) {
            if($oglas->idO == $idO){
                $data['lajkovan'] = true;
                break; 
            }
        }
        
        //prosledjivanje dodatnih specifikacija
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
        echo view('sablon/header_klijent');
        return view('stranice/oglas', $data);
    }

    /**
     * Klijent licitira oglas koji je na licitaciji.
     * 
     * @param int $idO
     * @return void
     */
    function ponudaZaLicitaciju($idO) {
        //update licitacije
        if($this->request->getMethod() == 'post') {
            $db = db_connect();
            $model = new Licitacija();
            $licitacija =  $model->dohvatiLicitaciju($idO);
            $attr = array(
                'idLic' => $licitacija->idLic,
                'korImeKlijent' => $_SESSION['autor'],
                'idO' => $idO,
                'trenutnaCena' => $_POST['ponuda'],
                'vremeKraj' => $licitacija->vremeKraj
            );
            $model->update($licitacija->idLic, $attr);
        }
        $this->oglas($idO);
    }

    /**
     * Zakazivanje termin za razgledanje nekretnine sa agentom zaduženim za dati oglas.
     * 
     * @param int $idO
     * @return void
     */
    function zakaziTermin($idO) {
        if($this->request->getMethod() == 'post') {
            $db = db_connect();
            $model = new CustomModel($db);
            $termin = $model->dohvatiTermin($_POST['termin']);
            $novi = new Termin();
            $attr = array(
                'idTer' => $termin->idTer,
                'korImeKlijent' => $_SESSION['autor'],
                'korImeAgent' => $termin->korImeAgent,
                'datumVreme' => $termin->datumVreme,
                'idO' => $idO
            );
            $novi->update($termin->idTer, $attr);
        }
        $this->oglas($idO);
    }
} 
