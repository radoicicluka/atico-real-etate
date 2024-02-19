<!-- Stefan Dumić 2020/0012 -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="<?php echo base_url('bootstrap/css/bootstrap.min.css');?>">
    <script src="<?php echo base_url('bootstrap/js/bootstrap.bundle.min.js');?>"></script>
    <link rel="stylesheet" href="<?php echo base_url('bootstrap/css/style.css');?>">


    <title>Atico Real Estate</title>
</head>
<body>
    <div class="container">
        <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom ">
        <a href="<?php echo site_url('klijent') ?>" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
            <img src="<?php echo base_url('logo.png');?>" alt="logo" width="56" height="44">
        </a>

        <div class="col-md-3 text-end">
            <a href="<?php echo site_url('klijent/obavestenja') ?>"><button type="button" class="btn btn-outline-secondary me-2">Obaveštenja</button></a>
            <a href="<?php echo site_url('klijent/profil') ?>"><button type="button" class="btn btn-outline-secondary me-2">Profil</button></a>
            <a href="<?php echo site_url('klijent/izlogujSe') ?>"><button type="button" class="btn btn-outline-secondary me-2">Izloguj se</button></a>
        </div>
        </header>        
