<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!-- Footer -->
<footer class="footer pt-0">
  <div class="row align-items-center justify-content-lg-between">
    <div class="col-lg-6">
      <div class="copyright text-center text-lg-left text-muted">
        &copy; 2020 <a href="#" class="font-weight-bold ml-1" target="_blank"><?php echo get_store_name(); ?></a>
      </div>
    </div>
  </div>
</footer>
</div>
</div>

<!-- Argon Scripts -->


<!-- Core -->
<script src="<?php echo get_theme_uri('vendor/js-cookie/js.cookie.js', 'argon'); ?>"></script>
<script src="<?php echo get_theme_uri('vendor/jquery.scrollbar/jquery.scrollbar.min.js', 'argon'); ?>"></script>
<script src="<?php echo get_theme_uri('vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js', 'argon'); ?>"></script>
<!-- Argon JS -->
<script src="<?php echo get_theme_uri('vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js', 'argon'); ?>"></script>
<script src="<?php echo get_theme_uri('js/argon9f1e.js?v=1.1.0', 'argon'); ?>"></script>
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
</body>

</html>