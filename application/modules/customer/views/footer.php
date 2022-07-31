<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<footer class="main-footer">
  <strong>Copyright &copy; 2022 <?php echo anchor(base_url(), get_store_name()); ?>.</strong>
</footer>

<aside class="control-sidebar control-sidebar-dark">
</aside>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="<?php echo get_theme_uri('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js', 'adminlte'); ?>"></script>
<script src="<?php echo get_theme_uri('js/jquery-2.2.3.min.js', 'adminlte'); ?>"></script>
<script src="<?php echo get_theme_uri('js/jquery.slimscroll.min.js', 'adminlte'); ?>"></script>
<script src="<?php echo get_theme_uri('js/app.min.js', 'adminlte'); ?>"></script>
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script>
  // Enable pusher logging - don't include this in production
  Pusher.logToConsole = true;

  var pusher = new Pusher('b28d4dddd82d250356b4', {
    cluster: 'ap1'
  });

  var channel = pusher.subscribe('my-channel');
  channel.bind('my-event', function(data) {
    alert(JSON.stringify(data));
  });
</script>
<script>
  const pol1 = $('.sukses').data('sukses');
  if (pol1) {
    Swal.fire({
      position: 'top-center',
      html: '<div class="alert alert-success" role="alert">' + pol1 + '</div > ',
      showConfirmButton: false,
      background: '#FF4500',
      showClass: {
        popup: 'animate__animated animate__fadeInDown'
      },
      hideClass: {
        popup: 'animate__animated animate__fadeOutUp'
      },
      timer: 1500,
    })
  }
</script>
<!-- Timer -->
<script>
  var timer = () => {
    setInterval(function() {
      var count = $('.notif').val()
      var baseurl = $('#base').val()
      var now = new Date().getTime();
      for (i = 1; i <= count; i++) {
        var time = $(`.date${i}`).val();
        var idlink = $(`.idlink${i}`).val();
        var link = $(`.link${i}`)
        link.attr('href', baseurl + idlink + "/read")
        var restime = new Date(time).getTime();
        var diff = now - restime;
        var d = Math.floor(diff % (1000 * 60 * 60 * 24 * 365) / (1000 * 60 * 60 * 24));
        var h = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var m = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
        console.log(m, h, d)
        if (h > 0 && h <= 24 && d == 0 && d == 0) {
          $(`.time${i}`).html(`<small><i class="fa fa-clock">${h} Jam Yang Lalu</i></small>`);
        } else if (d > 0 && d <= 365) {
          $(`.time${i}`).html(`<small><i class="fa fa-clock">${d} Hari Yang Lalu</i></small>`);
        } else {
          $(`.time${i}`).html(`<small><i class="fa fa-clock">${m} Menit Yang Lalu</i></small>`);
        }
      }
    }, 1000);
  }
  timer();
</script>
<!-- End Timer -->

<!--  Diubah -->
<script>
  var a = $('#waktu').val();
  var ubah = () => {
    var b = $('#orders').val();
    $.ajax({
      method: 'POST',
      url: '<?php echo site_url('customer/payments/change'); ?>',
      data: {
        id: b,
      },
      success: (res) => {
        if (res.code == 200) {
          var a = JSON.parse(res.data.delivery_data);
          $('#banknam').val(a.bank);
          $('#nopem').val(a.va_number);
          $('#waktu').val(a.waktu_transaksi);
          $('.byar').attr('href', a.pdf_url);
          return a = a.waktu_transaksi

        } else {
          $('#banknam').val('Tidak Ada Data');
          $('#nopem').val('Tidak Ada Data');
          $('#waktu').val('Tidak Ada Data');
        }
      }
    });
  }
  var time = () => {
    var b = new Date(a).getTime();
    var date = b + (4 * 60 * 60 * 1000);
    setInterval(function() {
        var diff = date - new Date().getTime();
        var h = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var m = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
        var s = Math.floor((diff % (1000 * 60)) / (1000));
        var hours = ("0" + h).slice(-1);
        var minutes = ("0" + m).slice(-2);
        var seconds = ("0" + s).slice(-2);
        var time = hours + ":" + minutes + ":" + seconds;
        $('.waktu').html('Waktu Pembayaran Anda : ' + time);
        if (diff < 0) {
          $('.waktu').html('Waktu Pembayaran Anda : 00:00:00');
          var name = $('#cusname').val();
          $.ajax({
            method: 'POST',
            url: '<?php echo site_url('customer/orders/order_api?action=cancel_order'); ?>',
            data: {
              id: <?php echo $_GET['order']; ?>,
              name: name,

            },
            success: function(res) {}
          });

        }

      },
      1000);
  }
  time()
</script>
<!-- Elapsed in {elapsed_time} times  -->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>