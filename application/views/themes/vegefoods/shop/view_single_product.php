<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="hero-wrap hero-bread" style="background-image: url('<?php echo get_theme_uri('images/bg_1.jpg'); ?>');">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <p class="breadcrumbs"><span class="mr-2"><?php echo anchor(base_url(), 'Home'); ?></span>
                    <span class="mr-2"><?php echo anchor('/', 'Produk'); ?></span>
                    <span><?php echo $product->name; ?></span>
                </p>
                <h1 class="mb-0 bread" style="color:green"><?php echo $product->name; ?></h1>
            </div>
        </div>
    </div>
</div>

<section class="ftco-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mb-5 ftco-animate">
                <a href="<?php echo base_url('assets/uploads/products/' . $product->picture_name); ?>" class="image-popup"><img src="<?php echo base_url('assets/uploads/products/' . $product->picture_name); ?>" class="img-fluid" alt="<?php echo $product->name; ?>" style="height:400px; width:500px;"></a>
            </div>
            <div class="col-lg-6 product-details pl-md-5 ftco-animate">
                <h3><?php echo $product->name; ?></h3>
                <div class="rating d-flex">
                    <p class="text-left mr-4">
                        <a href="#" class="mr-2"><?= get_rating($totalrating, $totalreviews) ?></a>
                        <?= get_star_review($totalrating, $totalreviews) ?>
                    </p>
                    <p class="text-left mr-4">
                        <a href="#" class="mr-2" style="color: #000;"><?= $totalreviews ?><span style="color: #bbb;"> Rating</span></a>
                    </p>
                    <p class="text-left">
                        <a href="#" class="mr-2" style="color: #000;"><?= count($reviews) ?><span style="color: #bbb;"> Sold</span></a>
                    </p>
                </div>
                <p class="price">
                    <?php if ($product->current_discount > 0) : ?>
                        <span class="mr-2 price-dc"><strike><small>Rp <?php echo format_rupiah($product->price); ?></small></strike></span>
                        <span class="price-sale text-success">Rp <?php echo format_rupiah($product->price - $product->current_discount); ?></span>
                    <?php else : ?>
                        <span>Rp <?php echo format_rupiah($product->price); ?></span>
                    <?php endif; ?>
                </p>
                <p><?php echo $product->description; ?></p>
                <div class="row mt-4">
                    <div class="w-100"></div>
                    <div class="input-group col-md-6 d-flex mb-3">
                        <span class="input-group-btn mr-2">
                            <button type="button" class="quantity-left-minus btn" data-type="minus" data-field="">
                                <i class="ion-ios-remove"></i>
                            </button>
                        </span>
                        <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1" min="1" max="100" readonly>
                        <span class="input-group-btn ml-2">
                            <button type="button" class="quantity-right-plus btn" data-type="plus" data-field="">
                                <i class="ion-ios-add"></i>
                            </button>
                        </span>
                    </div>
                    <div class="w-100"></div>
                    <div class="col-md-12">
                        <p style="color: #000;">Tersedia <?php echo $product->stock; ?> <?php echo $product->product_unit; ?></p>

                    </div>
                </div>
                <p><a href="#" class="btn btn-black btn-sm py-3 px-5 add-cart cart-btn" data-sku="<?php echo $product->sku; ?>" data-name="<?php echo $product->name; ?>" data-price="<?php echo ($product->current_discount > 0) ? ($product->price - $product->current_discount) : $product->price; ?>" data-id="<?php echo $product->id; ?>">
                        <span class="ion-md-add"> Tambah
                    </a></p>
            </div>
        </div>
    </div>
</section>

<div class="nav-wrapper col-sm-8 ml-auto mr-auto" style="padding-left:0px;">
    <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
        <li class="nav-item">
            <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i class="ni ni-cloud-upload-96 mr-2"></i>Deskripsi Produk</a>
        </li>
        <li class="nav-item">
            <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><i class="ni ni-bell-55 mr-2"></i>Reviews Product</a>
        </li>

    </ul>
</div>
<div class="card shadow col-sm-8 ml-auto mr-auto ">
    <div class="card-body">
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                <p class="description"><?= ($product->description == NULL) ? 'Tidak Ada Deskripsi Produk' : $product->description ?></p>

            </div>
            <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                <div class="row ftco-animate">

                    <div class="carousel-testimony owl-carousel">
                        <?php if (count($reviews) > 0) : ?>
                            <?php foreach ($reviews as $review) : ?>
                                <div class="item">
                                    <div class="testimony-wrap p-4 pb-5">
                                        <div class="user-img mb-5" style="background-image: url(<?php echo base_url('assets/uploads/users/' . $review->profile_picture); ?>); ">
                                            <span class="quote d-flex align-items-center justify-content-center">
                                                <i class="icon-quote-left"></i>
                                            </span>
                                        </div>
                                        <div class="text text-center">
                                            <p class="mb-5 pl-4 line"><?php echo $review->review_text; ?></p>
                                            <p class="name"><?php echo $review->name; ?></p>
                                            <span class="position"><?php echo get_formatted_date($review->review_date); ?></span>
                                            <?= get_star_user($review->rating) ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <p class="description">Belum Ada Reviews Pada Product Ini!!!</p>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
</div>

<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center mb-3 pb-3">
            <div class="col-md-12 heading-section text-center ftco-animate">
                <span class="subheading">Produk Lain</span>
                <h2 class="mb-4">Produk Terkait</h2>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <?php if (count($related_products) > 0) : ?>
                <?php foreach ($related_products as $product) : ?>
                    <div class="col-md-6 col-lg-3 ftco-animate">
                        <div class="product">
                            <a href="#" class="img-prod"><img class="img-fluid" src="<?php echo base_url('assets/uploads/products/' . $product->picture_name); ?>" alt="<?php echo $product->name; ?>" style="height:200px; width:600px;">
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
    $(document).ready(function() {

        $('.quantity-right-plus').click(function(e) {

            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            var quantity = parseInt($('#quantity').val());

            // If is not undefined

            $('#quantity').val(quantity + 1);
            $('.cart-btn').attr('data-qty', quantity + 1);

            // Increment

        });

        $('.quantity-left-minus').click(function(e) {
            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            var quantity = parseInt($('#quantity').val());

            // If is not undefined

            // Increment
            if (quantity > 0) {
                $('#quantity').val(quantity - 1);
                $('.cart-btn').attr('data-qty', quantity - 1);
            }
        });

    });
</script>