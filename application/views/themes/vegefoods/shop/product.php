<?php
defined('BASEPATH') or exit('No direct script access allowed'); ?>

<style>
    .nav-pills .nav-link {
        border-radius: 17.25rem;
    }

    .nav-link:focus,
    .nav-link:hover {
        color: black;
    }

    .nav-link {
        color: black;
    }

    .input-group-text {
        border: 1px solid #587a9d;
        color: black;
        background-color: #c6d4e1;
        border-radius: 1.25rem;
    }
</style>

<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center mb-3 pb-3">
            <div class="col-md-12 heading-section text-center ftco-animate">
                <h2 class="mb-4">Kategori</h2>
            </div>
        </div>
    </div>
    <div class="col-md-5 ftco-animate" style="margin-left:auto; margin-right:auto; margin-bottom:80px;  ">
        <ul class="nav nav-pills nav-fill flex-column flex-sm-row " id="tabs-text" role="tablist">
            <li class="nav-item mb-2 mr-2" style="border: 2px solid black; border-radius:17.25rem;">
                <a class=" nav-link mb-sm-3 mb-md-0 kategori" id="tabs-text-2-tab" data-kategori="all" data-toggle="tab" href="" role="tab" aria-controls="tabs-text-2" aria-selected="false"><b>Semua</b></a>
            </li>
            <input type="hidden" name="kategori" value="" id="currentcat">
            <?php foreach ($kategori as $data) { ?>
                <li class="nav-item mb-2 mr-2" style="border: 2px solid black; border-radius:17.25rem;">
                    <a class=" nav-link mb-sm-3 mb-md-0 kategori" data-kategori="<?= $data->id ?>" id="tabs-text-2-tab" data-toggle="tab" href="" role="tab" aria-controls="tabs-text-2" aria-selected="false"><b><?= $data->name ?></b></a>
                </li>
            <?php } ?>
        </ul>
    </div>

    <div class="container">
        <div class="row justify-content-center mb-3 pb-3">
            <div class="col-md-12 heading-section text-center ftco-animate">
                <span class="subheading">List Produk</span>
                <h2 class="mb-4"><?php echo get_store_name(); ?></h2>
                <p><?php echo get_settings('store_tagline'); ?></p>
            </div>
        </div>
    </div>
    <div class="container ">
        <form class="navbar-search navbar-search-light form-inline mr-sm-3" id="navbar-search-main" action="" required>
            <div class="form-group mb-3">
                <div class="input-group input-group-alternative input-group-merge">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Search &nbsp;<i class="fas fa-search"></i></span>
                    </div>
                    <input class="form-control" id="searchprdk" value="<?php echo (isset($query) ? $query : ''); ?>" name="search_query" placeholder="Cari..." type="text" required>
                </div>
            </div>
        </form>
    </div>
    <div id="ganti">
        <div class="container">
            <div class="row">
                <?php if (count($products) > 0) : ?>
                    <?php foreach ($products as $product) : ?>
                        <div class="col-md-2 col-lg-3 ftco-animate">
                            <div class="product">
                                <a href="<?php echo site_url('shop/product/' . $product->id . '/' . $product->sku . '/'); ?>" class="img-prod">
                                    <img class="img-fluid" src="<?php echo base_url('assets/uploads/products/' . $product->picture_name); ?>" alt="<?php echo $product->name; ?>" style="height:200px; width:600px;">
                                    <?php if ($product->current_discount > 0) : ?>
                                        <span class="status"><?php echo count_percent_discount($product->current_discount, $product->price, 0); ?>%</span>
                                    <?php endif; ?>
                                    <div class="overlay"></div>
                                </a>
                                <div class="text py-3 pb-4 px-3 text-center">
                                    <h3><a href="<?php echo site_url('shop/product/' . $product->id . '/' . $product->sku . '/'); ?>"><?php echo $product->name; ?></a></h3>
                                    <div class="d-flex">
                                        <div class="pricing">
                                            <p class="price">
                                                <?php if ($product->current_discount > 0) : ?>
                                                    <span class="mr-2 price-dc">Rp <?php echo format_rupiah($product->price); ?></span><span class="price-sale">Rp <?php echo format_rupiah($product->price - $product->current_discount); ?></span>
                                                <?php else : ?>
                                                    <span class="mr-2"><span class="price-sale">Rp <?php echo format_rupiah($product->price - $product->current_discount); ?></span>
                                                    <?php endif; ?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="bottom-area d-flex px-3">
                                        <div class="m-auto d-flex">
                                            <a href="<?php echo site_url('shop/product/' . $product->id . '/' . $product->sku . '/'); ?>" class="buy-now d-flex justify-content-center align-items-center text-center">
                                                <span><i class="ion-ios-menu"></i></span>
                                            </a>
                                            <a href="#" class="add-to-chart add-cart d-flex justify-content-center align-items-center mx-1" data-sku="<?php echo $product->sku; ?>" data-name="<?php echo $product->name; ?>" data-price="<?php echo ($product->current_discount > 0) ? ($product->price - $product->current_discount) : $product->price; ?>" data-id="<?php echo $product->id; ?>">
                                                <span><i class="ion-ios-cart"></i></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                <?php endif; ?>

            </div>
        </div>
    </div>
</section>


<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center mb-3 pb-3">
            <div class="col-md-12 heading-section text-center ftco-animate">
                <span class="subheading">Produk Lain</span>
                <h2 class="mb-4">Produk Recomended</h2>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <?php if (count($recomended) > 0) : ?>
                <?php foreach ($recomended as $product) : ?>
                    <div class="col-md-6 col-lg-3 ftco-animate">
                        <div class="product">
                            <a href="<?php echo base_url('shop/product/' . $product->id . '/' . $product->sku); ?> " class="img-prod"><img class="img-fluid" src="<?php echo base_url('assets/uploads/products/' . $product->picture_name); ?>" alt="<?php echo $product->name; ?>" style="height:200px; width:600px;">
                                <?php if ($product->current_discount > 0) : ?>
                                    <span class="status"><?php echo count_percent_discount($product->current_discount, $product->price); ?>%</span>
                                <?php endif; ?>
                                <div class="overlay"></div>
                            </a>
                            <div class="text py-3 pb-4 px-3 text-center">
                                <h3><?php echo anchor('shop/product/' . $product->id . '/' . $product->sku . '/', $product->name); ?></h3>
                                <div class="d-flex">
                                    <div class="pricing">
                                        <p class="price">
                                            <?php if ($product->current_discount > 0) : ?>
                                                <span class="mr-2 price-dc">Rp <?php echo format_rupiah($product->price); ?></span>
                                                <span class="price-sale">Rp <?php echo format_rupiah($product->price - $product->current_discount); ?></span>
                                        </p>
                                    <?php else : ?>
                                        <span class="price-sale">Rp <?php echo format_rupiah($product->price); ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="bottom-area d-flex px-3">
                                    <div class="m-auto d-flex">
                                        <a href="<?php echo site_url('shop/product/' . $product->id . '/' . $product->sku . '/'); ?>" class="buy-now d-flex justify-content-center align-items-center text-center">
                                            <span><i class="ion-ios-menu"></i></span>
                                        </a>
                                        <a href="#" class="add-to-chart add-cart d-flex justify-content-center align-items-center mx-1" data-sku="<?php echo $product->sku; ?>" data-name="<?php echo $product->name; ?>" data-price="<?php echo ($product->current_discount > 0) ? ($product->price - $product->current_discount) : $product->price; ?>" data-id="<?php echo $product->id; ?>">
                                            <span><i class="ion-ios-cart"></i></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

        </div>
    </div>
</section>

<script>
    var add = () => {
        $('.newadd').click(function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            var sku = $(this).data('sku');
            var qty = $(this).data('qty');
            qty = (qty > 0) ? qty : 1;
            var price = $(this).data('price');
            var name = $(this).data('name');

            $.ajax({
                method: 'POST',
                url: '<?php echo site_url('shop/cart_api?action=add_item'); ?>',
                data: {
                    id: id,
                    sku: sku,
                    qty: qty,
                    price: price,
                    name: name
                },
                success: function(res) {
                    if (res.code == 200) {
                        var totalItem = res.total_item;
                        $('.cart-item-total').text(totalItem);
                        toastr.info('Item ditambahkan dalam keranjang');
                    } else {
                        toastr.info('Terjadi Kesalahan');
                    }
                }
            });
        });
    }
    $('.kategori').click(function() {
        var kategori = $(this).data('kategori');
        $.ajax({
            url: '<?php echo site_url('product/getprodukbykategori'); ?>',
            type: 'POST',
            data: {
                id: kategori
            },
            success: function(data) {
                $('#ganti').html(data);
                $('#currentcat').val(kategori);
                add()
            }
        });

    });


    $('#searchprdk').keyup(function() {
        console.log($(this).val());
        var search = $(this).val();
        var kategori = $('#currentcat').val();
        if (kategori == '') {
            kategori = 'all';
        }
        $.ajax({
            url: '<?php echo site_url('product/getprodukbykategori'); ?>',
            type: 'POST',
            data: {
                search: search,
                currentid: kategori
            },
            success: function(data) {
                $('#ganti').html(data);
                $('#currentcat').val(kategori);
                add()
            }
        });
    });
</script>