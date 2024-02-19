<?php

namespace CodeIgniter;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\ControllerTestTrait;
use CodeIgniter\Test\DatabaseTestTrait;
use \App\Controllers\Agent;
use App\Models\CustomModel;

class AgentTest extends CIUnitTestCase{

    use ControllerTestTrait;
    use DatabaseTestTrait;

    public function testPromenaLozinke(){
        session()->set('tip', 'Agent');
        session()->set('autor', 'lukka');
        $_POST['old'] = 'sifra123';
        $_POST['new'] = 'sifra1234';
        $result = $this->controller(\App\Controllers\Agent::class)->execute('promenaLozinke');
        $db = db_connect();
        $model = new CustomModel($db);
        $sif = $model->proveriKorIme($_SESSION['autor'])->lozinka;
        $this->assertSame($_POST['old'], $sif);
    }

    public function testPromenaInformacijaNaloga(){
        session()->set('tip', 'Agent');
        session()->set('autor', 'lukka');
        $_POST['ime'] = 'Luka';
        $_POST['prezime'] = 'Radoicic';
        $_POST['email'] = 'luka123@gmail.com';
        $result = $this->controller(\App\Controllers\Agent::class)->execute('promenaInformacijaNaloga');

        $db = db_connect();
        $model = new CustomModel($db);
        $ime = $model->proveriKorIme($_SESSION['autor'])->ime;
        $prezime = $model->proveriKorIme($_SESSION['autor'])->prezime;
        $email = $model->proveriKorIme($_SESSION['autor'])->email;

        $result->assertSame($_POST['ime'], $ime);
        $result->assertSame($_POST['prezime'], $prezime);
        $result->assertSame($_POST['email'], $email);
    }

    public function testProfil(){
        session()->set('autor','lukka');
        session()->set('tip','Agent');
        
        $res = $this->controller(\App\Controllers\Agent::class)->execute('profil');
        $this->assertTrue($res->see('Profil agenta lukka'));
    }

    public function testIzlogujSe(){
        session()->set('autor','lukka');
        session()->set('tip','Agent');
        $res = $this->controller(\App\Controllers\Agent::class)->execute('izlogujSe');
        $this->assertNotTrue($res->see('autor'));
        $this->assertNotTrue($res->see('tip'));
    }

    public function testRaspored(){
        session()->set('autor','lukka');
        session()->set('tip','Agent');
        $res = $this->controller(\App\Controllers\Agent::class)->execute('raspored');
        $this->assertTrue($res->see('Termini'));
        $this->assertSame($_SESSION['tip'], 'Agent');
    }

    public function testZahtevi(){
        session()->set('autor','lukka');
        session()->set('tip','Agent');
        $res = $this->controller(\App\Controllers\Agent::class)->execute('zahtevi');
        $this->assertTrue($res->see('Pristigli zahtevi'));
        $this->assertSame($_SESSION['tip'], 'Agent');
    }

    public function testDetaljnije(){
        session()->set('autor','lukka');
        session()->set('tip','Agent');
        $res = $this->controller(\App\Controllers\Agent::class)->execute('detaljnije', 2);
        $this->assertTrue($res->see('Otkazivanje termina'));
        $this->assertSame($_SESSION['tip'], 'Agent');
    }

    public function testOglas(){
        session()->set('autor','lukka');
        session()->set('tip','Agent');
        $res = $this->controller(\App\Controllers\Agent::class)->execute('oglas', 1);
        $this->assertTrue($res->see('Veliki penthaus u srcu grada - 360000 €'));
    }

    public function noviTermin(){
        session()->set('autor','lukka');
        session()->set('tip','Agent');
        $res = $this->controller(\App\Controllers\Agent::class)->execute('noviTermin');
        $this->assertTrue($res->see('Dodavanje novog termina'));
        $this->assertSame($_SESSION['tip'], 'Agent');
    }

    public function testObavestenja(){
        session()->set('autor','lukka');
        session()->set('tip','Agent');
        $res = $this->controller(\App\Controllers\Agent::class)->execute('obavestenja');
        $this->assertTrue($res->see('Obaveštenja'));
        $this->assertSame($_SESSION['tip'], 'Agent');
    }

}