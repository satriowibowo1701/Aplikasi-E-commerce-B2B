<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Settings extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        verify_session('admin');

        $this->load->library('form_validation');
        $this->load->model(array(
            'setting_model' => 'setting',
            'payment_model' => 'payment'
        ));
    }

    public function index()
    {
        $params['title'] = 'Pengaturan';
        $params['total_notif'] = $this->payment->countnotif();
        $params['notif'] = $this->payment->notifikasi();
        $params['linkdata'] = $this->payment->linknotif();
        $settings['flash'] = $this->session->flashdata('settings_flash');
        $settings['banks'] = (array) json_decode(get_settings('payment_banks'));
        $settings['ongkir'] = $this->setting->get_ongkir();
        $settings['slider'] = $this->setting->get_data_slider();
        $this->load->view('header', $params);
        $this->load->view('settings/settings', $settings);
        $this->load->view('footer');
    }

    public function update()
    {
        $oldlogo = $this->setting->get_settings_slide();
        $newdat = json_decode($oldlogo, TRUE);

        $slider = [];
        if (isset($_FILES['picture1']) && @$_FILES['picture1']['error'] == '0' or isset($_FILES['picture2']) && @$_FILES['picture2']['error'] == '0' or isset($_FILES['picture3']) && @$_FILES['picture3']['error'] == '0') {
            $config['upload_path'] = './assets/themes/vegefoods/images';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size'] = 2048;
            $this->load->library('upload', $config);
            $id = 1;
            foreach ($newdat as $data) {
                ///gambar
                if ($this->upload->do_upload('picture' . $id) && $_FILES['picture' . $id]['name'] != "") {
                    $upload_data = $this->upload->data();
                    $new_file_name = $upload_data['file_name'];
                    $profile_picture = $new_file_name;
                    if (file_exists('assets/themes/vegefoods/images/' . $data['gambar']))
                        unlink('./assets/themes/vegefoods/images/' . $data['gambar']);
                } else {
                    $profile_picture = $data['gambar'];
                }

                //konten
                ////
                array_push($slider, array("gambar" => $profile_picture, "konten" => $this->input->post('konten' . $id)));
                $id++;
            }
            $jsonslider = json_encode($slider);
        } else {
            $jsonslider = $oldlogo;
        }
        update_settings('slider', $jsonslider);

        $oldlogoo = $this->setting->get_settings_logo();
        if (isset($_FILES['picture']) && @$_FILES['picture']['error'] == '0') {
            $config['upload_path'] = './assets/uploads/sites/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size'] = 2048;
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('picture')) {
                $upload_data = $this->upload->data();
                $new_file_name = $upload_data['file_name'];
                $profile_picture = $new_file_name;
                if (file_exists('assets/uploads/sites/' . $oldlogoo))
                    unlink('./assets/uploads/sites/' . $oldlogoo);
            }
        } else {
            $profile_picture = $oldlogoo;
        }
        update_settings('store_logo', $profile_picture);

        $fields = array(
            'store_name', 'store_phone_number', 'store_email', 'store_tagline', 'store_description',
            'store_address', 'min_shop_to_free_shipping_cost', 'shipping_cost', 'server_key', 'client_key', 'pass_mail'
        );

        foreach ($fields as $field) {
            $data = $this->input->post($field);

            update_settings($field, $data);
        }

        $banks = $this->input->post('banks');
        update_settings('payment_banks', '{}');

        if (is_array($banks) && count($banks) > 0 && !empty($banks[0]['bank'])) {
            $data = [];
            foreach ($banks as $bank) {
                $bank_name = $bank['bank'];
                $bank_name = $this->_bank_slug($bank_name);

                $data[$bank_name] = $bank;
            }

            $data = json_encode($data);
            update_settings('payment_banks', $data);
        }

        $this->session->set_flashdata('settings_flash', 'Pengaturan berhasil diperbarui');
        redirect('admin/settings');
    }

    public function add_bank()
    {
        $bank_name = $this->input->post('bank');
        $bank_number = $this->input->post('number');
        $owner = $this->input->post('name');

        $bank_slug = $this->_bank_slug($bank_name);
        $data[$bank_slug] = [
            'bank' => $bank_name,
            'number' => $bank_number,
            'name' => $owner
        ];

        $old_data = (array) json_decode(get_settings('payment_banks'));
        $new_data = array_merge($old_data, $data);
        $new_data = json_encode($new_data);

        update_settings('payment_banks', $new_data);

        $this->session->set_flashdata('settings_flash', 'Berhasil menambah data bank');
        redirect('admin/settings');
    }

    public function add_ongkir()
    {
        $wilayah = $this->input->post('wilayah');
        $tarif = $this->input->post('tarif');
        $data = [
            'wilayah' => $wilayah,
            'tarif' => $tarif
        ];
        $sukses = $this->setting->add_ongkir($data);
        if ($sukses) {
            $this->session->set_flashdata('settings_flash', 'Berhasil menambah data ongkir');
            redirect('admin/settings');
        }
    }

    public function profile()
    {
        $params['title'] = 'Profil Saya';
        $params['total_notif'] = $this->payment->countnotif();
        $params['notif'] = $this->payment->notifikasi();
        $params['linkdata'] = $this->payment->linknotif();
        $profile['flash'] = $this->session->flashdata('settings_flash');
        $profile['user'] = $this->setting->get_profile();

        $this->load->view('header', $params);
        $this->load->view('settings/profile', $profile);
        $this->load->view('footer');
    }
    public function flatongkir()
    {
        $data = $this->input->post('flat');
        $res = $this->setting->update_ongkir($data);
        echo $res;
    }

    public function profile_update()
    {
        $this->form_validation->set_error_delimiters('<div class="font-weight-bold text-danger">', '</div>');

        $this->form_validation->set_rules('name', 'Nama lengkap', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('username', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->profile();
        } else {
            $data = $this->setting->get_profile();
            $current_profile_picture = $data->profile_picture;
            $current_password = $data->password;

            $name = $this->input->post('name');
            $email = $this->input->post('email');
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            if (empty($password))
                $password = $current_password;
            else
                $password = password_hash($password, PASSWORD_BCRYPT);

            $config['upload_path'] = './assets/uploads/users/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size'] = 2048;

            $this->load->library('upload', $config);

            if (isset($_FILES['picture']) && @$_FILES['picture']['error'] == '0') {
                if ($this->upload->do_upload('picture')) {
                    $upload_data = $this->upload->data();
                    $new_file_name = $upload_data['file_name'];

                    $profile_picture = $new_file_name;

                    if (file_exists('assets/uploads/users/' . $current_profile_picture))
                        unlink('./assets/uploads/users/' . $current_profile_picture);
                }
            } else {
                $profile_picture = $current_profile_picture;
            }

            $data = array(
                'name' => $name,
                'email' => $email,
                'username' => $username,
                'password' => $password,
                'profile_picture' => $profile_picture
            );

            $this->setting->update_profile($data);

            $this->session->set_flashdata('settings_flash', 'Profil berhasil diperbarui');
            redirect('admin/settings/profile');
        }
    }

    protected function _bank_slug($bank)
    {
        $bank = strtolower($bank);
        $bank = str_replace(' ', '-', $bank);

        return $bank;
    }
}
