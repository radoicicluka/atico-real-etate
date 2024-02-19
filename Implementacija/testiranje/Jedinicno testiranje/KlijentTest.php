<?php

use App\Models\Zahtev;
use App\Models\Korisnik;
use App\Models\CustomModel;
use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\ControllerTestTrait;
use CodeIgniter\Test\DatabaseTestTrait;
use Tests\Support\Database\Seeds\ExampleSeeder;
use Tests\Support\Models\ExampleModel;

final class KlijentTest extends CIUnitTestCase
{

    use ControllerTestTrait;
    use DatabaseTestTrait;

    public function testIzlogujSe(){
        session()->set('autor','familyGuy');
        session()->set('tip','Klijent');
        $res = $this->controller(\App\Controllers\Klijent::class)->execute('izlogujSe');
        $this->assertNotTrue($res->see('autor'));
        $this->assertNotTrue($res->see('tip'));
    }

    public function testObavestenja(){
        session()->set('autor','mrmonaco');
        session()->set('tip','Klijent');
        

        $res = $this->controller(\App\Controllers\Klijent::class)->execute('obavestenja');
        $this->assertTrue($res->see('Obaveštenja'));
        
    }
    
    public function testProfil(){
        
        session()->set('autor','mrmonaco');
        session()->set('tip','Klijent');
        
        $res = $this->controller(\App\Controllers\Klijent::class)->execute('profil');
        $this->assertTrue($res->see('Profil klijenta mrmonaco'));

    }

    public function testPromenaLozinke(){
        session()->set('tip', 'Klijent');
        session()->set('autor', 'mrmonaco');
        $_POST['old'] = '123456';
        $_POST['new'] = 'sifra1234';
        $result = $this->controller(\App\Controllers\Klijent::class)->execute('promenaLozinke');
        $db = db_connect();
        $model = new CustomModel($db);
        $sif = $model->proveriKorIme($_SESSION['autor'])->lozinka;
        $this->assertSame($_POST['old'], $sif);
    }
    
    public function testOmiljeniOglasi(){
        session()->set('tip', 'Klijent');
        session()->set('autor', 'familyGuy');

        $res = $this->controller(\App\Controllers\Klijent::class)->execute('omiljeniOglasi');
        $this->assertTrue($res->see('Omiljeni oglasi'));
    }

    public function testPraceniOglasi(){
        session()->set('tip', 'Klijent');
        session()->set('autor', 'familyGuy');

        $res = $this->controller(\App\Controllers\Klijent::class)->execute('praceniOglasi');
        $this->assertTrue($res->see('Praćeni oglasi'));
    }

    public function testPostavljeniOglasi(){
        session()->set('tip', 'Klijent');
        session()->set('autor', 'mrmonaco');

        $res = $this->controller(\App\Controllers\Klijent::class)->execute('postavljeniOglasi');
        $this->assertTrue($res->see('Moji oglasi'));
    }

    public function testPromenaInformacijaNaloga(){
    
        session()->set('autor','familyGuy');
        session()->set('tip','Klijent');

        $_POST['ime'] = "Petar";
        $_POST['prezime'] = "G";
        $_POST['email'] = "peterg@gmail.com";
        
        $res = $this->controller(\App\Controllers\Klijent::class)->execute('promenaInformacijaNaloga');

        $db = db_connect();
        $model=new Korisnik($db);

        $info = $model->getKorisnik("familyGuy");

        $this->assertSame("Peter", $info->ime);
    }

    public function testPokreniLicitaciju(){
        session()->set('tip', 'Klijent');
        session()->set('autor', 'mrmonaco');

        $res = $this->controller(\App\Controllers\Klijent::class)->execute('pokreniLicitaciju', '1');
        $this->assertTrue($res->see('Pokretanje licitacije'));
    }

    public function testprikaziOglas(){
    
        session()->set('autor','mrmonaco');
        session()->set('tip','Klijent');
        
        $res = $this->controller(\App\Controllers\Klijent::class)->execute('oglas', 1);
        $this->assertTrue($res->see('360000'));
        $this->assertTrue($res->see('Grejanje'));
    }

    public function testLajkujOglas(){
        session()->set('tip', 'Klijent');
        session()->set('autor', 'mrmonaco');

        $res = $this->controller(\App\Controllers\Klijent::class)->execute('lajkujOglas', 1);
        $this->assertTrue($res->see('360000'));
        $this->assertTrue($res->see('Grejanje'));
    }

    public function testPratiOglas(){
        session()->set('tip', 'Klijent');
        session()->set('autor', 'mrmonaco');

        $res = $this->controller(\App\Controllers\Klijent::class)->execute('pratiOglas', 1);
        $this->assertTrue($res->see('360000'));
        $this->assertTrue($res->see('Grejanje'));
    }

    public function testZakaziTermin(){
        session()->set('tip', 'Klijent');
        session()->set('autor', 'mrmonaco');
        $attr = array(
            'idTer' => 11,
            'korImeKlijent' => $_SESSION['autor'],
            'korImeAgent' => 'lukka',
            'datumVreme' => '2023-05-12 13:00:00',
            'idO' => 1
        );

        $res = $this->controller(\App\Controllers\Klijent::class)->execute('zakaziTermin', 1);
        $this->assertTrue($res->see('360000'));
        $this->assertTrue($res->see('Grejanje'));
    }
    
}