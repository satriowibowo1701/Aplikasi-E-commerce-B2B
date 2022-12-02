<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Review Saya</h1>
                </div>
                <div class="col-sm-5">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><?php echo anchor(base_url(), 'Home'); ?></li>
                        <li class="breadcrumb-item active">Review</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card card-primary">
            <div class="card-body<?php echo (count($reviews) > 0) ? ' p-0' : ''; ?>">
                <?php if (count($reviews) > 0) : ?>
                    <div class="table-responsive">
                        <table class="table table-striped m-0">
                            <tr class="bg-primary">
                                <th scope="col">No.</th>
                                <th scope="col">Order</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Review</th>
                            </tr>
                            <?php
                            $no = 1;
                            foreach ($reviews as $review) : ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo anchor('customer/reviews/view/' . $review->id, '#' . $review->order_number); ?></td>
                                    <td><?php echo get_formatted_date($review->review_date); ?></td>
                                    <td><?php echo $review->review_text; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
            </div>
            <?php if (count($reviews) > 0) { ?>
                <div class="row mt-2">
                    <?php echo anchor('customer/reviews/write', 'Tambah review baru'); ?>
                </div>
            <?php } ?>
        <?php else : ?>
            <div class="row">
                <div class="col-md-6">
                    <div class="alert alert-info">
                        Belum ada review yang ditulis. Silahkan tulis baru.
                    </div>
                    <?php echo anchor('customer/reviews/write', 'Tulisan review baru'); ?>
                </div>
            </div>
        <?php endif; ?>
        </div>

        <?php if ($pagination) : ?>
            <div class="card-footer">
                <?php echo $pagination; ?>
            </div>
        <?php endif; ?>

</div>
</section>

</div>