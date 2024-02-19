<?php namespace App\Models;
    /**
     * Luka Radoičić 2020/0085
     * Bora Miletić 2020/0319
     * Nikola Lazić 2020/0318
     * Stefan Dumić 2020/0012
     */
    use CodeIgniter\Database\ConnectionInterface;
    
    
    /**
    * CustomModel - model za rad sa svim tabelama u bazi
    * 
    * @version 1.0
    */
    class CustomModel{
        
        protected $db;
        
        public function __construct(ConnectionInterface &$db) {
            $this->db =& $db;
        }
        
        function getTable(){
            $posts = $this->db->table('korisnik')->get()->getResult();
            return $posts;
        }
        
        function where(){
            return $this->db->table('oglas')
                                ->where(['idO <=' => 4])
                                ->where(['idO >=' => 2])
                                ->orderBy('idO', SORT_ASC)
                                ->get()
                                ->getResult();
                                //->getRow();
        }
        function where1(){
            return $this->db->table('oglas')
                ->where('korImeAgent', 'lukka')
                ->get()
                ->getResult();
        }
        function join(){ //spajanje dve tabele 
            return $this->db->table('oglas')
                        ->where('idO >', 1)
                        ->where('idO <', 5)
                        ->join('agent','oglas.korImeAgent = agent.korIme')
                        ->get()
                        ->getResult();
        }
        function like() { 
            return $this->db->table('oglas')
                        ->like('opis', 'mlade')
                        ->get()
                        ->getResult();
        }
        function grouping(){ 
            return $this->db->table('oglas')
            ->groupStart()
            ->where('korImeAgent', 'lukka')
            ->groupEnd()
            ->limit(5)
            ->get()
            ->getResult();
        }
        /**
         * Dovatanje korisnika koristeći e-poštu i lozinku
         * 
         * @param string $par1 E-pošta
         * @param string $par2 Lozinka
         * @return object
         */
        function pronadjiKorisnika($par1,$par2){
            return $this->db->table('korisnik')
                ->where('email', $par1)
                ->where('lozinka',$par2)
                ->get()
                ->getRow();
        }
        /**
         * Dovatanje klijenta koristeći korIme
         * 
         * @param string $par1 Korisničko ime
         * @return object
         */
        function pronadjiKlijenta($par1){
            return $this->db->table('klijent')
                ->where('korIme', $par1)
                ->get()
                ->getRow();
        }
        /**
         * Dovatanje oglasa koristeći ID oglasa
         * 
         * @param int $par1 ID oglasa
         * @return object
         */
          function pronadjiOglas($par1){
            return $this->db->table('oglas')
                ->where('idO', $par1)
                ->get()
                ->getRow();
        }
        /**
         * Dovatanje agenta koristeći korIme
         * 
         * @param string $par1 Korisničko ime
         * @return object
         */
        function pronadjiAgenta($par1){
            return $this->db->table('agent')
                ->where('korIme', $par1)
                ->get()
                ->getRow();
        }
        function proveriKorIme($par){
            return $this->db->table('korisnik')
                ->where('korIme', $par)
                ->get()
                ->getRow();
        }
        function proveriemail($par){
            return $this->db->table('korisnik')
                ->where('email', $par)
                ->get()
                ->getRow();
        }
        /**
         * Dovatanje zahteva admina
         * 
         * @return array
         */
        function pristigliZahteviAdmin(){
            return $this->db->table('zahtev_za_registraciju')
                ->orderBy('idZah', SORT_ASC)
                ->get()
                ->getResultArray();
        }
        /**
         * Dovatanje zahteva agenta
         * 
         * @return array
         */
        function pristigliZahteviAgent(){
            return $this->db->table('zahtev_za_licitaciju')
                ->orderBy('idZah', SORT_ASC)
                ->get()
                ->getResultArray();
        }
            
        function pristigliZahteviAdminPostavljanje(){
            return $this->db->table('zahtev_za_oglase')
                ->join('oglas','zahtev_za_oglase.idO = oglas.idO')
                ->orderBy('idZah', SORT_ASC)
                ->get()
                ->getResultArray();
        }
        function dohvatiIDzahtevaZaRegistraciju($korIme){
            return $this->db->table('zahtev_za_registraciju')
                ->where('korIme', $korIme)
                ->get()
                ->getRow();
        }
        function dohvatiIDzahtevaZaOglas($idOglasa){
            return $this->db->table('zahtev_za_oglase')
                ->where('idO', $idOglasa)
                ->get()
                ->getRow();
        }
        /**
         * Dohvatanje lajkovanih oglasa korisnika 
         * @param String $korisnik
         * @return array
         */
        function dohvatiLajkovane($korisnik){
            return $this->db->table('omiljeni_oglas')
                ->join('oglas','omiljeni_oglas.idO = oglas.idO')
                ->where('omiljeni_oglas.korImeKlijent', $korisnik)
                ->get()
                ->getResult();
        }
        /**
         * Dohvatanje pracenih oglasa korisnika 
         * @param String $korisnik
         * @return array
         */
        function dohvatiPracene($korisnik){
            return $this->db->table('praceni_oglasi')
                ->join('oglas','praceni_oglasi.idO = oglas.idO')
                ->where('praceni_oglasi.korImeKlijent', $korisnik)
                ->get()
                ->getResult();
        }
        function dohvatiSveOglase() {
            return $this->db->table('oglas')
                ->get()
                ->getResult();
        }
        function dohvatiPraceneidO($idO) {
            return $this->db->table('praceni_oglasi')
                ->where('idO', $idO)
                ->get()
                ->getResult();
        }
       
        function filterOpstina($op){
            return $this->db->table('oglas')
                ->where('opstina', $op)
                ->get()
                ->getResultObject();
        }
        /**
         * Dohvatanje dodatnih specifikacija datog oglasa
         * 
         * @param int $idO ID oglasa
         * @return array Niz dodatnih specifikacija
         */
        function dohvatiSpecifikacije($idO){
            return $this->db->table('sadrzi')
                ->join('dodatne_specifikacije', 'sadrzi.idS = dodatne_specifikacije.idS')
                ->where('idO', $idO)
                ->get()
                ->getResultArray();
        }
        
        function dohvatiSvePrihvaceneOglase() {
            $query = $this->db->query('SELECT * FROM oglas WHERE aktivan=1 ORDER BY idO ASC');
            $results = $query->getResult();
            
            return $results;
        }
        
         function getLastRowZahtev()
        {
            $query = $this->db->query("SELECT * FROM zahtev ORDER BY idZah DESC LIMIT 1");
            $row = $query->getRow();
            
            return $row;
    
        }
        function getLastRowOglas()
        {
            $query = $this->db->query("SELECT * FROM oglas ORDER BY idO DESC LIMIT 1");
            $row = $query->getRow();
            
            return $row;
    
        }
        function spajanjeSvihKlijenta(){
            return $this->db->table('korisnik')
                ->join('klijent', 'klijent.korIme = korisnik.korIme')
                ->get()
                ->getResult();
        }
        
        function spajanjeSvihAgentaIzIsteAgencije($agencija){
            return $this->db->table('korisnik')
                ->join('agent', 'agent.korIme = korisnik.korIme')
                ->where('agencija',$agencija)
                ->get()
                ->getResult();
        }
         function spajanjeSvihAgenta(){
            return $this->db->table('korisnik')
                ->join('agent', 'agent.korIme = korisnik.korIme')
                ->get()
                ->getResult();
        }
        function spajanjeKlijentaSaNjegovimOglasom($korIme){
            return $this->db->table('klijent')
                ->join('oglas', 'oglas.korImeKlijent = klijent.korIme')
                ->where('korIme', $korIme)
                ->get()
                ->getResult();
        }
        
        function dohvatiRazlicitogAgenta($agencija,$idKorisnika){
            $query = $this->db->query("SELECT * FROM agent where agencija= ? AND korIme != ? ORDER BY RAND() LIMIT 1",[$agencija,$idKorisnika]);
            return $query->getRow();
        }
        function dohvatiZahtevGdeJeidO($idO){
            return $this->db->table('zahtev_za_oglase')
            ->where('idO', $idO)
            ->get()
            ->getResult();
        }
        function dohvatiZahtevGdeJekorIme($korIme){
            return $this->db->table('zahtev_za_registraciju')
            ->where('korIme', $korIme)
            ->get()
            ->getResult();
        }
        function dohvatiZahtevGdeJeIdZah1($idZahteva){
            return $this->db->table('zahtev')
            ->where('idZah', $idZahteva)
            ->get()
            ->getRow();
        }
        function sadrziGdeImeidO($idO){
            return $this->db->table('sadrzi')
            ->where('idO', $idO)
            ->get()
            ->getResult();
        }
        function praceniOglasiPrekoidO($idO){
            return $this->db->table('praceni_oglasi')
            ->where('idO', $idO)
            ->get()
            ->getResult();
        }
        /**
         * Dohvatanje korIme klijenta-vlasnika datog oglasa
         * 
         * @param int $idO ID oglasa
         * @return string korIme vlasnika oglasa
         */
        function dohvatiImeVlasnikaOglasa($idO){
            return $this->db->table('oglas')
                        ->where('idO', $idO)
                        ->get()
                        ->getRow()
                        ->korImeKlijent;
        }
        /**
         * Dohvatanje naziva datog oglasa
         * 
         * @param int $idO ID oglasa
         * @return string Naziv oglasa
         */
        function dohvatiNaslovOglasa($idO){
            return $this->db->table('oglas')
                        ->where('idO', $idO)
                        ->get()
                        ->getRow()
                        ->naziv;
        }
        function omiljeniOglasiPrekoidO($idO){
            return $this->db->table('omiljeni_oglas')
            ->where('idO', $idO)
            ->get()
            ->getResult();
        }
        function oglasPrekoidO1($idO){
            return $this->db->table('oglas')
            ->where('idO', $idO)
            ->get()
            ->getRow();
        }
        /**
         * Dohvatanje agentovih termina 
         * @param String $agent
         * @return array
         */
        function dohvatiTermine($agent){
            return $this->db->table('termin')
                ->where('korImeAgent', $agent)
                ->get()
                ->getResult();
        }
        
        public function dohvatiTerminSaOglasom($idTer){
            return $this->db->table('termin')
                ->join('oglas', 'oglas.idO = termin.idO')
                ->where('idTer',$idTer)
                ->get()
                ->getrow();
        }
        public function dohvatiTermin($idTer){
            return $this->db->table('termin')
                ->where('idTer',$idTer)
                ->get()
                ->getRow();
        }
        public function agentoviOglasi($korIme){
            return $this->db->table('oglas')
                ->where('korImeAgent',$korIme)
                ->get()
                ->getResult();
        }
        public function klijentoviOglasi($korIme){
            return $this->db->table('oglas')
                ->where('korImeKlijent',$korIme)
                ->get()
                ->getResult();
        }
        public function aktivniAgenti($korIme){
            $query = $this->db->query("SELECT * FROM agent where aktivan=1 ORDER BY RAND() LIMIT 1");
            $row = $query->getRow();
            return $row;
        }
        public function agentoviTermini($korIme){
            return $this->db->table('termin')
                ->where('korImeAgent',$korIme)
                ->get()
                ->getResult();
        }
        public function najmanjeOglasa($agencija){
            $query = $this->db->query("SELECT korImeAgent,COUNT(*) AS total_rows FROM oglas WHERE agencija= ? GROUP BY korImeAgent ORDER BY total_rows ASC LIMIT 1",[$agencija]);
            
            $row = $query->getRow();
        
            return $row;
        }
        
        public function dohvatiAgenciju($agencija){
            return $this->db->table('agent')
                    ->where('agencija',$agencija)
                    ->get()
                    ->getRow();
        }
        
        public function dohvatiObavestenja($korIme){
            return $this->db->table('obavestenje')
                    ->where('korIme',$korIme)
                    ->get()
                    ->getResult();
        }
        
        public function checkUsersExistInOtherTable($agencija)
            {
                $table1 = 'agent';
                $column1 = 'korIme';
                $table2 = 'oglas';
                $column2 = 'korImeAgent';
                $query1 = $this->db->table($table1)->where('agencija',$agencija);
                $query1->select($column1);
                $rows1 = $query1->get()->getResult();
                $query2 = $this->db->table($table2);
                $query2->select($column2);
                $rows2 = $query2->get()->getResult();
                $elements1 = array_column($rows1, $column1);
                $elements2 = array_column($rows2, $column2);
                $result = count(array_diff($elements1, $elements2)) === 0;
                if ($result) {
                    return 1;
                } else {
                    return 0;
                }
                
        }
            
        public function korisnikKojiNijeUDrugojTabeli($agencija)
        {
            $query = $this->db->table('agent');
            $query->select('agent.*');
            $query->where('agent.agencija',$agencija);
            $query->join('oglas', 'agent.korIme = oglas.korImeAgent', 'left');
            $query->where('oglas.korImeAgent', null);
            $results = $query->get()->getRow();
            return $results;
        }
        
        public function dohvatiAgentoveOglase($agent){
            $this->db->table("oglas")
                    ->where('korImeAgent',$agent)
                    ->get()
                    ->getResult();
            
        }

        /**
         * Provera da li se oglas nalazi u tabeli za licitacije 
         * @param int $idO
         * @return Object
         */
        public function daLiJeOglasNaLicitaciji($idO){
            return $this->db->table("licitacija")
                    ->where('licitacija.idO',$idO)
                    ->get()
                    ->getRow();   
        }

        /**
         * Dohvatanje svih klijenata koji prate oglas 
         * @param int $idO
         * @return array
         */
        public function dohvatiSveKojiPrateOglas($idO){
            return $this->db->table("praceni_oglasi")
                    ->where('praceni_oglasi.idO',$idO)
                    ->get()
                    ->getResult();   
        }
        /**
         * Dohvatanje svih slobodnih termina agenta 
         * @param String $agent
         * @return array
         */
        public function dohvatiSveSlobodneTermineAgenta($agent){
            return $this->db->table('termin')
                ->where('korImeAgent',$agent)
                ->where('korImeKlijent',NULL)
                ->where('idO',NULL)
                ->get()
                ->getResult(); 
        }

    }
    
    
