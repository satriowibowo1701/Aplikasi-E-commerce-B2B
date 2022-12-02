<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<style>
  .card {
    margin-bottom: 53px;
  }
</style>
<!-- Header -->
<div class="header bg-primary pb-6">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          <h6 class="h2 text-white d-inline-block mb-0">Pengaturan Situs</h6>
        </div>
        <div class="col-lg-6 col-5 text-right">
          <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
              <li class="breadcrumb-item"><a href="<?php echo site_url('admin'); ?>"><i class="fas fa-home"></i></a></li>
              <li class="breadcrumb-item active" aria-current="page">Pengaturan</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Page content -->
<div class="container-fluid mt--6">
  <?php echo form_open_multipart('admin/settings/update'); ?>

  <div class="row">
    <div class="col-md-8">
      <div class="card-wrapper">
        <div class="card">
          <div class="card-header">
            <h3 class="mb-0">Identitas Toko</h3>
            <?php if ($flash) : ?>
              <span class="float-right text-success font-weight-bold" style="margin-top: -30px">
                <?php echo $flash;
                ?>
              </span>
            <?php endif; ?>
          </div>

          <div class="card-body">

            <div class="form-group">
              <label class="form-control-label" for="name">Nama toko:</label>
              <input type="text" name="store_name" value="<?php echo set_value('store_name', get_settings('store_name')); ?>" class="form-control" id="name">
              <?php echo form_error('store_name'); ?>
            </div>

            <div class="row">
              <div class="col-6">
                <div class="form-group">
                  <label class="form-control-label" for="phone_number">No. HP:</label>
                  <input type="text" name="store_phone_number" value="<?php echo set_value('store_phone_number', get_settings('store_phone_number')); ?>" class="form-control" id="phone_number">
                  <?php echo form_error('store_phone_number'); ?>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group">
                  <label class="form-control-label" for="email">Email:</label>
                  <input type="text" name="store_email" value="<?php echo set_value('store_email', get_settings('store_email')); ?>" class="form-control" id="email">
                  <?php echo form_error('store_email'); ?>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-4">
                <div class="form-group">
                  <label class="form-control-label" for="phone_number">Server Key Midtrans </label> <i class="fas fa-info-circle" data-toggle="modal" data-target="#InfoMidtransModal"></i>
                  <input type="text" name="server_key" value="<?php echo set_value('server_key', get_settings('server_key')); ?>" class="form-control" id="phone_number">

                </div>
              </div>
              <div class="col-4">
                <div class="form-group">
                  <label class="form-control-label" for="email">Client Key Midtrans </label> <i class="fas fa-info-circle" data-toggle="modal" data-target="#InfoMidtransModal"></i>
                  <input type="text" name="client_key" value="<?php echo set_value('client_key', get_settings('client_key')); ?>" class="form-control" id="email">

                </div>
              </div>
              <div class="col-4">
                <div class="form-group">
                  <label class="form-control-label" for="email">Email Secret Key </label> <i class="fas fa-info-circle" data-toggle="modal" data-target="#InfoEmailModal"></i>
                  <input type="text" name="pass_mail" value="<?php echo set_value('pass_mail', get_settings('pass_mail')); ?>" class="form-control" id="email">

                </div>
              </div>
            </div>

            <div class="form-group">
              <label class="form-control-label" for="address">Alamat:</label>
              <textarea name="store_address" class="form-control" id="address"><?php echo set_value('store_address', get_settings('store_address')); ?></textarea>
              <?php echo form_error('store_address'); ?>
            </div>

            <div class="form-group">
              <label class="form-control-label" for="tagline">Tagline:</label>
              <input type="text" name="store_tagline" value="<?php echo set_value('store_tagline', get_settings('store_tagline')); ?>" class="form-control" id="tagline">
              <?php echo form_error('store_tagline'); ?>
            </div>

            <div class="form-group">
              <label class="form-control-label" for="description">Deskripsi:</label>
              <textarea name="store_description" class="form-control" id="description"><?php echo set_value('store_description', get_settings('store_description')); ?></textarea>
              <?php echo form_error('store_description'); ?>
            </div>

          </div>

        </div>

        <div class="card">
          <div class="card-header">
            <h3 class="mb-0">Pengaturan Pembayaran</h3>
            <button type="button" data-toggle="modal" data-target="#addBankModal" class="btn btn-outline-primary btn-add float-right btn-sm" style="margin-top: -30px;"><i class="fas fa-plus-square"></i></button>
          </div>
          <div class="card-body">
            <?php if (is_array($banks) && count($banks) > 0) : ?>
              <?php $n = 0; ?>
              <div class="increment">
                <?php foreach ($banks as $slug => $bank) : ?>

                  <div class="row alert alert-info bank-data">
                    <div class="col-12">
                      <div class="form-group">
                        <label for="">Nama bank:</label>
                        <input type="text" class="form-control" name="banks[<?php echo $n; ?>][bank]" value="<?php echo $bank->bank; ?>">
                      </div>
                    </div>
                    <div class="col-6">
                      <label for="">No. Rekening:</label>
                      <input type="text" class="form-control" name="banks[<?php echo $n; ?>][number]" value="<?php echo $bank->number; ?>">
                    </div>
                    <div class="col-6">
                      <label for="">Nama pemilik:</label>
                      <input type="text" class="form-control" name="banks[<?php echo $n; ?>][name]" value="<?php echo $bank->name; ?>">
                    </div>
                  </div>

                  <?php $n++; ?>
                <?php endforeach; ?>
              </div>
            <?php else : ?>
              <div class="alert alert-info alert-zero">
                Belum ada data bank yang ditambahkan. Tambahkan yang pertama!
                <br>
                (Tekan tombol + dikanan untuk menambah)
              </div>
            <?php endif; ?>
          </div>
          <div class="card-footer">

          </div>
        </div>

      </div>
    </div>

    <div class="col-md-4" style="margin-bottom:0%;">
      <div class="card">
        <div class="card-header">
          <h3 class="mb-0">Logo</h3>
        </div>
        <div class="card-body">
          <div class="form-group">
            <label class="form-control-label" for="pic">Foto:</label>
            <input type="file" name="picture" class="form-control" id="pic">
            <small class="text-muted">Pilih foto PNG atau JPG dengan ukuran maksimal 2MB</small>
          </div>
        </div>
      </div>
      <div class="card" style="margin-top:0%;">
        <div class="card-header">
          <h3 class="mb-0">Slide Show</h3>
        </div>
        <div class="card-body">
          <div class="form-group">
            <div class="nav-wrapper">
              <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                <li class="nav-item">
                  <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i class="ni ni-cloud-upload-96 mr-2"></i>Slide 1</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><i class="ni ni-cloud-upload-96 mr-2"></i>Slide 2</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-3-tab" data-toggle="tab" href="#tabs-icons-text-3" role="tab" aria-controls="tabs-icons-text-3" aria-selected="false"><i class="ni ni-cloud-upload-96 mr-2"></i>Slide 3</a>
                </li>
              </ul>
            </div>
            <div class="card shadow">
              <div class="card-body">
                <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                    <label class="form-control-label" for="pic1">Foto:</label>
                    <input type="file" name="picture1" class="form-control" id="pic1">
                    <small class="text-muted">Pilih foto PNG atau JPG dengan ukuran maksimal 2MB</small>
                    <label class="form-control-label" for="slider1">Isi Konten</label>
                    <input type="text" name="konten1" class="form-control" id="slider1" value="<?= $slider[0]['konten'] ?>">

                  </div>
                  <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                    <label class="form-control-label" for="pic2">Foto:</label>
                    <input type="file" name="picture2" class="form-control" id="pic2">
                    <small class="text-muted">Pilih foto PNG atau JPG dengan ukuran maksimal 2MB</small>
                    <label class="form-control-label" for="slider2">Isi Konten</label>
                    <input type="text" name="konten2" class="form-control" id="slider2" value="<?= $slider[1]['konten'] ?>">
                  </div>
                  <div class="tab-pane fade" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                    <label class="form-control-label" for="pic3">Foto:</label>
                    <input type="file" name="picture3" class="form-control" id="pic3">
                    <small class="text-muted">Pilih foto PNG atau JPG dengan ukuran maksimal 2MB</small>
                    <label class="form-control-label" for="slider3">Isi Konten</label>
                    <input type="text" name="konten3" class="form-control" id="slider3" value="<?= $slider[2]['konten'] ?>">
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>

      <div class="card">
        <div class="card-header">
          <h3 class="mb-0">Belanja</h3>
        </div>
        <div class="card-body">
          <div class="form-group">
            <label class="form-control-label" for="ongkir">Aktifkan Flat Ongkir:</label>
            <div class="input-group mb-3">
              <label class="custom-toggle ">
                <?php if (get_settings('flat_ongkir') == 0) { ?>
                  <input type="checkbox" id="flat">
                <?php   } else {
                ?>
                  <input type="checkbox" checked id="flat">
                <?php  } ?>
                <span class="custom-toggle-slider rounded-circle" onclick="tes()" data-flat="<?= (get_settings('flat_ongkir') == 0) ? 0 : 1 ?>" id="dataflat"></span>
              </label>
            </div>

            <div class="input-group mb-3" id="ongkirflatt" <?= (get_settings('flat_ongkir') == 0) ? 'hidden' : '' ?>>
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Rp</span>
              </div>
              <input type="text" name="shipping_cost" value="<?php echo set_value('shipping_cost', get_settings('shipping_cost')); ?>" class="form-control" id="ongkir">
            </div>
            <?php echo form_error('shipping_cost'); ?>
          </div>

          <div class="form-group">
            <label class="form-control-label" for="free_ongkir">Minimal belanja untuk gratis ongkir:</label>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Rp</span>
              </div>
              <input type="text" name="min_shop_to_free_shipping_cost" value="<?php echo set_value('min_shop_to_free_shipping_cost', get_settings('min_shop_to_free_shipping_cost')); ?>" class="form-control" id="free_ongkir">
            </div>
            <?php echo form_error('min_shop_to_free_shipping_cost'); ?>
          </div>
        </div>
      </div>

      <div class="card">
        <div class="card-body">
          <input type="submit" value="Simpan" class="btn btn-primary" style="margin-bottom: 12;">
        </div>
      </div>

      <div class="card">
        <div class="card-header">
          <h3 class="mb-0">Pengaturan Ongkir</h3>
          <button type="button" data-toggle="modal" data-target="#addOngkirModal" class="btn btn-outline-primary btn-add float-right btn-sm" style="margin-top: -30px;"><i class="fas fa-plus-square"></i></button>
        </div>
        <div class="card-body">
          <?php if (count($ongkir) > 0) : ?>
            <?php $n = 0; ?>
            <div class="increment">
              <?php foreach ($ongkir as $newongkir) : ?>

                <div class="row alert alert-info bank-data">
                  <div class="col-12">
                    <div class="form-group">
                      <label for="">Wilayah:</label>
                      <input type="text" class="form-control" name="ongkirs[<?php echo $n; ?>][wilayah]" value="<?php echo $newongkir->wilayah; ?>">
                    </div>
                  </div>
                  <div class="col-12">
                    <label for="">Tarif:</label>
                    <input type="text" class="form-control" name="ongkirs[<?php echo $n; ?>][tarif]" value="<?php echo $newongkir->tarif; ?>">
                  </div>
                </div>

                <?php $n++; ?>
              <?php endforeach; ?>
            </div>
          <?php else : ?>
            <div class="alert alert-info alert-zero">
              Belum ada data bank yang ditambahkan. Tambahkan yang pertama!
              <br>
              (Tekan tombol + dikanan untuk menambah)
            </div>
          <?php endif; ?>
        </div>
      </div>


    </div>
  </div>

  </form>

  <div class="modal fade" id="addBankModal" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-body p-0">
          <div class="card bg-secondary border-0 mb-0">
            <div class="card-header bg-transparent">
              <h3 class="card-heading text-center mt-2">Tambah Rekening Bank</h3>
            </div>
            <div class="card-body px-lg-5 py-lg-5">
              <form role="form" action="<?php echo site_url('admin/settings/add_bank'); ?>" method="POST" id="addCouponForm">

                <div class="row">
                  <div class="col-12">
                    <div class="form-group">
                      <label for="">Nama bank:</label>
                      <input type="text" class="form-control" name="bank">
                    </div>
                  </div>
                  <div class="col-6">
                    <label for="">No. Rekening:</label>
                    <input type="text" class="form-control" name="number">
                  </div>
                  <div class="col-6">
                    <label for="">Nama pemilik:</label>
                    <input type="text" class="form-control" name="name">
                  </div>
                </div>

                <div class="text-left">
                  <button type="button" class="btn btn-secondary my-4" data-dismiss="modal">Batal</button>
                </div>
                <div class="float-right" style="margin-top: -90px">
                  <button type="submit" class="btn btn-primary my-4 addPackageBtn">Tambah</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="addOngkirModal" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-body p-0">
          <div class="card bg-secondary border-0 mb-0">
            <div class="card-header bg-transparent">
              <h3 class="card-heading text-center mt-2">Tambah Data Ongkir</h3>
            </div>
            <div class="card-body px-lg-5 py-lg-5">
              <form role="form" action="<?php echo site_url('admin/settings/add_ongkir'); ?>" method="POST" id="addCouponForm">

                <div class="row">
                  <div class="col-12">
                    <div class="form-group">
                      <label for="">Nama Kecamatan:</label>
                      <input type="text" class="form-control" name="wilayah">
                    </div>
                  </div>
                  <div class="col-12">
                    <label for="">Tarif:</label>
                    <input type="text" class="form-control" name="tarif">
                  </div>

                </div>

                <div class="text-left">
                  <button type="button" class="btn btn-secondary my-4" data-dismiss="modal">Batal</button>
                </div>
                <div class="float-right" style="margin-top: -90px">
                  <button type="submit" class="btn btn-primary my-4 addPackageBtn">Tambah</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="InfoMidtransModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Server-Key Dan Client-Key Midtrans</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Cara melihat server-key midtrans dan client-key midtrans:
          <ol>
            <li>Login ke midtrans.com</li>
            <li>Klik menu setting</li>
            <li>Klik menu API</li>
            <li>Klik menu server key</li>
            <li>Copy server key</li>
          </ol>
          Gambar :
          <br>
          <img src="https://docs.midtrans.com/asset/image/snap-prep-access-keys.png" alt="" width="450px;" height="450px;">
        </div>
      </div>
    </div>
  </div>


  <div class="modal fade" id="InfoEmailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Cara Mendapatkan Email Secret Key</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="stopVideo()">
            <span aria-hidden="true" onclick="stopVideo()">&times;</span>
          </button>
        </div>
        <div class=" modal-body">
          <iframe width="420" height="315" class="yt_player_iframe" src="https://www.youtube.com/embed/HtqBZwTKRvY?enablejsapi=1&version=3&playerapiid=ytplayer" id="vidio" allowfullscreen="true" allowscriptaccess="always" frameborder="0">
          </iframe>
        </div>
      </div>
    </div>
  </div>

  <script>
    jQuery(document).ready(function() {
      let no = $('.bank-data').length;
      jQuery(".btn-add").click(function() {

      });
      jQuery("body").on("click", ".btn-remove", function() {
        jQuery(this).parents(".input-group").remove();

        let zero = $('.alert-zero');
        if (zero.length > 0) {
          zero.show('fade')
        }
      })
    })

    function tes() {
      //ajax
      var flat = $('#dataflat').attr('data-flat');
      var newflat = 0;
      if (flat == 0) {
        newflat = 1;
      } else {
        newflat = 0;
      }

      $.ajax({
        url: '<?php echo site_url('admin/settings/flatongkir'); ?>',
        type: 'POST',
        data: {
          'flat': newflat
        },
        success: function(data) {
          $('#dataflat').removeAttr('data-flat');
          $('#dataflat').attr('data-flat', data);
          console.log(data);
          if (data == 1) {
            $('#flat').prop('checked', true);
            $('#ongkirflatt').removeAttr('hidden');
            $('#ongkirflatt').show();
          } else {
            $('#ongkirflatt').hide();
            $('#flat').prop('checked', false);
          }
        }
      });
    }

    function stopVideo() {
      $('.yt_player_iframe').each(function() {
        this.contentWindow.postMessage('{"event":"command","func":"stopVideo","args":""}', '*')
      });
    };
  </script>