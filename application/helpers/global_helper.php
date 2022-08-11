<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('get_settings')) {
    function get_settings($key = '')
    {
        $CI = &get_instance();

        $row = $CI->db
            ->select('content')
            ->where('key', $key)
            ->get('settings')
            ->row();

        return $row->content;
    }
}

if (!function_exists('update_settings')) {
    function update_settings($key, $new_content)
    {
        $CI = init();

        $CI->db->where('key', $key)
            ->update('settings', array('content' => $new_content));
    }
}

if (!function_exists('get_store_name')) {
    function get_store_name()
    {
        return get_settings('store_name');
    }
}


if (!function_exists('get_admin_image')) {
    function get_admin_image()
    {
        $id = get_current_user_id();
        $CI = init();
        $data = $CI->db->select('profile_picture')->where('id', $id)->get('users')->row();
        $profile_picture = $data->profile_picture;
        if (file_exists('assets/uploads/users/' . $profile_picture) and $profile_picture != NULL)
            $file = $profile_picture;
        else
            $file = 'admin.png';

        return base_url('assets/uploads/users/' . $file);
    }
}

if (!function_exists('get_admin_name')) {
    function get_admin_name()
    {
        $data = user_data();

        return $data->name;
    }
}

if (!function_exists('get_user_name')) {
    function get_user_name()
    {
        $CI = init();
        $id = get_current_user_id();

        if (is_customer()) {
            $user = $CI->db->query("
            SELECT u.*, c.*
            FROM users u
            JOIN customers c
                ON c.user_id = u.id
            WHERE u.id = '$id'
        ")->row();
        } else {
            $user = $CI->db->query("
            SELECT u.*
            FROM users u
            WHERE u.id = '$id'
        ")->row();
        }

        return $user->name;
    }
}

if (!function_exists('get_user_image')) {
    function get_user_image()
    {
        $CI = init();
        $id = get_current_user_id();

        $user = $CI->db->query("
            SELECT u.*, c.*
            FROM users u
            JOIN customers c
            ON c.user_id = u.id
            WHERE u.id = '$id'
        ")->row();

        $picture = $user->profile_picture;
        $file = './assets/uploads/users/' . $picture;
        if (file_exists($file) and $picture != NULL) {
            $picture_name = $picture;
        } else {
            $picture_name = 'admin.png';
        }

        return base_url('assets/uploads/users/' . $picture_name);
    }
}

if (!function_exists('get_store_logo')) {
    function get_store_logo()
    {
        $file = get_settings('store_logo');
        return base_url('assets/uploads/sites/' . $file);
    }
}

if (!function_exists('get_formatted_date')) {
    function get_formatted_date($source_date)
    {
        $d = strtotime($source_date);

        $year = date('Y', $d);
        $month = date('n', $d);
        $day = date('d', $d);
        $day_name = date('D', $d);

        $day_names = array(
            'Sun' => 'Minggu',
            'Mon' => 'Senin',
            'Tue' => 'Selasa',
            'Wed' => 'Rabu',
            'Thu' => 'Kamis',
            'Fri' => 'Jum\'at',
            'Sat' => 'Sabtu'
        );
        $month_names = array(
            '1' => 'Januari',
            '2' => 'Februari',
            '3' => 'Maret',
            '4' => 'April',
            '5' => 'Mei',
            '6' => 'Juni',
            '7' => 'Juli',
            '8' => 'Agustus',
            '9' => 'September',
            '10' => 'November',
            '11' => 'Oktober',
            '12' => 'Desember'
        );
        $day_name = $day_names[$day_name];
        $month_name = $month_names[$month];

        $date = "$day_name, $day $month_name $year";

        return $date;
    }
}

if (!function_exists('format_rupiah')) {
    function format_rupiah($rp)
    {
        return number_format($rp, 2, ',', '.');
    }
}

if (!function_exists('create_product_sku')) {
    function create_product_sku($name, $category, $price, $stock)
    {
        $name = create_acronym($name);
        $category = create_acronym($category);
        $price = create_acronym($price);
        $stock = $stock;
        $key = substr(time(), -3);

        $sku =  $name . $category . $price . $stock . $key;
        return $sku;
    }
}

if (!function_exists('create_acronym')) {
    function create_acronym($words)
    {
        $words = explode(' ', $words);
        $acronym = '';

        foreach ($words as $word) {
            $acronym .= $word[0];
        }

        $acronym = strtoupper($acronym);

        return $acronym;
    }
}

if (!function_exists('count_percent_discount')) {
    function count_percent_discount($discount, $from, $num = 1)
    {
        $count = ($discount / $from) * 100;
        $count = number_format($count, $num);

        return $count;
    }
}

if (!function_exists('get_product_image')) {
    function get_product_image($id)
    {
        $CI = init();
        $CI->load->model('product_model');

        $data = $CI->product_model->product_data($id);
        $picture_name = $data->picture_name;

        if (!$picture_name)
            $picture_name = 'default.jpg';

        $file = './assets/uploads/products/' . $picture_name;

        return base_url('assets/uploads/products/' . $picture_name);
    }
}



if (!function_exists('get_order_status')) {
    function get_order_status($status, $payment)
    {
        if ($payment == 1) {
            // Bank
            if ($status == 1)
                return 'Menunggu pembayaran';
            elseif ($status == 2)
                return 'Dalam proses';
            elseif ($status == 3)
                return 'Dalam pengiriman';
            elseif ($status == 4)
                return 'Selesai';
            elseif ($status == 5)
                return 'Dibatalkan';
        } elseif ($payment == 2) {
            //COD
            if ($status == 1)
                return 'Dalam proses';
            elseif ($status == 2)
                return 'Dalam pengiriman';
            elseif ($status == 3)
                return 'Selesai';
            elseif ($status == 4)
                return 'Dibatalkan';
        } elseif ($payment == 3) {
            if ($status == 1) {
                return 'Menunggu pembayaran';
            } elseif ($status == 2) {
                return 'Dalam proses';
            } elseif ($status == 3) {
                return 'Dalam pengiriman';
            } elseif ($status == 4) {
                return 'Selesai';
            } elseif ($status == 5) {
                return 'Dibatalkan';
            }
        }
    }
}

if (!function_exists('get_payment_status')) {
    function get_payment_status($status)
    {
        if ($status == 1)
            return 'Menunggu konfirmasi';
        else if ($status == 2)
            return 'Berhasil dikonfirmasi';
        else if ($status == 3)
            return 'Pembayaran Dibatalkan';
        else if ($status == 0)
            return 'Menunggu Pembayaran';
    }
}
if (!function_exists('get_persen')) {
    function get_persen($data1, $data2)
    {
        $newdata1 = $data1 * 100;
        $newdata2 = $data2 * 100;
        $persen = 0;
        if ($newdata2 > $newdata1) {
            $persen = ceil((($newdata2 - $newdata1) / $newdata1) * 100);
        } else {
            $persen = ceil((($newdata2 - $newdata1) / $newdata2) * 100);
        }
        return $persen;
    }
}
if (!function_exists('get_income')) {
    function get_income($data1, $data2)
    {
        $newdata1 = $data1;
        $newdata2 = $data2;
        $persen = 0;
        if ($newdata2 > $newdata1) {
            $persen = (($newdata2 - $newdata1) / $newdata1) * 100;
        } else {
            $persen = (($newdata2 - $newdata1) / $newdata2) * 100;
        }
        return number_format($persen, 1);
    }
}

if (!function_exists('get_income_perday')) {
    function get_income_perday($data = array())
    {
        $newdata1 = $data[0]->total_payment;
        $newdata2 = $data[1]->total_payment;
        if (isset($data[0]->status)) {
            if ($data[0]->status == '1hari') {
                $newdata2 = $data[0]->total_payment;
                $newdata1 = $data[1]->total_payment;
            }
        }

        if ($newdata1 == 0 && $newdata2 == 0 || $newdata1 == $newdata2) {
            return '<p class="mt-2 mb-0 text-sm" style="display:inline-block">
            <span class="text-nowrap">Pendapatan Sama</span>
            <span class="text-nowrap">Dengan Hari Sebelumnya</span>
          </p>';
        }
        $persen = 0;
        if ($newdata2 > $newdata1) {
            $persen = $newdata2 - $newdata1;
            return '<p class="mt-2 mb-0 text-sm" style="display:inline-block">
            <span class="text-success mr-2"><i class="fa fa-arrow-up"></i></span>
            <span class="text-nowrap">Pendapatan Menaik Rp.' . format_rupiah($persen) . '</span>
            <span class="text-nowrap ml-4">Dengan Hari Sebelumnya</span>
          </p>';
        } else if ($newdata2 < $newdata1) {
            $persen = $newdata1 - $newdata2;
            return '<p class="mt-2 mb-0 text-sm" style="display:inline-block">
            <span class="text-danger mr-2"><i class="fa fa-arrow-down"></i></span>
            <span class="text-nowrap">Pendapatan Menurun Rp.' . format_rupiah($persen) . '</span>
            <span class="text-nowrap ml-4">Dengan Hari Sebelumnya</span>
          </p>';
        }
    }
}

if (!function_exists('get_order_perday')) {
    function get_order_perday($data = array())
    {
        $newdata1 = $data[0]->total_order;
        $newdata2 = $data[1]->total_order;
        if (isset($data[0]->status)) {
            if ($data[0]->status == '1hari') {
                $newdata2 = $data[0]->total_order;
                $newdata1 = $data[1]->total_order;
            }
        }

        if ($newdata1 == 0 && $newdata2 == 0 || $newdata1 == $newdata2) {
            return '<p class="mt-2 mb-0 text-sm" style="display:inline-block">
            <span class="text-nowrap">Orderan Sama</span>
            <br>
            <span class="text-nowrap">Dengan Hari Sebelumnya</span>
          </p>';
        }
        $persen = 0;
        if ($newdata2 > $newdata1) {
            $persen = $newdata2 - $newdata1;
            return '<p class="mt-2 mb-0 text-sm" style="display:inline-block">
            <span class="text-success mr-2"><i class="fa fa-arrow-up"></i></span>
            <span class="text-nowrap">Orderan Meningkat Sebanyak' . $persen . '</span>
            <span class="text-nowrap ml-4">Dengan Hari Sebelumnya</span>
          </p>';
        } else if ($newdata2 < $newdata1) {
            $persen = $newdata1 - $newdata2;
            return '<p class="mt-2 mb-0 text-sm" style="display:inline-block">
            <span class="text-danger mr-2"><i class="fa fa-arrow-down"></i></span>
            <span class="text-nowrap">Orderan Menurun Sebanyak' . $persen . '</span>
            <span class="text-nowrap ml-4">Dengan Hari Sebelumnya</span>
          </p>';
        }
    }
}
if (!function_exists('get_income_perday_total')) {
    function get_income_perday_total($data = array())
    {
        $newdata1 = $data[0]->total_payment;
        $newdata2 = $data[1]->total_payment;
        if (isset($data[0]->status)) {
            if ($data[0]->status == '1hari') {
                $newdata2 = $data[0]->total_payment;
                $newdata1 = $data[1]->total_payment;
            }
        }
        return $newdata2;
    }
}
if (!function_exists('get_order_perday_total')) {
    function get_order_perday_total($data = array())
    {
        $newdata1 = $data[0]->total_order;
        $newdata2 = $data[1]->total_order;
        if (isset($data[0]->status)) {
            if ($data[0]->status == '1hari') {
                $newdata2 = $data[0]->total_order;
                $newdata1 = $data[1]->total_order;
            }
        }
        return $newdata2;
    }
}


if (!function_exists('get_notif_status')) {
    function get_notif_status($status)
    {
        if ($status == 1)
            return '<span class="badge badge-pill badge-danger">Pending</span>';
        else if ($status == 2)
            return '<span class="badge badge-pill badge-success">Berhasil</span>';
        else if ($status == 3)
            return '<span class="badge badge-pill badge-danger">Dibatalkan</span>';
    }
}
if (!function_exists('get_notif_status_admin')) {
    function get_notif_status_admin($status)
    {

        if ($status == 2)
            return '<span class="badge badge-pill badge-success">Perlu Diproses</span>';
        else if ($status == 1)
            return '<span class="badge badge-pill badge-danger">Menunggu Konfirmasi</span>';
    }
}

if (!function_exists('get_contact_status')) {
    function get_contact_status($status)
    {
        if ($status == 1)
            return 'Belum dibaca';
        else if ($status == 2)
            return 'Sudah dibaca';
        else if ($status == 3)
            return 'Sudah dibalas';
    }
}
if (!function_exists('is_read')) {
    function is_read($status)
    {
        if ($status == 0)
            return '<span class="badge badge-pill badge-info">Belum dibaca</span>';
        else if ($status == 1)
            return '<span class="badge badge-pill badge-info">Sudah dibaca</span>';
    }
}



if (!function_exists('get_month')) {
    function get_month($mo)
    {
        $months = array(
            '1' => 'Januari',
            '2' => 'Februari',
            '3' => 'Maret',
            '4' => 'April',
            '5' => 'Mei',
            '6' => 'Juni',
            '7' => 'Juli',
            '8' => 'Agustus',
            '9' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember'
        );

        return $months[$mo];
    }
}
