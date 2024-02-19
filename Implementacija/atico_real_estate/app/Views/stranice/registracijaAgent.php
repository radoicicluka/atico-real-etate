<!-- Nikola Lazić 2020/0318 -->
<!-- Stefan Dumić 2020/0012 -->
<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head><script src="bootstrap/js/color-modes.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registracija agenta</title>

    <link href="<?php echo base_url('bootstrap/css/bootstrap.min.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('bootstrap/css/registracijaAgent.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('bootstrap/css/registracijaPrijava.css');?>" rel="stylesheet">
  </head>
  <body class="text-center">
	<main class="form-signin w-100 m-auto">
	  <form method="post">
		<a href="<?php echo site_url('gost') ?>"><img class="mb-4" src="<?php echo base_url('logo.png');?>" alt="logo" width="94" height="73"></a>
		<h3 class="h3 mb-3 fw-normal">Registracija</h3>

    <div class="form-floating">
      <input type="text" name="ime" value="<?= set_value('ime')?>" class="form-control" id="floatingInput" placeholder="Ime">
		  <label for="floatingInput">Ime</label>
		</div><div class="form-floating">
      <input type="text" name="prezime" value="<?= set_value('prezime')?>" class="form-control" id="floatingInput" placeholder="Prezime">
		  <label for="floatingInput">Prezime</label>
		</div>
		<div class="form-floating">
      <input type="email" name="email" value="<?= set_value('email')?>" class="form-control" id="floatingInput" placeholder="emailAgenta">
		  <label for="floatingInput">E-mail</label>
		</div>
    <div class="form-floating">
      <input type="text" name="korIme" value="<?= set_value('korIme')?>" class="form-control" id="floatingInput" placeholder="imeAgenta">
      <label for="floatingInput">Korisničko ime</label>
    </div>
		<div class="form-floating">
		  <input type="password" name="lozinka" value="<?= set_value('lozinka')?>" class="form-control" id="floatingPassword" placeholder="sifraAgenta">
		  <label for="floatingPassword">Šifra</label>
		</div>
    <select class="form-select mb-3 mt-3" name="agencija" value="<?= set_value('agencija')?>" aria-label="Default select example">
      <option selected>Agencija</option>
      <option value="1">Lux.com</option>
      <option value="2">Diamond</option>
      <option value="3">Metropolitan</option>
      <option value="4">Kosmopolis</option>
    </select>

    <?php if(isset($validation)) : ?>
        <div class="text-danger">
          <?= $validation->listErrors() ?>
        </div>
        <?php endif; ?>

        <?php if(isset($msg)) : ?>
        <div class="text-danger">
          <p>
            <?= $msg ?>
          </p>
        </div>
        <?php endif; ?>


		<button class="w-100 btn btn-lg btn-outline-secondary" type="submit">Registruj se</button>
	  </form>
	</main>

  </body>
</html>
