<!-- Stefan Dumić 2020/0012 -->
<!-- Luka Radoičić 2020/0085 -->
<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head>
    
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Promena informacija naloga</title>
    
	  <link rel="stylesheet" href="<?php echo base_url('bootstrap/css/bootstrap.min.css');?>">
    <script src="<?php echo base_url('bootstrap/js/bootstrap.bundle.min.js');?>"></script>
	  <link rel="stylesheet" href="<?php echo base_url('bootstrap/css/promenaInfNaloga.css');?>">
	  <link rel="stylesheet" href="<?php echo base_url('bootstrap/css/registracijaPrijava.css');?>">
    
  </head>
  <body class="text-center">
	<main class="form-signin w-100 m-auto">
	  <form method="post">
		<a href="<?php echo site_url($_SESSION['tip']);?>"><img class="mb-4" src="<?php echo base_url('logo.png');?>" alt="logo" width="94" height="73"></a>
		<h3 class="h3 mb-3 fw-normal">Promena informacija naloga</h3>

		<div class="form-floating">
		  <input name="ime" type="text" value="<?= $podaci->ime ?>" class="form-control" id="floatingInputIme" style="margin-bottom: -1px;">
		  <label for="floatingInputIme">Ime</label>
		</div>
		<div class="form-floating">
		  <input name="prezime" type="text" value="<?= $podaci->prezime ?>" class="form-control" id="floatingInputPrezime" style="margin-bottom: -1px;">
		  <label for="floatingInputPrezime">Prezime</label>
		</div>
		<div class="form-floating mb-3">
			<input name="email" type="email" value="<?= $podaci->email ?>" class="form-control" id="floatingPassword">
			<label for="floatingPassword">E-mail</label>
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
	
		<button class="w-100 btn btn-lg btn-outline-secondary" type="submit">Promeni</button>
	  </form>
	</main>
  </body>
</html>
