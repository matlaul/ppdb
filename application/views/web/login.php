<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" type="text/css" href="<?php print base_url()?>/assets/css/vendor.css">
  <link rel="stylesheet" type="text/css" href="<?php print base_url()?>/assets/css/style.css">
  <link rel="stylesheet" type="text/css" href="<?php print base_url()?>/assets/css/web.css">

</head>
<body>
  <!-- Navigation -->
    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top navbar-custom">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="#page-top">PPDBonline SMKN 1 Cilegon</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li class="page-scroll">
                        <a href="#portfolio">Data Pendaftar</a>
                    </li>
                    <li class="page-scroll">
                        <a href="#about">Hasil Seleksi</a>
                    </li>
                    <li class="page-scroll">
                        <a href="<?php echo site_url('web/login'); ?>">Login</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

  <div class="app app-default">

<div class="app-container app-login">
  <div class="flex-center">
    <div class="app-header"></div>
    <div class="app-body">
      <div class="app-block">
      <div class="app-form">
        <div class="form-header">
          <div class="app-brand"><span class="highlight">LOGIN</span></div>
        </div>
        <center><?php echo $message;?></center>
        <?php echo form_open('web/validate_credentials');?>
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon1">
                <i class="fa fa-user" aria-hidden="true"></i></span>
              <input type="text" class="form-control" placeholder="email" aria-describedby="basic-addon1" name="nisn">
            </div>
            <div class="input-group">
              <span class="input-group-addon" id="basic-addon2">
                <i class="fa fa-key" aria-hidden="true"></i></span>
              <input type="password" class="form-control" placeholder="Password" aria-describedby="basic-addon2" name="password">
            </div>
            <div class="text-center">
                <input type="submit" class="btn btn-success btn-submit" value="LOGIN" name="Login">
            </div>
          <?php echo form_close();?>
        </div>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>