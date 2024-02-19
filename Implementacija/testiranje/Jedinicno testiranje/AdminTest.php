<?php

use App\Models\CustomModel;
use App\Models\Korisnik;
use App\Models\Zahtev;
use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\ControllerTestTrait;
use CodeIgniter\Test\DatabaseTestTrait;
use Tests\Support\Database\Seeds\ExampleSeeder;
use Tests\Support\Models\ExampleModel;

final class AdminTest extends CIUnitTestCase
{

    use ControllerTestTrait;
    use DatabaseTestTrait;

    public function testIzlogujSe(){
        session()->set('autor','boraThePro');
        session()->set('tip','Admin');
        $res = $this->controller(\App\Controllers\Admin::class)->execute('izlogujSe');
        $this->assertNotTrue($res->see('autor'));
        $this->assertNotTrue($res->see('tip'));
    }

    public function testZahtevi(){
        session()->set('autor','boraThePro');
        session()->set('tip','Admin');
        $res = $this->controller(\App\Controllers\Admin::class)->execute('zahtevi');
        $this->assertTrue($res->see('Pristigli zahtevi'));
        
    }
    
    public function testProfil(){
        
        session()->set('autor','boraThePro');
        session()->set('tip','Admin');
        
        $res = $this->controller(\App\Controllers\Admin::class)->execute('profil');
        $this->assertTrue($res->see('Profil admina boraThePro'));

    }
    public function testprikaziKorisnika(){
    
        session()->set('autor','boraThePro');
        session()->set('tip','Admin');
        
        $res = $this->controller(\App\Controllers\Admin::class)->execute('prikaziKorisnika','lukka');
        $this->assertTrue($res->see('lukka'));

    }
    public function testprikaziOglas(){
    
        session()->set('autor','boraThePro');
        session()->set('tip','Admin');
        
        $res = $this->controller(\App\Controllers\Admin::class)->execute('oglas', 1);
        $this->assertTrue($res->see('360000'));
        $this->assertTrue($res->see('Grejanje'));
    }

    public function testBrisanjeOglasa(){
    
        session()->set('autor','boraThePro');
        session()->set('tip','Admin');
        $_POST['oglas_75'] = 1;
        
        $res = $this->controller(\App\Controllers\Admin::class)->execute('brisanjeOglasa');

        $db = db_connect();
        $model = new CustomModel($db);

        $ogls = $model->pronadjiOglas(75);
        $this->assertSame(null, $ogls);
    }

    public function testPromenaInformacijaNaloga(){
    
        session()->set('autor','boraThePro');
        session()->set('tip','Admin');

        $_POST['ime'] = "Borivoje";
        $_POST['prezime'] = "Miletic";
        $_POST['email'] = "borabora@gmail.com";
        
        $res = $this->controller(\App\Controllers\Admin::class)->execute('promenaInfNaloga');

        $db = db_connect();
        $model=new Korisnik($db);

        $info = $model->getKorisnik("boraThePro");

        $this->assertSame("Bora", $info->ime);
    }

    public function testBrisanjeKorisnika(){
    
        session()->set('autor','boraThePro');
        session()->set('tip','Admin');
        $_POST['vuk1234'] = 1;
        
        $res = $this->controller(\App\Controllers\Admin::class)->execute('uklanjanjeKorisnika');

        $db = db_connect();
        $model=new Korisnik($db);

        $info = $model->getKorisnik("vuk1234");
        $this->assertSame('vuk1234', $info->korIme);
    }
}