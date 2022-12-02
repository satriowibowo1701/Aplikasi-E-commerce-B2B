<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tulis Review</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><?php echo anchor(base_url(), 'Home'); ?></li>
                        <li class="breadcrumb-item"><?php echo anchor('customer/reviews', 'Review'); ?></li>
                        <li class="breadcrumb-item active">Tulis Review</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card card-primary">
            <?php echo form_open('customer/reviews/write_me'); ?>
            <div class="card-body">
                <div class="form-group">
                    <label for="title" class="form-control-label">Judul Review</label>
                    <input type="text" name="title" value="<?php echo set_value('title'); ?>" class="form-control" id="title" required>
                    <?php echo form_error('title'); ?>
                </div>

                <div class="form-group">
                    <label for="orders" class="form-control-label">Order:</label>
                    <select name="order_id" class="form-control" id="orders">
                        <?php if (count($orders) > 0) : ?>
                            <?php foreach ($orders as $order) : ?>
                                <option value="<?php echo $order->id; ?>" <?php echo set_select('order_id', $order->id); ?>)>#<?php echo $order->order_number; ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="review" class="form-control-label">Rating</label>
                    <input type="hidden" value="" id="ratingvalue" name="rating">
                    <p class="text-left" style="font-size:30px">
                        <span class="ion-ios-star-outline" id="start1" data-start="1" onclick="ubah(this)" onmouseover="ubah(this)"></span>
                        <span class="ion-ios-star-outline" id="start2" data-start="2" onclick="ubah(this)" onmouseover="ubah(this)"></span>
                        <span class="ion-ios-star-outline" id="start3" data-start="3" onclick="ubah(this)" onmouseover="ubah(this)"></span>
                        <span class="ion-ios-star-outline" id="start4" data-start="4" onclick="ubah(this)" onmouseover="ubah(this)"></span>
                        <span class="ion-ios-star-outline" id="start5" data-start="5" onclick="ubah(this)" onmouseover="ubah(this)"></span>
                    </p>
                </div>
                <div class="form-group">
                    <label for="review" class="form-control-label">Review</label>
                    <textarea name="review" class="form-control" id="review" required><?php echo set_value('review'); ?></textarea>
                    <?php echo form_error('review'); ?>
                </div>

            </div>
            <div class="card-footer">
                <input type="submit" value="Tulis Review" class="btn btn-primary">
            </div>
            </form>
        </div>
    </section>

</div>

<script>
    function ubah(dat) {
        var data = $(dat).attr('data-start');
        $('#ratingvalue').val(data);
        for (i = 1; i <= 5; i++) {
            if (i <= data) {
                $('#start' + i).removeClass('ion-ios-star-outline');
                $('#start' + i).addClass('ion-ios-star');
                $('#start' + i).css('color', '#D1D100');
            } else {
                $('#start' + i).removeClass('ion-ios-star');
                $('#start' + i).removeAttr('style');
                $('#start' + i).addClass('ion-ios-star-outline');
            }
        }
    }
</script>