<!DOCTYPE html>
<html>
<head>
  <title>ADMIN</title>
  
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" type="text/css" href="<?php print base_url()?>/assets/css/vendor.css">
  <link rel="stylesheet" type="text/css" href="<?php print base_url()?>/assets/css/flat-admin.css">

</head>
<body>
  <div class="app app-default">

<aside class="app-sidebar" id="sidebar">
  <div class="sidebar-header">
    <a class="sidebar-brand" href="#"><span class="highlight">ADMIN</span></a>
    <button type="button" class="sidebar-toggle">
      <i class="fa fa-times"></i>
    </button>
  </div>
  <div class="sidebar-menu">
    <ul class="sidebar-nav">
      <li class="active">
        <a href="./index.html">
          <div class="icon">
            <i class="fa fa-tasks" aria-hidden="true"></i>
          </div>
          <div class="title">Dashboard</div>
        </a>
      </li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <div class="icon">
            <i class="fa fa-file-o" aria-hidden="true"></i>
          </div>
          <div class="title">Laporan</div>
        </a>
        <div class="dropdown-menu">
          <ul>
            <li class="section"><i class="fa fa-file-o" aria-hidden="true"></i> Laporan</li>
            <li><a href="./pages/form.html">Siswa Diterima</a></li>
            <li><a href="./pages/profile.html">Siswa Belum Diterima</a></li>
            <li><a href="./pages/search.html">Statistik Pendaftaran</a></li>
            <li class="line"></li>
          </ul>
        </div>
      </li>
      <li class="dropdown ">
        <a href="./pages/form.html">
          <div class="icon">
            <i class="fa fa-gear" aria-hidden="true"></i>
          </div>
          <div class="title">Setting</div>
        </a>
      </li>
    </ul>
  </div>
  <div class="sidebar-footer">
    <ul class="menu">
      <li>
        <a href="/" class="dropdown-toggle" data-toggle="dropdown">
          <i class="fa fa-cogs" aria-hidden="true"></i>
        </a>
      </li>
    </ul>
  </div>
</aside>

<script type="text/ng-template" id="sidebar-dropdown.tpl.html">
  <div class="dropdown-background">
    <div class="bg"></div>
  </div>
  <div class="dropdown-container">
    {{list}}
  </div>
</script>
<div class="app-container">

  <nav class="navbar navbar-default" id="navbar">
  <div class="container-fluid">
    <div class="navbar-collapse collapse in">
      <ul class="nav navbar-nav navbar-mobile">
        <li>
          <button type="button" class="sidebar-toggle">
            <i class="fa fa-bars"></i>
          </button>
        </li>
        <li class="logo">
          <a class="navbar-brand" href="#"><span class="highlight">Admin</span></a>
        </li>
        <li>
          <button type="button" class="navbar-toggle">
            <img class="profile-img" src="./assets/images/profile.png">
          </button>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-left">
        <li class="navbar-title">Dashboard</li>
        <li class="navbar-search hidden-sm">
          <input id="search" type="text" placeholder="Search..">
          <button class="btn-search"><i class="fa fa-search"></i></button>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown notification danger">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <div class="icon"><i class="fa fa-bell" aria-hidden="true"></i></div>
            <div class="title">System Notifications</div>
            <div class="count">10</div>
          </a>
          <div class="dropdown-menu">
            <ul>
              <li class="dropdown-header">Notification</li>
              <li>
                <a href="#">
                  <span class="badge badge-danger pull-right">14</span>
                  Inbox
                </a>
              </li>
              <li>
                <a href="#">
                  <span class="badge badge-danger pull-right">5</span>
                  Issues Report
                </a>
              </li>
              <li class="dropdown-footer">
                <a href="#">View All <i class="fa fa-angle-right" aria-hidden="true"></i></a>
              </li>
            </ul>
          </div>
        </li>
        <li class="dropdown profile">
          <a href="/html/pages/profile.html" class="dropdown-toggle"  data-toggle="dropdown">
            <img class="profile-img" src="<?php print base_url()?>/assets/images/profile.png">
            <div class="title">Profile</div>
          </a>
          <div class="dropdown-menu">
            <div class="profile-info">
              <h4 class="username">Matlaul</h4>
            </div>
            <ul class="action">
              <li>
                <a href="./pages/profile.html">
                  Profile
                </a>
              </li>
              <li>
                <a href="#">
                  Setting
                </a>
              </li>
              <li>
                <a href="<?php echo site_url('admin/logout');?>">
                  Logout
                </a>
              </li>
            </ul>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>
  <div class="btn-floating" id="help-actions">
  <div class="btn-bg"></div>
  <button type="button" class="btn btn-default btn-toggle" data-toggle="toggle" data-target="#help-actions">
    <i class="icon fa fa-plus"></i>
    <span class="help-text">Shortcut</span>
  </button>
  <div class="toggle-content">
    <ul class="actions">
      <li><a href="#">Website</a></li>
      <li><a href="#">Documentation</a></li>
      <li><a href="#">Issues</a></li>
      <li><a href="#">About</a></li>
    </ul>
  </div>
</div>
<div class="row">
  <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
      <a class="card card-banner card-green-light" href="<?php echo site_url('admin/siswa_terdaftar_semua_tertinggi');?>">
        <div class="card-body">
          <i class="icon fa fa-user-plus fa-4x"></i>
          <div class="content">
            <div class="title">Data Seluruh Pendaftar</div>
            <div class="value"><span class="sign"></span>50</div>
          </div>
        </div>
      </a>
  </div>
  <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
      <a class="card card-banner card-blue-light" href="<?php echo site_url('admin/laporan_siswa_diterima/');?>">
        <div class="card-body">
          <i class="icon fa fa-user fa-4x"></i>
          <div class="content">
            <div class="title">Siswa Diterima</div>
            <div class="value"><span class="sign"></span>420</div>
          </div>
        </div>
      </a>
  </div>
  <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
      <a class="card card-banner card-yellow-light">
        <div class="card-body">
          <i class="icon fa fa-user-times fa-4x"></i>
          <div class="content">
            <div class="title">Siswa Tidak Diterima</div>
            <div class="value"><span class="sign"></span>2453</div>
          </div>
        </div>
      </a>
  </div>
</div>