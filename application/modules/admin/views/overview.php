<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!-- Header -->
<div class="header bg-primary pb-6">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          <h6 class="h2 text-white d-inline-block mb-0">Dasbor</h6>
        </div>
        <div class="col-lg-6 col-5 text-right">
          <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
              <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
              <li class="breadcrumb-item active" aria-current="page">Dasbor</li>
            </ol>
          </nav>
        </div>
      </div>
      <!-- Card stats -->
      <div class="row">
        <div class="col-xl-3 col-md-6">
          <div class="card card-stats">
            <!-- Card body -->
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <h5 class="card-title text-uppercase text-muted mb-0">Produk</h5>
                  <span class="h2 font-weight-bold mb-0"><?php echo $total_products; ?></span>
                </div>
                <div class="col-auto">
                  <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                    <i class="ni ni-shop"></i>
                  </div>
                </div>
              </div>
              <p class="mt-3 mb-0 text-sm">
                <span class="text-success mr-2"><i class="fa fa-arrow-up"></i></span>
                <span class="text-nowrap">Jumlah produk yang tersedia</span>
              </p>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-md-6">
          <div class="card card-stats">
            <!-- Card body -->
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <h5 class="card-title text-uppercase text-muted mb-0">Pelanggan</h5>
                  <span class="h2 font-weight-bold mb-0"><?php echo $total_customers; ?></span>
                </div>
                <div class="col-auto">
                  <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                    <i class="ni ni-circle-08"></i>
                  </div>
                </div>
              </div>
              <p class="mt-3 mb-0 text-sm">
                <span class="text-success mr-2"><i class="fa fa-arrow-up"></i></span>
                <span class="text-nowrap">Pelanggan yang terdaftar</span>
              </p>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-md-6">
          <div class="card card-stats">
            <!-- Card body -->
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <h5 class="card-title text-uppercase text-muted mb-0">Pesanan</h5>
                  <span class="h2 font-weight-bold mb-0"><?= get_order_perday_total($total_order); ?></span>
                </div>
                <div class="col-auto">
                  <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                    <i class="ni ni-chart-bar-32"></i>
                  </div>
                </div>
              </div>
              <?= get_order_perday($total_order) ?>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-md-6">
          <div class="card card-stats">
            <!-- Card body -->
            <div class="card-body">
              <div class="row">
                <div class="col">
                  <h5 class="card-title text-uppercase text-muted mb-0">Pendapatan</h5>
                  <span class="h2 font-weight-bold mb-0">Rp <?= get_income_perday_total($total_income); ?></span>
                </div>
                <div class="col-auto">
                  <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                    <i class="ni ni-money-coins"></i>
                  </div>
                </div>
              </div>
              <?= get_income_perday($total_income) ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Page content -->
<div class="container-fluid mt--6">
  <div class="row">
    <div class="col-xl-8">
      <div class="card bg-default">
        <div class="card-header bg-transparent">
          <div class="row align-items-center">
            <div class="col">
              <h6 class="text-light text-uppercase ls-1 mb-1">Ringkasan</h6>
              <h5 class="h3 text-white mb-0">Penjualan</h5>
              <p class="text-sm mb-0" style="color:white;">
                <?php if ($status_order > 0) {
                ?>
                  <i class="fa fa-arrow-up text-success"></i>
                  <span class="font-weight-bold" style="color:white;"><?= $status_order ?>% Meningkat</span> Pada Bulan <?= get_month($status_overviews[0]->month) ?>
                <?php } else if ($status_order < 0) { ?>
                  <i class="fa fa-arrow-down text-danger"></i>
                  <span class="font-weight-bold" style="color:white;"><?= $status_order ?>% Menurun</span> Pada Bulan <?= get_month($status_overviews[0]->month) ?>
                <?php } else if (!isset($status_order)) { ?>
                <?php } ?>
              </p>
            </div>
          </div>
        </div>
        <div class="card-body">
          <!-- Chart -->
          <div class="chart">
            <!-- Chart wrapper -->
            <canvas id="chart-sales-dark" class="chart-canvas"></canvas>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-4">
      <div class="card">
        <div class="card-header bg-transparent">
          <div class="row align-items-center">
            <div class="col">
              <h6 class="text-uppercase text-muted ls-1 mb-1">Ringkasan</h6>
              <h5 class="h3 mb-0">Pendapatan</h5>
              <p class="text-sm mb-0" style="color:black;">
                <?php if ($status_income > 0) {
                ?>
                  <i class="fa fa-arrow-up text-success"></i>
                  <span class="font-weight-bold" style="color:black;"><?= $status_income ?>% Meningkat</span> Pada Bulan <?= get_month($status_income_overviews[0]->month) ?>
                <?php } else if ($status_income < 0) { ?>
                  <i class="fa fa-arrow-down text-danger"></i>
                  <span class="font-weight-bold" style="color:black"><?= $status_income ?>% Menurun</span> Pada Bulan <?= get_month($status_income_overviews[0]->month) ?>
                <?php } ?>
              </p>
            </div>
          </div>
        </div>
        <div class="card-body">
          <!-- Chart -->
          <div class="chart">
            <canvas id="chart-bars" class="chart-canvas"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-xl-6">
      <div class="card" style="background-color:aquamarine">
        <div class="card-header bg-transparent">
          <div class="row align-items-center">
            <div class="col">
              <h6 class="text-uppercase text-muted ls-1 mb-1">Ringkasan</h6>
              <h5 class="h3 mb-0" id="produklaris">Produk Terlaris Bulan Lalu</h5>
              <div class="dropdown">
                <b>Pilih Bulan : </b>
                <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" style="padding:-15.375rem 1.1rem;" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Pilih Bulan
                </button>

                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a href="" class="dropdown-item bulan" data-bulan="1" onclick="return false">Bulan Lalu
                  </a>
                  <a href="" class="dropdown-item bulan" data-bulan="2" onclick="return false">2 Bulan Lalu
                  </a>
                  <a href="" class="dropdown-item bulan" data-bulan="3" onclick="return false">
                    3 Bulan Lalu</a>
                  <a href="" class="dropdown-item bulan" data-bulan="4" onclick="return false">
                    4 Bulan Lalu</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card-body">
          <!-- Chart -->
          <div class="chart" id="newchart">

          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-6">
      <div class="card" style="background-color:aquamarine">
        <div class="card-header bg-transparent">
          <div class="row align-items-center">
            <div class="col">
              <h6 class="text-uppercase text-muted ls-1 mb-1">Ringkasan</h6>
              <h5 class="h3 mb-0" id="kategorilaris">Kategori Produk Terlaris Bulan Lalu</h5>
              <div class="dropdown">
                <b>Pilih Bulan : </b>
                <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" style="padding:-15.375rem 1.1rem;" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Pilih Bulan
                </button>

                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a href="" class="dropdown-item kategori-bln" data-bulan="1" onclick="return false">Bulan Lalu
                  </a>
                  <a href="" class="dropdown-item kategori-bln" data-bulan="2" onclick="return false">2 Bulan Lalu
                  </a>
                  <a href="" class="dropdown-item kategori-bln" data-bulan="3" onclick="return false">
                    3 Bulan Lalu</a>
                  <a href="" class="dropdown-item kategori-bln" data-bulan="4" onclick="return false">
                    4 Bulan Lalu</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="card-body">
          <!-- Chart -->
          <div class="chart" id="kategorichart">
          </div>
        </div>
      </div>
    </div>




  </div>

  <div class="row">
    <div class="col-xl-4">
      <!-- Members list group card -->
      <div class="card">
        <!-- Card header -->
        <div class="card-header">
          <!-- Title -->
          <h5 class="h3 mb-0">Pelanggan baru</h5>
        </div>
        <!-- Card body -->
        <div class="card-body">
          <!-- List group -->
          <ul class="list-group list-group-flush list my--3">
            <?php foreach ($customers as $customer) : ?>
              <li class="list-group-item px-0">
                <div class="row align-items-center">
                  <div class="col-auto">
                    <!-- Avatar -->
                    <a href="#" class="avatar rounded-circle">
                      <img alt="Image placeholder" src="<?php echo base_url('assets/uploads/users/' . $customer->profile_picture); ?>">
                    </a>
                  </div>
                  <div class="col ml--2">
                    <h4 class="mb-0">
                      <a href="#!"><?php echo $customer->name; ?></a>
                    </h4>

                  </div>
                  <div class="col-auto">
                    <a href="<?php echo site_url('admin/customers/view/' . $customer->id); ?>" class="btn btn-sm btn-primary">Profil</a>
                  </div>
                </div>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
    </div>
    <div class="col-xl-4">
      <!-- Checklist -->
      <div class="card">
        <!-- Card header -->
        <div class="card-header">
          <!-- Title -->
          <h5 class="h3 mb-0">Order baru</h5>
        </div>
        <!-- Card body -->
        <div class="card-body p-0">
          <!-- List group -->
          <ul class="list-group list-group-flush" data-toggle="checklist">
            <?php foreach ($orders as $order) : ?>
              <li class="checklist-entry list-group-item flex-column align-items-start py-4 px-4">
                <div class="checklist-item checklist-item-info">
                  <div class="checklist-info">
                    <h5 class="checklist-title mb-0"><?php echo anchor('admin/orders/view/' . $order->id, 'Order #' . $order->order_number); ?></h5>
                    <small><?php echo $order->total_items; ?></small> | <small>Rp <?php echo format_rupiah($order->total_price); ?></small>
                  </div>
                </div>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
    </div>

    <div class="col-xl-4">
      <!-- Progress track -->
      <div class="card">
        <!-- Card header -->
        <div class="card-header">
          <!-- Title -->
          <h5 class="h3 mb-0">Pembayaran menunggu konfirmasi</h5>
        </div>
        <!-- Card body -->
        <div class="card-body">
          <!-- List group -->
          <ul class="list-group list-group-flush list my--3">
            <?php foreach ($payments as $payment) : ?>
              <li class="list-group-item px-0">
                <div class="row align-items-center">
                  <div class="col-auto">
                    <!-- Avatar -->
                    <a href="<?php echo site_url('admin/customers/view/' . $payment->user_id); ?>" class="avatar rounded-circle">
                      <img alt="Image placeholder" src="<?php echo base_url('assets/uploads/users/' . $payment->profile_picture); ?>">
                    </a>
                  </div>
                  <div class="col">
                    <h5>Order #<?php echo $payment->order_number; ?></h5>
                    <div>
                      Rp <?php echo format_rupiah($payment->payment_price); ?>
                    </div>
                  </div>
                </div>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-xl-8">
      <div class="card">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Produk baru</h3>
            </div>
            <div class="col text-right">
              <a href="<?php echo site_url('admin/products'); ?>" class="btn btn-sm btn-primary">Lihat semua</a>
            </div>
          </div>
        </div>
        <div class="table-responsive">
          <!-- Projects table -->
          <table class="table align-items-center table-flush">
            <thead class="thead-light">
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Nama</th>
                <th scope="col">Harga</th>
                <th scope="col">Stok</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($products as $product) : ?>
                <tr>
                  <th scope="col">
                    <?php echo $product->id; ?>
                  </th>
                  <td>
                    <?php echo $product->name; ?>
                  </td>
                  <td>
                    Rp <?php echo format_rupiah($product->price); ?>
                  </td>
                  <td>
                    <?php echo $product->stock; ?> <?php echo $product->product_unit; ?>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="col-xl-4">
      <div class="card">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Kategori produk</h3>
            </div>
            <div class="col text-right">
              <a href="<?php echo site_url('admin/products/category'); ?>" class="btn btn-sm btn-primary">Lihat semua</a>
            </div>
          </div>
        </div>
        <div class="table-responsive">
          <!-- Projects table -->
          <table class="table align-items-center table-flush">
            <thead class="thead-light">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Nama</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($categories as $category) : ?>
                <tr>
                  <th scope="col">
                    <?php echo $category->id; ?>
                  </th>
                  <td>
                    <?php echo $category->name; ?>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <script src="<?php echo get_theme_uri('vendor/chart.js/dist/Chart.min.js', 'argon'); ?>"></script>
  <script>
    //
    // Charts
    //

    'use strict';

    var Charts = (function() {

      // Variable

      var $toggle = $('[data-toggle="chart"]');
      var mode = 'light'; //(themeMode) ? themeMode : 'light';
      var fonts = {
        base: 'Open Sans'
      }

      // Colors
      var colors = {
        gray: {
          100: '#f6f9fc',
          200: '#e9ecef',
          300: '#dee2e6',
          400: '#ced4da',
          500: '#adb5bd',
          600: '#8898aa',
          700: '#525f7f',
          800: '#32325d',
          900: '#212529'
        },

        theme: {
          'default': '#14147a',
          'primary': '#4535b7',
          'secondary': '#f4f5f7',
          'info': '#11cdef',
          'success': '#2de8c4',
          'danger': '#f5365c',
          'warning': '#ffc410'
        },
        black: '#12263F',
        white: '#FFFFFF',
        transparent: 'transparent',
      };


      // Methods

      // Chart.js global options
      function chartOptions() {

        // Options
        var options = {
          defaults: {
            global: {
              responsive: true,
              maintainAspectRatio: false,
              defaultColor: (mode == 'dark') ? colors.gray[700] : colors.gray[600],
              defaultFontColor: (mode == 'dark') ? colors.gray[700] : colors.gray[600],
              defaultFontFamily: fonts.base,
              defaultFontSize: 14,
              layout: {
                padding: 0
              },
              legend: {
                display: false,
                position: 'bottom',
                labels: {
                  usePointStyle: true,
                  padding: 10,

                }
              },
              elements: {
                point: {
                  radius: 0,
                  backgroundColor: colors.theme['primary']
                },
                line: {
                  tension: .4,
                  borderWidth: 4,
                  borderColor: colors.theme['primary'],
                  backgroundColor: colors.transparent,
                  borderCapStyle: 'rounded'
                },
                rectangle: {
                  backgroundColor: colors.theme['warning']
                },
                arc: {
                  backgroundColor: colors.theme['primary'],
                  borderColor: (mode == 'dark') ? colors.gray[800] : colors.white,
                  borderWidth: 4
                }
              },
              tooltips: {
                enabled: true,
                mode: 'index',
                intersect: false,
              }
            },
            doughnut: {
              cutoutPercentage: 83,
              legendCallback: function(chart) {
                var data = chart.data;
                var content = '';

                data.labels.forEach(function(label, index) {
                  var bgColor = data.datasets[0].backgroundColor[index];

                  content += '<span class="chart-legend-item">';
                  content += '<i class="chart-legend-indicator" style="background-color: ' + bgColor + '"></i>';
                  content += label;
                  content += '</span>';
                });

                return content;
              }
            }
          }
        }

        // yAxes
        Chart.scaleService.updateScaleDefaults('linear', {
          gridLines: {
            borderDash: [2],
            borderDashOffset: [2],
            color: (mode == 'dark') ? colors.gray[900] : colors.gray[300],
            drawBorder: false,
            drawTicks: false,
            drawOnChartArea: true,
            zeroLineWidth: 0,
            zeroLineColor: 'rgba(0,0,0,0)',
            zeroLineBorderDash: [2],
            zeroLineBorderDashOffset: [2]
          },
          ticks: {
            beginAtZero: true,
            padding: 10,
            callback: function(value) {
              if (!(value % 10)) {
                return value
              }
            }
          }
        });

        // xAxes
        Chart.scaleService.updateScaleDefaults('category', {
          gridLines: {
            drawBorder: false,
            drawOnChartArea: false,
            drawTicks: false
          },
          ticks: {
            padding: 20
          },
          maxBarThickness: 10
        });

        return options;

      }

      // Parse global options
      function parseOptions(parent, options) {
        for (var item in options) {
          if (typeof options[item] !== 'object') {
            parent[item] = options[item];
          } else {
            parseOptions(parent[item], options[item]);
          }
        }
      }

      // Push options
      function pushOptions(parent, options) {
        for (var item in options) {
          if (Array.isArray(options[item])) {
            options[item].forEach(function(data) {
              parent[item].push(data);
            });
          } else {
            pushOptions(parent[item], options[item]);
          }
        }
      }

      // Pop options
      function popOptions(parent, options) {
        for (var item in options) {
          if (Array.isArray(options[item])) {
            options[item].forEach(function(data) {
              parent[item].pop();
            });
          } else {
            popOptions(parent[item], options[item]);
          }
        }
      }

      // Toggle options
      function toggleOptions(elem) {
        var options = elem.data('add');
        var $target = $(elem.data('target'));
        var $chart = $target.data('chart');

        if (elem.is(':checked')) {

          // Add options
          pushOptions($chart, options);

          // Update chart
          $chart.update();
        } else {

          // Remove options
          popOptions($chart, options);

          // Update chart
          $chart.update();
        }
      }

      // Update options
      function updateOptions(elem) {
        var options = elem.data('update');
        var $target = $(elem.data('target'));
        var $chart = $target.data('chart');

        // Parse options
        parseOptions($chart, options);

        // Toggle ticks
        toggleTicks(elem, $chart);

        // Update chart
        $chart.update();
      }

      // Toggle ticks
      function toggleTicks(elem, $chart) {

        if (elem.data('prefix') !== undefined || elem.data('prefix') !== undefined) {
          var prefix = elem.data('prefix') ? elem.data('prefix') : '';
          var suffix = elem.data('suffix') ? elem.data('suffix') : '';

          // Update ticks
          $chart.options.scales.yAxes[0].ticks.callback = function(value) {
            if (!(value % 10)) {
              return prefix + value + suffix;
            }
          }

          // Update tooltips
          $chart.options.tooltips.callbacks.label = function(item, data) {
            var label = data.datasets[item.datasetIndex].label || '';
            var yLabel = item.yLabel;
            var content = '';

            if (data.datasets.length > 1) {
              content += '<span class="popover-body-label mr-auto">' + label + '</span>';
            }

            content += '<span class="popover-body-value">' + prefix + yLabel + suffix + '</span>';
            return content;
          }

        }
      }


      // Events

      // Parse global options
      if (window.Chart) {
        parseOptions(Chart, chartOptions());
      }

      // Toggle options
      $toggle.on({
        'change': function() {
          var $this = $(this);

          if ($this.is('[data-add]')) {
            toggleOptions($this);
          }
        },
        'click': function() {
          var $this = $(this);

          if ($this.is('[data-update]')) {
            updateOptions($this);
          }
        }
      });


      // Return

      return {
        colors: colors,
        fonts: fonts,
        mode: mode
      };

    })();

    'use strict';

    //
    // Sales chart
    //

    var SalesChart = (function() {

      // Variables

      var $chart = $('#chart-sales-dark');


      // Methods

      function init($this) {
        var salesChart = new Chart($this, {
          type: 'line',
          options: {
            scales: {
              yAxes: [{
                gridLines: {
                  color: Charts.colors.gray[700],
                  zeroLineColor: Charts.colors.gray[700]
                },
                ticks: {

                }
              }]
            }
          },
          data: {
            labels: [
              <?php foreach ($order_overviews as $order) : ?> '<?php echo get_month($order->month); ?>',
              <?php endforeach; ?>
            ],
            datasets: [{
              label: 'Order',
              data: [
                <?php foreach ($order_overviews as $order) : ?>
                  <?php echo $order->sale; ?>,
                <?php endforeach; ?>
              ]
            }]
          }
        });

        // Save to jQuery object

        $this.data('chart', salesChart);

      };


      // Events

      if ($chart.length) {
        init($chart);
      }

    })();






    var BarsChart = (function() {

      //
      // Variables
      //

      var $chart = $('#chart-bars');


      //
      // Methods
      //

      // Init chart
      function initChart($chart) {

        // Create chart
        var ordersChart = new Chart($chart, {
          type: 'bar',
          data: {
            labels: [

              <?php if (count($income_overviews) > 0) {
                foreach ($income_overviews as $income) : ?> '<?php echo get_month($income->month); ?>',
              <?php endforeach;
              } else {
                echo '"No Data"';
              } ?>
            ],
            datasets: [{
              label: 'Pendapatan',
              data: [
                <?php if (count($income_overviews) > 0) {
                  foreach ($income_overviews as $income) : ?> '<?php echo $income->income; ?>',
                <?php endforeach;
                } else {
                } ?>
              ]
            }]
          }
        });

        // Save to jQuery object
        $chart.data('chart', ordersChart);
      }


      // Init chart
      if ($chart.length) {
        initChart($chart);
      }

    })();







    $(document).ready(function() {

      $('.bulan').click(function() {
        var data = $(this).attr('data-bulan');
        $.ajax({
          url: '<?php echo base_url('admin/change_bulan'); ?>',
          type: 'POST',
          data: {
            bulan: data
          },
          success: function(res) {
            var dat = JSON.parse(res);
            $('#produklaris').html((data == 1) ? '5 Produk Terlaris Bulan ini' : '5 Produk Terlaris ' + data + ' Bulan Lalu');
            if (dat.namabrg.length > 0) {
              $('#newchart').html('<canvas id="piechart"></canvas>');
              $('#piechart').chart = new Chart($('#piechart'), {
                type: 'pie',

                data: {
                  labels: dat.namabrg,

                  datasets: [{
                    label: 'Produk Terlaris',
                    data: dat.total,
                    backgroundColor: dat.warna,
                  }]
                },
                options: {
                  legend: {
                    display: true,
                    position: 'bottom',
                    labels: {
                      fontSize: 16,
                      fontColor: 'black'
                    }

                  }
                }
              });
            } else {
              $('#newchart').html(`<div style="width: 100%; height: 100%; position: relative;"> 
              <div style = "text-align: center; width: 100%; height: 100%; position: absolute; left: 0; top: 100px; z-index: 20;">
                    <b> Tidak ada Data Pada ${data} Bulan Lalu</b> </div>`);
            }
          }
        })
      });;
      var data = $('.bulan').attr('data-bulan');
      $.ajax({
        url: '<?php echo base_url('admin/change_bulan'); ?>',
        type: 'POST',
        data: {
          bulan: data
        },
        success: function(res) {
          var dat = JSON.parse(res);

          if (dat.namabrg.length > 0) {
            $('#newchart').html('<canvas id="piechart"></canvas>');
            $('#piechart').chart = new Chart($('#piechart'), {
              type: 'pie',

              data: {
                labels: dat.namabrg,

                datasets: [{
                  label: 'Produk Terlaris',
                  data: dat.total,
                  backgroundColor: dat.warna,
                }]
              },
              options: {
                legend: {
                  display: true,
                  position: 'bottom',
                  labels: {
                    fontSize: 16,
                    fontColor: 'black'
                  }

                }
              }
            });
          } else {
            $('#newchart').html(`<div style="width: 100%; height: 100%; position: relative;"> 
      <div style = "text-align: center; width: 100%; height: 100%; position: absolute; left: 0; top: 100px; z-index: 20;">
            <b> Tidak ada Data Pada ${data} Bulan Lalu</b> </div>`);
          }
        }
      })
    });


    /// Kategori
    $(document).ready(function() {
      $('.kategori-bln').click(function() {
        var data = $(this).attr('data-bulan');
        console.log(data);
        $.ajax({
          url: '<?php echo base_url('admin/change_kategori'); ?>',
          type: 'POST',
          data: {
            bulan: data
          },
          success: function(res) {
            var dat = JSON.parse(res);
            $('#kategorilaris').html((data == 1) ? '5 Kategori Produk Terlaris Bulan ini' : '5 Kategori Produk Terlaris ' + data + ' Bulan Lalu');
            if (dat.namaktgr.length > 0) {
              $('#kategorichart').html('<canvas id="kategorichartpie"></canvas>');
              $('#kategorichartpie').chart = new Chart($('#kategorichartpie'), {
                type: 'pie',

                data: {
                  labels: dat.namaktgr,

                  datasets: [{
                    label: 'Kategori Terlaris',
                    data: dat.total,
                    backgroundColor: dat.warna,
                  }]
                },
                options: {
                  legend: {
                    display: true,
                    position: 'bottom',
                    labels: {
                      fontSize: 16,
                      fontColor: 'black'
                    }

                  }
                }
              });
            } else {
              $('#kategorichart').html(`<div style="width: 100%; height: 100%; position: relative;"> 
      <div style = "text-align: center; width: 100%; height: 100%; position: absolute; left: 0; top: 100px; z-index: 20;">
            <b> Tidak ada Data Pada ${data} Bulan Lalu</b> </div>`);
            }
          }
        })
      });;
      var data = $('.kategori-bln').attr('data-bulan');
      $.ajax({
        url: '<?php echo base_url('admin/change_kategori'); ?>',
        type: 'POST',
        data: {
          bulan: data
        },
        success: function(res) {
          var dat = JSON.parse(res);
          if (dat.namaktgr.length > 0) {
            $('#kategorichart').html('<canvas id="kategorichartpie"></canvas>');
            $('#kategorichartpie').chart = new Chart($('#kategorichartpie'), {
              type: 'pie',
              data: {
                labels: dat.namaktgr,

                datasets: [{
                  label: 'Kategori Terlaris',
                  data: dat.total,
                  backgroundColor: dat.warna,
                }]
              },
              options: {
                legend: {
                  display: true,
                  position: 'bottom',
                  labels: {
                    fontSize: 16,
                    fontColor: 'black'
                  }

                }
              }
            });
          } else {
            $('#kategorichart').html(`<div style="width: 100%; height: 100%; position: relative;"> 
      <div style = "text-align: center; width: 100%; height: 100%; position: absolute; left: 0; top: 100px; z-index: 20;">
            <b> Tidak ada Data Pada ${data} Bulan Lalu</b> </div>`);
          }
        }
      })
    })
  </script>