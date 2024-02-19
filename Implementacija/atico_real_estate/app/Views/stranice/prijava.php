<!-- Stefan Dumić 2020/0012 -->
<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head><script src="<?php echo base_url('bootstrap/css/bootstrap.min.css');?>"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Prijava</title>

    <link rel="stylesheet" href="<?php echo base_url('bootstrap/css/bootstrap.min.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('bootstrap/css/registracijaPrijava.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('bootstrap/css/prijava.css');?>">
  </head>
  <body class="text-center">

    <div class="container form-signin w-100 m-auto"> 

      <form method="post">

        <a href="<?php echo site_url('gost') ?>"><img class="mb-3" src="<?php echo base_url('logo.png');?>" alt="logo" width="94" height="73"></a>
        <h3 class="h3 mb-3 fw-normal">Prijava</h3>

        <div class="form-floating">
          <input name="email" type="email" value="<?= set_value('email')?>" class="form-control" id="floatingInput" placeholder="name@example.com">
          <label for="floatingInput">E-mail</label>
        </div>

        <div class="form-floating">
          <input name="password" type="password" value="<?= set_value('password')?>" class="form-control mb-3" id="floatingPassword" placeholder="Password">
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

        <button class="w-100 btn btn-lg btn-outline-secondary" type="submit">Uloguj se</button>

      </form>

    </div>
  </body>
</html>
