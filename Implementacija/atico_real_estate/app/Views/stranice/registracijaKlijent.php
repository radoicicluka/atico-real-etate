<!-- Nikola Lazić 2020/0318 -->
<!-- Stefan Dumić 2020/0012 -->
<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head><script src="bootstrap/js/color-modes.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registracija klijenta</title>

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
      <input type="text" class="form-control" value="<?= set_value('ime')?>" id="floatingInput" name="ime" placeholder="Ime">
		  <label for="floatingInput">Ime</label>
		</div><div class="form-floating">
      <input type="text" class="form-control" value="<?= set_value('prezime')?>" id="floatingInput" name="prezime" placeholder="Prezime">
		  <label for="floatingInput">Prezime</label>
		</div>
		<div class="form-floating">
		  <input type="email" class="form-control" value="<?= set_value('email')?>" id="floatingInput" name="email" placeholder="name@example.com">
		  <label for="floatingInput">E-mail</label>
		</div>
    <div class="form-floating">
		  <input type="text" class="form-control" value="<?= set_value('korIme')?>" id="floatingInput"  name="korIme" placeholder="name@example.com">
		  <label for="floatingInput">Korisničko ime</label>
		</div>
		<div class="form-floating mb-3">
		  <input type="password" class="form-control" value="<?= set_value('lozinka')?>" id="floatingPassword" name="lozinka" placeholder="Password">
		  <label for="floatingPassword">Šifra</label>
		</div>

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
		
		</div>
		<button class="w-100 btn btn-lg btn-outline-secondary" type="submit">Registruj se</button>
	  </form>
	</main>
  </body>
</html>
