<!DOCTYPE html>
<html>
<head>
  <title>PPDB</title>
  
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" type="text/css" href="<?php print base_url()?>/assets/css/vendor.css">
  <link rel="stylesheet" type="text/css" href="<?php print base_url()?>/assets/css/web.css">

</head>
<body id="page-top" class="index">

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
                        <a href="<?php echo site_url('./web/login'); ?>">Login</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <!-- Header -->
    <header  background="<?php print base_url()?>/assets/images/sekolah.png">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <img class="img-responsive" src="<?php print base_url()?>/assets/images/sekolah.png" alt="">
                    <div class="intro-text">
                        <span class="name">Selamat Datang</span>
                        <hr class="star-light">
                        <span class="skills">Calon Peserta Didik Baru!</span>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Footer -->
    <footer class="text-center">
        <div class="footer-below">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        Copyright &copy; Mat 2016
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
    <div class="scroll-top page-scroll hidden-sm hidden-xs hidden-lg hidden-md">
        <a class="btn btn-primary" href="#page-top">
            <i class="fa fa-chevron-up"></i>
        </a>
    </div>
</body>

</html>