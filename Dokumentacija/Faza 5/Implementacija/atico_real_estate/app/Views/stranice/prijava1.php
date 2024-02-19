<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Prijava</title>
    
    <script src="<?php echo base_url('bootstrap/css/bootstrap.min.css');?>"></script>
    <link rel="stylesheet" href="<?php echo base_url('bootstrap/css/bootstrap.min.css');?>">
  </head>

<body>
  
  <div class="container">

  <form method="post" class="col-sm-3 mt-5">



    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Email</label>
      <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label">Password</label>
      <input name="password"  type="password" class="form-control" id="exampleInputPassword1">
    </div>
    <button type="submit" class="btn btn-outline-secondary">Submit</button>
    

  </form>

  </div>

</body>

</html>