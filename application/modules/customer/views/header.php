<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="ID-id">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $title; ?> | <?php echo get_store_name(); ?></title>
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="<?php echo get_theme_uri('plugins/fontawesome-free/css/all.min.css', 'adminlte'); ?>">
  <link rel="stylesheet" href="<?php echo get_theme_uri('plugins/fontawesome-free/css/all1.min.css', 'adminlte'); ?>">
  <link rel="stylesheet" href="<?php echo get_theme_uri('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css', 'adminlte'); ?>">
  <link rel="stylesheet" href="<?php echo get_theme_uri('plugins/toastr/toastr.min.css', 'adminlte'); ?>">
  <link rel="stylesheet" href="<?php echo get_theme_uri('dist/adminlte.min.css', 'adminlte'); ?>" />
  <link rel="stylesheet" href="<?php echo get_theme_uri('dist/adminlte1.min.css', 'adminlte'); ?>" />
  <link rel="stylesheet" href="<?php echo get_theme_uri('plugins/air-datepicker/dist/css/datepicker.min.css', 'adminlte'); ?>">
  <link rel="stylesheet" href="<?php echo get_theme_uri('plugins/select2js/dist/css/select2.min.css', 'adminlte'); ?>">
  <link rel="icon" href="<?php echo base_url('assets/uploads/static/icon.png'); ?>" type="image/icon">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
  <script src="<?php echo get_theme_uri('plugins/jquery/jquery.min.js', 'adminlte'); ?>"></script>
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
      right: 18px;
      top: 2px;
    }
  </style>
  <script src="<?php echo get_theme_uri('plugins/bootstrap/js/bootstrap.bundle.min.js', 'adminlte'); ?>"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
          <form class="form-inline ml-3" action="<?php echo site_url('customer/orders/search'); ?>" method="GET">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" value="" name="query" placeholder="Cari order..." aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
              </div>
            </div>
          </form>
        </li>
        <!-- notif -->
        <li class="dropdown notifications-menu">
          <a href="#" class="nav-link" data-toggle="dropdown">
            <i class="far fa-bell mr-4"></i>
            <?php if ($total_notif > 0) : ?>
              <span class="badge badge-warning navbar-badge" style="font-size:0.55em;"><?= $total_notif ?></span>
            <?php endif; ?>
          </a>
          <ul class="dropdown-menu dropdown-menu-right">
            <li class="header">You have <?= $total_notif ?> unread notifications</li>
            <li>
              <!-- inner menu: contains the actual data -->
              <input type="hidden" value="<?= base_url("/customer/orders/view/") ?>" id="base">
              <?php $i = 1;
              foreach ($linkdata as $link) { ?>
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
                        <p class="ml-4"><?= get_notif_status($val->status);
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
        <!-- end -->
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="<?php echo site_url(); ?>" class="brand-link">
        <img src="<?php echo get_store_logo(); ?>" alt="<?php echo get_store_name(); ?> Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"><?php echo get_store_name(); ?></span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="<?php echo get_user_image(); ?>" class="img-circle elevation-2" alt="Foto profil <?php echo get_user_name(); ?>">
          </div>
          <div class="info">
            <a href="<?php echo site_url('customer/profile'); ?>" class="d-block"><?php echo get_user_name(); ?></a>
          </div>
        </div>

        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
              <a href="<?php echo site_url('customer'); ?>" class="nav-link active">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dasbor
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo site_url('customer/orders'); ?>" class="nav-link">
                <i class="nav-icon fas fa-shopping-cart"></i>
                <p>
                  Order Saya
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo site_url('customer/payments'); ?>" class="nav-link">
                <i class="nav-icon fa fa-money-bill"></i>
                <p>
                  Pembayaran
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo site_url('customer/reviews'); ?>" class="nav-link">
                <i class="nav-icon fa fa-edit"></i>
                <p>
                  Review
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo site_url('auth/logout'); ?>" class="nav-link">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>
                  Logout
                </p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>