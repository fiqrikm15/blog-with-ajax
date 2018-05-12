<?php

class User extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function index($page = 'User Login')
    {
        $data['title'] = $page;
        $this->load->view('header', $data);
        $this->load->view('navbar', $data);
        $this->load->view('user/login', $data);
        $this->load->view('footer', $data);
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
    }

    function login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        $form_vald = array(
          array(
              'field' => 'username',
              'label' => 'username',
              'rules' => 'required',
              'errors' => array(
                  'required' => 'Username cannot be empty!'
              )
          ),
            array(
                'filed' => 'password',
                'label' => 'password',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Password cannot be empty!'
                )
            )
        );

        $this->form_validation->set_rules($form_vald);

        if($this->form_validation->run())
        {
            $this->M_User->login($username, $password, base_url('admin'), base_url('user'));
        }

        $tt['title'] = 'User Login';

        $this->load->view('header', $tt);
        $this->load->view('navbar', $tt);
        $this->load->view('user/login', $tt);
        $this->load->view('footer', $tt);
    }

    function logout()
    {
        $this->M_User->logout();
    }

    function register($page = 'New User Register')
    {
        $data['title'] = $page;
        $this->load->view('header', $data);
        $this->load->view('navbar', $data);
        $this->load->view('user/register', $data);
        $this->load->view('footer', $data);
    }

    function register_action()
    {
        $config_validation = array(
            array(
                'field' => 'nama',
                'label' => 'nama',
                'rules' => 'required'
            ),
            array(
                'field' => 'username',
                'label' => 'username',
                'rules' => 'required|is_unique[users.username]',
                'errors' => array(
                    'is_unique' => 'Email sudah terpakai.',
                    'required' => 'Isikan username terlebih dahulu.'
                )
            ),

            array(
                'field' => 'email',
                'label' => 'email',
                'rules' => 'required|valid_email|is_unique[users.email]',
                'errors' => array(
                    'is_unique' => 'Email sudah terdaftar.',
                    'valid_email' => 'Tolong gunakan email yang benar.',
                    'required' => 'Isikan email terlebih dahulu.'
                )
            ),

            array(
                'field' => 'password',
                'label' => 'password',
                'rules' => 'required|min_length[8]',
                'errors' => array(
                    'required' => 'Isi password dengan benar.',
                    'min_length' => 'Gunakan password dengan jumlah karakter minimal 8 karakter.'
                )
            ),

            array(
                'field' => 'c_password',
                'label' => 'c_password',
                'rules' => 'required|matches[password]',
                'errors' => array(
                    'matches' => 'Password harus sama dengan password di atas.',
                )
            ),

            array(
                'field' => 'jKelamin',
                'label' => 'jKelamin',
                'rules' => 'required'
            ),

            array(
                'field' => 'agama',
                'label' => 'agama',
                'rules' => 'required'
            )
        );

        $this->form_validation->set_rules($config_validation);

        if(!$this->form_validation->run())
        {
            $data['title'] = "Register New User";
            $this->load->view('header', $data);
            $this->load->view('navbar', $data);
            $this->load->view('user/register', $data);
            $this->load->view('footer', $data);
        }
        else
        {
            $nama = $this->input->POST('nama');
            $username = $this->input->POST('username');
            $email = $this->input->POST('email');
            $password = md5($this->input->POST('password'));
            $jenis_kelamin = $this->input->POST('jKelamin');
            $alamat = $this->input->POST('alamat');
            $kode_pos = $this->input->POST('kode_pos');
            $agama = $this->input->POST('agama');
            //$profi_pic = $this->input->POST('email');

            $filename = md5(uniqid(rand(), true));
            $config = array(
                'upload_path' => 'uploads/profiles',
                'allowed_types' => "gif|jpg|png|jpeg",
                'file_name' => $filename,
                'max_size' => 1000
            );

            $this->load->library('upload', $config);

            if($this->upload->do_upload('profile-pic'))
            {
                $file_data = $this->upload->data();
                $data['foto_prifile'] = $file_data['file_name'];
                $user_data = array(
                    'nama' => $nama,
                    'email' => $email,
                    'username' => $username,
                    'password' => $password,
                    'foto_profile' => $file_data['file_name'],
                    'j_kelamin' => $jenis_kelamin,
                    'alamat' => $alamat,
                    'kode_pos' => $kode_pos,
                    'agama' => $agama
                );

                $this->M_User->register($user_data);
                $this->session->set_flashdata('Sukses', 'Anda berhasil terdaftar');
                redirect(site_url('user'));
            }
            else
            {
                $this->session->set_flashdata('Gagal', 'Anda gagal terdaftar');
                $data['title'] = "Register New User";
                $this->load->view('header', $data);
                $this->load->view('navbar', $data);
                $this->load->view('user/register', $data);
                $this->load->view('footer', $data);
            }
        }
    }
}