<!-- Nikola Lazić 2020/0318 -->
<!-- Stefan Dumić 2020/0012 -->
<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head><script src="bootstrap/js/color-modes.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registracija korisnika</title>

	  <link href="<?php echo base_url('bootstrap/css/bootstrap.min.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('bootstrap/css/registracija.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('bootstrap/css/registracijaPrijava.css');?>" rel="stylesheet">
  </head>
  <body class="text-center">
	<main class="form-signin w-100 m-auto">
	  <form>
		<a href="<?php echo site_url('gost') ?>"><img class="mb-4" src="<?php echo base_url('logo.png');?>" alt="logo" width="94" height="73"></a>
		<h3 class="h3 mb-3 fw-normal">Izaberite tip korisnika</h3>
		<a href="registracijaKlijent"><button class="w-100 btn btn-lg btn-outline-secondary mb-2" type="button">Klijent</button></a>
		<a href="registracijaAgent"><button class="w-100 btn btn-lg btn-outline-secondary" type="button">Agent</button></a>
	  </form>
	</main>
  </body>
</html>
