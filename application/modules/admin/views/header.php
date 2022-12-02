<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title><?php echo $title; ?> | <?php echo get_store_name(); ?></title>
  <!-- Favicon -->
  <link rel="icon" href="<?php echo get_theme_uri('img/brand/favicon.png', 'argon'); ?>" type="image/png">
  <!-- Fonts -->
  <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700"> -->
  <!-- Icons -->
  <link rel="stylesheet" href="<?php echo get_theme_uri('js/plugins/nucleo/css/nucleo.css', 'argon'); ?>" type="text/css">
  <link rel="stylesheet" href="<?php echo get_theme_uri('js/plugins/@fortawesome/fontawesome-free/css/all.min.css', 'argon'); ?>" type="text/css">
  <link rel="stylesheet" href="<?php echo get_theme_uri('plugins/fontawesome-free/css/all1.min.css', 'adminlte'); ?>">
  <link rel="stylesheet" href="<?php echo get_theme_uri('dist/adminlte1.min.css', 'adminlte'); ?>" />
  <!-- <link rel="stylesheet" href="<?php echo get_theme_uri('dist/adminlte.min.css', 'adminlte'); ?>" /> -->
  <!-- Argon CSS -->
  <link rel="stylesheet" href="<?php echo get_theme_uri('css/argon9f1e.css?v=1.1.0', 'argon'); ?>" type="text/css">

  <!-- DataTables -->
  <script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>
  <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>



  <script src="<?php echo get_theme_uri('vendor/jquery/dist/jquery.min.js', 'argon'); ?>"></script>
  <script src="<?php echo get_theme_uri('vendor/bootstrap/dist/js/bootstrap.bundle.min.js', 'argon'); ?>"></script>
  <style>
    .navbar-nav>.notifications-menu>.dropdown-menu>li .menu>li>a {
      text-decoration: none;
      background-image: linear-gradient(#bfbfbf, #e5e5e5);
    }

    .navbar-nav>.notifications-menu>.dropdown-menu>li .menu>li>a:hover,
    .navbar-nav>.messages-menu>.dropdown-menu>li .menu>li>a:hover,
    .navbar-nav>.tasks-menu>.dropdown-menu>li .menu>li>a:hover {
      background-color: #f5f5f5;
    }

    .navbar-badge {
      vertical-align: 11px;
      margin-left: -4px;
    }
  </style>
</head>

<body class="@yield('sidebar_type')">
  <!-- Sidenav -->
  <nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-sm navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header d-flex align-items-center">
        <a class="navbar-brand" href="<?php echo base_url(); ?>">
          <img src="<?php echo get_store_logo(); ?>" class="navbar-brand-img" alt="Logo <?php echo get_store_name(); ?>">
        </a>
        <div class="ml-auto">
          <!-- Sidenav toggler -->
          <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin" data-target="#sidenav-main">
            <div class="sidenav-toggler-inner">
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
            </div>
          </div>
        </div>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="<?php echo site_url('admin'); ?>">
                <i class="ni ni-tv-2 text-primary"></i>
                <span class="nav-link-text">Dasbor</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo site_url('admin/products/category'); ?>">
                <i class="ni ni-bullet-list-67 text-info"></i>
                <span class="nav-link-text">Kategori Produk</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo site_url('admin/products'); ?>">
                <i class="fa fa-shopping-cart text-success"></i>
                <span class="nav-link-text">Produk</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo site_url('admin/orders'); ?>">
                <i class="fa fa-file-invoice text-danger"></i>
                <span class="nav-link-text">Pesanan</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo site_url('admin/products/coupons'); ?>">
                <i class="fa fa-money-bill-alt text-info"></i>
                <span class="nav-link-text">Kupon</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo site_url('admin/payments'); ?>">
                <i class="fa fa-money-bill-alt text-warning"></i>
                <span class="nav-link-text">Pembayaran</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo site_url('admin/customers'); ?>">
                <i class="fa fa-users text-primary"></i>
                <span class="nav-link-text">Pelanggan</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo site_url('admin/tables'); ?>">
                <i class="fa fa-signal"></i>
                <span class="nav-link-text">Laporan Penjualan</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo site_url('admin/reviews'); ?>">
                <i class="fa fa-edit text-info"></i>
                <span class="nav-link-text">Review Pelanggan</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo site_url('admin/contacts'); ?>">
                <i class="fa fa-phone text-info"></i>
                <span class="nav-link-text">Kontak</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
  <!-- Main content -->
  <div class="main-content" id="panel">
    <!-- Topnav -->
    <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom mb-2">
      <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Search form -->
          <form class="navbar-search navbar-search-light form-inline mr-sm-3" id="navbar-search-main" action="<?php echo site_url('admin/products/search'); ?>" required>
            <div class="form-group mb-0">
              <div class="input-group input-group-alternative input-group-merge">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-search"></i></span>
                </div>
                <input class="form-control" value="<?php echo (isset($query) ? $query : ''); ?>" name="search_query" placeholder="Cari..." type="text" required>
              </div>
            </div>
            <button type="button" class="close" data-action="search-close" data-target="#navbar-search-main" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </form>
          <!-- Navbar links -->
          <ul class="navbar-nav align-items-center ml-md-auto">
            <li class="nav-item d-xl-none">
              <!-- Sidenav toggler -->
              <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </div>
            </li>
            <li class="nav-item d-sm-none">
              <a class="nav-link" href="#" data-action="search-show" data-target="#navbar-search-main">
                <i class="ni ni-zoom-split-in"></i>
              </a>
            </li>
          </ul>
          <ul class="navbar-nav align-items-center ml-auto ml-md-0">
            <li class="nav-item dropdown">
              <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="media align-items-center">
                  <span class="avatar avatar-sm rounded-circle">
                    <img src="<?php echo get_admin_image(); ?>">
                  </span>
                  <div class="media-body ml-2 d-none d-lg-block">
                    <span class="mb-0 text-sm  font-weight-bold"><?php echo get_admin_name(); ?></span>
                  </div>
                </div>
              </a>
              <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-header noti-title">
                  <h6 class="text-overflow m-0">Welcome!</h6>
                </div>
                <a href="<?php echo site_url('admin/settings/profile'); ?>" class="dropdown-item">
                  <i class="ni ni-single-02"></i>
                  <span>Profil</span>
                </a>
                <a href="<?php echo site_url('admin/settings'); ?>" class="dropdown-item">
                  <i class="ni ni-settings-gear-65"></i>
                  <span>Pengaturan</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="<?php echo site_url('auth/logout'); ?>" class="dropdown-item">
                  <i class="ni ni-user-run"></i>
                  <span>Logout</span>
                </a>
              </div>
            </li>
            <!-- Notifikasi -->
            <li class="dropdown notifications-menu">
              <a href="#" class="nav-link" data-toggle="dropdown">
                <i class="far fa-bell">
                  <?php if ($total_notif > 0) : ?>
                    <span class="badge badge-warning navbar-badge" style="font-size:0.65em;"><?= $total_notif ?></span>
                  <?php endif; ?>
                </i>
              </a>
              <ul class="dropdown-menu dropdown-menu-right">
                <li class="header">You have <?= $total_notif ?> unread notifications</li>
                <li>
                  <!-- inner menu: contains the actual data -->
                  <input type="hidden" value="<?= base_url("/admin/orders/view/") ?>" id="base">
                  <?php $i = 1;
                  foreach ($linkdata as $link) {

                  ?>

                    <input type="hidden" class="idlink<?= $i ?>" value="<?= $link->id ?>">
                  <?php
                    $i++;
                  } ?>

                  <?php if (count($notif) > 0) { ?>
                    <ul class="menu">
                      <input type="hidden" class="notif" value="<?= count($notif) ?>">
                      <?php $i = 1;
                      foreach ($notif as $val) {
                      ?>
                        <li>
                          <a href="" class="link<?= $i ?>">

                            <?= is_read($val->is_read) ?>
                            <input value="<?= $val->tanggal ?>" type="hidden" class="date<?= $i ?>">
                            <p><i class="fa fa-users text-aqua"></i>Pembayaran #<?= $val->no_order ?></p>
                            <p class="ml-4"><?= get_notif_status_admin($val->status);
                                            ?></p>
                            <span class="float-right text-muted text-sm time<?= $i ?>"></span>
                          </a>
                        </li>

                      <?php $i++;
                      } ?>
                    </ul>
                  <?php } else { ?>
                  <?php } ?>
                </li>
              </ul>
            </li>

          </ul>
        </div>
      </div>
    </nav>