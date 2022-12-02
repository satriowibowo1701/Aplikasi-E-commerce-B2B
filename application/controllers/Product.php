<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model(array(
            'product_model' => 'product',
            'review_model' => 'review'
        ));
    }

    public function index()
    {
        $products['products'] = $this->product->get_alll_products();
        $products['reviews'] = $this->review->get_all_reviews();
        $products['kategori'] = $this->product->get_kategori();
        $products['recomended'] = $this->product->product_recomended();
        $params['title'] = 'Rumah Makan Bu Inem';
        get_header($params);
        get_template_part('shop/product', $products);
        get_footer();
    }

    public function getprodukbykategori()
    {
        if (!($this->input->post('search')) && !$this->input->post('currentid')) {
            $id = $this->input->post('id');
            if ($id == 'all') {
                $products = $this->product->get_alll_products();
            } else if ($id != 'all') {
                $products = $this->product->get_produk_by_kategori($id);
            }
        } else {
            $search = $this->input->post('search');
            $kategori = $this->input->post('currentid');
            $products = $this->product->search_product($search, $kategori);
        }
        $respon = '<div class="container">
        <div class="row">';
        $newres = [];
        $restmp = '';
        if (count($products) > 0) :
            foreach ($products as $product) :
                $restmp .= '<div class="col-md-2 col-lg-3 fadeInUp ftco-animated"> 
                <div class="product">';
                $restmp .= '<a href="' . site_url('shop/product/' . $product->id . '/' . $product->sku . '/') . '" class="img-prod"><img class="img-fluid" src="' .  base_url('assets/uploads/products/' . $product->picture_name) . '" alt="' . $product->name . '" style="height:200px; width:600px;"> ';
                if ($product->current_discount > 0) :
                    $restmp .= '<span class="status">' . count_percent_discount($product->current_discount, $product->price, 0) . '%</span>';
                endif;
                $restmp .= '<div class="overlay"></div>
                            </a>
                            <div class="text py-3 pb-4 px-3 text-center">
                                <h3><a href="' .  site_url('shop/product/' . $product->id . '/' . $product->sku . '/') . '">' .  $product->name . '</a></h3>
                                <div class="d-flex">
                                    <div class="pricing">
                                        <p class="price">';
                if ($product->current_discount > 0) :
                    $restmp .= '<span class="mr-2 price-dc">Rp' . format_rupiah($product->price) . '</span><span class="price-sale">Rp' . format_rupiah($product->price - $product->current_discount) . ' </span>';
                else :
                    $restmp .= '<span class="mr-2"><span class="price-sale">Rp' . format_rupiah($product->price - $product->current_discount) . '</span>';
                endif;
                $harga = ($product->current_discount > 0) ? ($product->price - $product->current_discount) : $product->price;
                $restmp .= '</p></div></div><div class="bottom-area d-flex px-3"><div class="m-auto d-flex"><a href="' . site_url('shop/product/' . $product->id . '/' . $product->sku . '/') . '" class="buy-now d-flex justify-content-center align-items-center text-center"><span><i class="ion-ios-menu"></i></span>';
                $restmp .= '</a><a href="javascript: void(0);" class="add-to-chart add-cart newadd d-flex justify-content-center align-items-center mx-1"';
                $restmp .= 'data-sku="' .  $product->sku . '"' . ' data-name="' . $product->name . '"' . 'data-price="' . $harga . '"' . 'data-id="' . $product->id . '">' . '<span><i class="ion-ios-cart"></i></span></a></div></div></div></div></div>';
                array_push($newres, $restmp);
                $restmp = '';
            endforeach;
        else :
            $resempty = ($this->input->post('search')) ? '<h2 class="mb-4 text-center">Produk Tidak Ditemukan</h2>' : '<h2 class="mb-4 text-center">Tidak Ada Produk Pada Kategori Ini</h2>';
            $respon .= $resempty;
        endif;

        foreach ($newres as $res) {
            $respon .= $res;
        }
        $respon .= '</div>';

        echo $respon;
    }
}
