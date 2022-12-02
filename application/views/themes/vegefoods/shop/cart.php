<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<style>
  .pp {
    border-radius: 11px;
    background: #dddbdb !important;
    border: 3px solid black;
    width: 83%;
  }
</style>
<div class="hero-wrap hero-bread" style="background-image: url('<?php echo get_theme_uri('images/bg_10.jpg'); ?>');">
  <div class="container">
    <div class="row no-gutters slider-text align-items-center justify-content-center">
      <div class="col-md-9 ftco-animate text-center">
        <p class="breadcrumbs"><span class="mr-2"><?php echo anchor(base_url(), 'Home'); ?></span> <span>Keranjang Belanja</span></p>
        <h1 class="mb-0 bread">Keranjang Belanja Saya</h1>
      </div>
    </div>
  </div>
</div>

<section class="ftco-section ftco-Keranjang Belanja">
  <div class="container">
    <div id="ganti0">
      <?php if (count($carts) > 0) : ?>
        <form action="<?php echo site_url('shop/checkout'); ?>" method="POST">
          <div class="row">
            <div class="col-md-12 ftco-animate">
              <div class="cart-list">
                <table class="table">
                  <thead class="thead-primary">
                    <tr class="text-center">
                      <th>Aksi</th>
                      <th>&nbsp;</th>
                      <th>Produk</th>
                      <th>Harga</th>
                      <th>Kuantitas</th>
                      <th>Sub Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 0;

                    foreach ($carts as $item) : ?>
                      <tr class="text-center cart-<?php echo $item['rowid']; ?>">
                        <td class="product-remove"><a href="#" class="remove-item" data-rowid="<?php echo $item['rowid']; ?>"><span class="ion-ios-close"></span></a></td>

                        <td class="image-prod">
                          <div class="img img-fluid rounded" style="background-image:url(<?php echo get_product_image($item['id']); ?>);"></div>
                        </td>

                        <td class="product-name">
                          <h3><?php echo $item['name']; ?></h3>
                        </td>
                        <input type="hidden" name="item[<?= $i ?>]" value="<?= $item['name']; ?>">
                        <td class="price">Rp <?php echo format_rupiah($item['price']); ?></td>
                        <input type="hidden" id="harga<?= $i ?>" name="prc[<?= $i; ?>]" onkeyup="qq();" value="<?= $item['price'] ?>">
                        <td class="quantity">
                          <div class="input-group mb-3">
                            <input type="text" id="total<?= $i ?>" onkeyup="qq();" name="quantity[<?php echo $item['rowid']; ?>]" class="quantity form-control input-number" value="<?php echo $item['qty']; ?>" min="1" max="100" required>
                          </div>
              </div>
              <?php if ($this->session->flashdata('error1')) { ?>
                <div class="error1" data-error="<?= $this->session->userdata('error1'); ?>"></div>
              <?php $this->session->unset_userdata('error1');
                      } ?>
              <?php if ($this->session->flashdata('error')) { ?>
                <div class="error" data-error="<?= $this->session->userdata('error'); ?>"></div>
              <?php $this->session->unset_userdata('error');
                      } ?>
              </td>

              <td class="total" id="tot<?= $i ?>">Rp <?php echo format_rupiah($item['subtotal']); ?></td>
              </tr><!-- END TR-->
            <?php $i++;
                    endforeach; ?>
            <input type="hidden" id="angka" value="<?= count($carts) ?>">
            <input type="hidden" id="newangka" value="<?= count($carts) ?>">

            </tbody>
            </table>
            </div>
          </div>
    </div>
    <div class="row justify-content-end">
      <div class="col-lg-4 mt-5 cart-wrap ftco-animate">
        <div class="cart-total mb-3">
          <h3>Kode Kupon</h3>
          <p>Punya kode kupon? Gunakan kupon kamu untuk mendapatkan potongan harga menarik</p>

          <div class="form-group">
            <label for="code">Kode:</label>
            <input id="code" name="coupon_code" type="text" class="form-control text-left px-3" placeholder="">
          </div>

        </div>

      </div>
      <div class="col-lg-4 mt-5 cart-wrap ftco-animate">
        <div class="cart-total mb-3">
          <h3>Rincian Keranjang</h3>
          <input type="hidden" value="<?= $total_cart ?>" id="subtott">
          <p class="d-flex">
            <span>Subtotal</span>
            <span class="n-subtotal font-weight-bold total1">
              Rp <?php echo format_rupiah($total_cart); ?>
              <span>
              </span>
          </p>
          <?php
          if (get_settings('flat_ongkir') == 0) { ?>
            <div style="display:block" id="pilih">
              <select class="form-control dropdown-toggle pp" name="ongkir" id="qqp" data-toggle="select" title="Simple select" data-live-search="true" data-live-search-placeholder="Search ..." onchange="qq()">
                <option value="">Pilih Wilayah Pengiriman
                </option>
                <?php foreach ($ongkir as $ongkip) : ?>
                  <option value="<?php echo $ongkip->tarif; ?>"><?php echo $ongkip->wilayah; ?> (Rp.<?= format_rupiah($ongkip->tarif) ?>)</option>
                <?php endforeach; ?>
              </select>
            </div>
            <div style="display:none" id="ongkirl">
            <?php } else {  ?>
              <input type="hidden" name="ongkir" id="qqp" value="<?= get_settings('shipping_cost') ?>">
              <div id="ongkirl">
              <?php } ?>

              <p class="d-flex">
                <span>Biaya pengiriman</span>
                <input type="hidden" value="<?= get_settings('min_shop_to_free_shipping_cost') ?>" class="minpem">
                <?php if ($total_cart >= get_settings('min_shop_to_free_shipping_cost')) : ?>
                  <span class="n-ongkir font-weight-bold total2">Gratis</span>

                <?php else : ?>

                  <span class="n-ongkir font-weight-bold total2"><?= (get_settings('flat_ongkir') == 0) ? '' : 'Rp.' . format_rupiah(get_settings('shipping_cost')) ?> </span>
                <?php endif; ?>
              </p>
              </div>
              <hr>
              <?php if (get_settings('flat_ongkir') == 0) { ?>
                <div style="display:none" id="restot">
                <?php } else { ?>
                  <div id="restot">
                  <?php  } ?>
                  <p class="d-flex total-price">
                    <span>Total</span>
                    <span class="n-total font-weight-bold pot">Rp.<?= format_rupiah($total_price) ?></span>
                  </p>
                  </div>
                </div>
                <?php if (get_settings('flat_ongkir') == 0) { ?>

                  <div id="buton" style="display:none">
                  <?php } else { ?>
                    <div id="buton">
                    <?php  } ?>
                    <p><button type="submit" class="btn btn-primary px-4">Bayar</button></p>
                    </div>
                  </div>
            </div>
            </form>
          <?php else : ?>
            <div class="row">
              <div class="col-md-12 ftco-animate">
                <div class="alert alert-info"> Tidak ada barang dalam keranjang.<br><?php echo anchor('', 'Jelajahi produk kami'); ?> dan mulailah berbelanja!</div>
              </div>
            </div>
          <?php endif; ?>
        </div>
      </div>
</section>
<script>
  ///Update Harga
  var a = $('#angka').val();
  var bqqq = $('#newangka').val()

  const rupiah = (number) => {
    return new Intl.NumberFormat("id-ID", {
      style: "currency",
      currency: "IDR"
    }).format(number);
  }
  var subtott = parseInt($('#subtott').val());
  var minpem1 = parseInt($('.minpem').val());
  var but = $('#buton');
  var pilih1 = $('#pilih');
  var restot = $('#restot')
  var ongkirl = $('#ongkirl');


  if (subtott >= minpem1) {
    ongkirl.attr('style', 'display:block');
    restot.attr('style', 'display:block');
    but.attr('style', 'display:block');
    pilih1.attr('style', 'display:none');
  }

  const qq = () => {
    var respos = 0;
    for (let i = 0; i < a; i++) {
      var total = $(`#total${i}`).val();
      var harga = $(`#harga${i}`).val();
      if (total == undefined && harga == undefined) {
        continue;
      }
      if (total == 0) {
        total = 0;
      } else {
        total = total;
      }
      var result = parseInt(harga) * parseInt(total);
      respos += result;
      if (!isNaN(respos)) {
        $(`#tot${i}`).html(rupiah(result));
        $('.total1').html(rupiah(respos));
      } else {
        if (total == 0) {
          $(`#tot${i}`).html(rupiah(0));
        }
      }

    }
    ///end for
    var pilih = $('#pilih')
    var ongkirl = $('#ongkirl')
    var minpem = $('.minpem').val();
    var restot = $('#restot')
    var but = $('#buton')
    var ongkir = $('#qqp').val();
    if (minpem > 0) {
      if (respos < minpem) {
        if (ongkir == '') {
          pilih.attr('style', 'display:block');
          ongkirl.attr('style', 'display:none');
          restot.attr('style', 'display:none');
          but.attr('style', 'display:none');
          ongkir = 0;
        } else {
          ongkirl.attr('style', 'display:block');
          pilih.attr('style', 'display:none');
        }
        $('.total2').html(rupiah(ongkir));

      } else {
        ongkir = 0;
        pilih.attr('style', 'display:none');
        ongkirl.attr('style', 'display:block');
        $('.total2').html('Gratis');
        but.attr('style', 'display:block');
        restot.attr('style', 'display:block');
      }
    } else if (minpem == 0) {
      ongkir = 0
    }

    if (ongkir != '') {
      but.attr('style', 'display:block');
      restot.attr('style', 'display:block');
    }
    respos = parseInt(ongkir) + parseInt(respos);
    $('.pot').html(rupiah(respos));

  }

  /////remove
  $('.remove-item').click(function(e) {
    e.preventDefault();
    var rowid = $(this).data('rowid');
    var tr = $('.cart-' + rowid);

    $('.product-name', tr).html('<i class="fa fa-spin fa-spinner"></i> Menghapus...');

    $.ajax({
      method: 'POST',
      url: '<?php echo site_url('shop/cart_api?action=remove_item'); ?>',
      data: {
        rowid: rowid
      },
      success: function(res) {
        if (res.code == 204) {
          if (res.total.subtotal == 0) {
            $('#ganti0').html(`<div class="row">
            <div class="col-md-12 fadeInUp ftco-animated">
              <div class="alert alert-info"> Tidak ada barang dalam keranjang.<br><?php echo anchor('', 'Jelajahi produk kami'); ?> dan mulailah berbelanja!</div>
            </div>
          </div>`);
          }
          var ressisa = parseInt(bqqq) - 1
          bqqq = ressisa;
          $('.cart-item-total').html(bqqq);
          tr.addClass('alert alert-danger');
          setTimeout(function(e) {
            tr.hide('fade');
            tr.remove();
            var subtott = $('#subtott');
            subtott.attr('value', res.total.subtotal);
            qq()

          }, 1000);
        }
      }
    })
  })
</script>