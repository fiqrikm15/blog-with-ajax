<?php
defined('BASEPATH') or exit('No allowed script to access');

class Admin extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url_helper');
        $this->M_User->cek_login();
    }

    function index($page='Admin Panel')
    {
        $data['title'] = $page;

        $this->load->view('header', $data);
        $this->load->view('navbar', $data);
        $this->load->view('admin/v_article', $data);
        $this->load->view('footer', $data);
    }

    function ajax_list()
    {
        $list = $this->M_Article->get_byid_user('article');
        $data = array();
        $no = 0;
        foreach($list as $articles)
        {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $articles->title;
            $row[] = $articles->status;
            $row[] = $articles->tgl_create;
            $row[] = $articles->last_update;

            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_article('."'".$articles->id_article."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
            <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_article('."'".$articles->id_article."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
                  
            $data[] = $row;
        }

        $out = array('data' => $data);

        echo json_encode($out);
    }

    public function ajax_delete($id)
	{
        // $id = $this->uri->segment(3);

		$this->M_Article->delete('article', $id);
		echo json_encode(array("status" => TRUE));
    }
    
    public function ajax_add()
	{
		// $this->_validate();
		$data_article = array(
            'id_user' => $this->session->userdata['id'],
            'title' => $this->input->post('title'),
            'slug' => $this->input->post('slug'),
            'content' => nl2br($this->input->post('content')),
            // 'image' =>  $file_data['file_name'],
            'status' => $this->input->post('status'),
            'tgl_create' => date('Y-m-d'),
            'last_update' => date('Y-m-d')
        );
		$insert = $this->M_Article->add('article', $data_article);
		echo json_encode(array("status" => TRUE));
    }
    
    public function ajax_edit($id)
	{
		$data = $this->M_Article->get_by_id('article', $id);
		echo json_encode($data);
    }
    
    public function ajax_update()
	{
        // $this->_validate();
        $data_article = array(
            'title' => $this->input->post('title'),
            'slug' => $this->input->post('slug'),
            'content' => $this->input->post('content'),
            'status' => $this->input->post('status'),
            // 'image' =>  $file_data['file_name'],
            'last_update' => date('Y-m-d')
        );
		
		$this->M_Article->update('article', $data_article, $this->input->post('id'));
		echo json_encode(array("status" => TRUE));
	}

    function create_article($page = 'Create Article')
    {
        $data['title'] = $page;
        $this->load->view('header', $data);
        $this->load->view('navbar', $data);
        $this->load->view('admin/create_article', $data);
        $this->load->view('footer', $data);
    }

    function create_action()
    {
        $filename = md5(uniqid(rand(), true));
        $config = array(
            'upload_path' => 'uploads/header-img',
            'allowed_types' => "gif|jpg|png|jpeg",
            'file_name' => $filename,
            'max_size' => 1000
        );

        $this->load->library('upload', $config);

        if($this->upload->do_upload('header-pic'))
        {
            $file_data = $this->upload->data();
            $data['image'] = $file_data['file_name'];
            $data_article = array(
                'id_user' => $this->session->userdata['id'],
                'title' => $this->input->post('title'),
                'slug' => $this->input->post('slug'),
                'content' => nl2br($this->input->post('content')),
                'image' =>  $file_data['file_name'],
                'status' => $this->input->post('status'),
                'tgl_create' => date('Y-m-d'),
                'last_update' => date('Y-m-d')
            );

            //echo $data_article;

            $insert = $this->M_Article->add('article', $data_article);

            if ($insert) {
                $this->session->set_flashdata('insert_sess', 'Insert Data Sucess');
                redirect(site_url('admin'));
            } else {
                $this->session->set_flashdata('insert_sess', 'Insert Data Gagal');
                redirect(site_url('admin'));
            }
        }
    }

    function edit($page='Edit Article')
    {
        $id = $this->uri->segment(3);

        $data['title'] = 'Edit Article';
        $data['ids'] = $id;
        $data['article'] = $this->M_Article->get_by_id('article', $id);

        $this->load->view('header', $data);
        $this->load->view('navbar', $data);
        $this->load->view('admin/edit_article', $data);
        $this->load->view('footer', $data);
    }

    function edit_action()
    {
        $id = $this->uri->segment(3);
        $id_user = $this->uri->segment(4);
        $filename = md5(uniqid(rand(), true));
        $config = array(
            'upload_path' => 'uploads/header-img',
            'allowed_types' => "gif|jpg|png|jpeg",
            'file_name' => $filename,
            'max_size' => 1000
        );

        $this->load->library('upload', $config);

        if($this->upload->do_upload('header-pic')) {
            $file_data = $this->upload->data();
            $data['image'] = $file_data['file_name'];
            $data_article = array(
                'id_user' => $id_user,
                'title' => $this->input->post('title'),
                'slug' => $this->input->post('slug'),
                'content' => $this->input->post('content'),
                'status' => $this->input->post('status'),
                'image' =>  $file_data['file_name'],
                'last_update' => date('Y-m-d')
            );

            $edit = $this->M_Article->update('article', $data_article, $id);

            if ($edit) {
                $this->session->set_flashdata('edit_sess', 'Edit Data Sucess');
                redirect(site_url('admin'));
            } else {
                $this->session->set_flashdata('edit_sess', 'Edit Data Gagal');
                redirect(site_url('admin'));
            }
        }
        else
        {
            $data_article = array(
                'id_user' => $id_user,
                'title' => $this->input->post('title'),
                'slug' => $this->input->post('slug'),
                'content' => $this->input->post('content'),
                'status' => $this->input->post('status'),
                'last_update' => date('Y-m-d')
            );

            $edit = $this->M_Article->update('article', $data_article, $id);

            if ($edit) {
                $this->session->set_flashdata('edit_sess', 'Edit Data Sucess');
                redirect(site_url('admin'));
            } else {
                $this->session->set_flashdata('edit_sess', 'Edit Data Gagal');
                redirect(site_url('admin'));
            }
        }
    }

    function delete()
    {
        $id = $this->uri->segment(3);
        $delete = $this->M_Article->delete('article', $id);

        if($delete)
        {
            $this->session->set_flashdata('delete_sess', 'Delete Data Sucess');
            redirect(site_url('admin'));
        }
        else
        {
            $this->session->set_flashdata('delete_sess', 'Delete Data Gagal');
            redirect(site_url('admin'));
        }
    }

    function article()
    {
        $id = $id = $this->uri->segment(3);
        $article = $this->M_Article->article_detail('article', $id);
        $data['title'] = 'Article-'.$article[0]['title'];
        $data['article'] = $article;

        $this->load->view('header', $data);
        $this->load->view('navbar', $data);
        $this->load->view('admin/detail_article', $data);
        $this->load->view('footer', $data);
    }

    function detail_profile()
    {
        $id = $this->session->userdata['id'];
        $user = $this->M_User->get_profile($id);
        $data['title'] = $user[0]['nama'];
        $data['user_data'] = $user;

        $this->load->view('header', $data);
        $this->load->view('navbar', $data);
        $this->load->view('admin/detail_profile', $data);
        $this->load->view('footer', $data);
    }

    function edit_profile()
    {
        $id = $this->session->userdata['id'];
        $user = $this->M_User->get_profile($id);
        $data['title'] = $user[0]['nama'];
        $data['user_data'] = $user;

        $this->load->view('header', $data);
        $this->load->view('navbar', $data);
        $this->load->view('admin/edit_profile', $data);
        $this->load->view('footer', $data);
    }

    function edit_profile_act()
    {
        $id = $this->uri->segment(3);
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
            $data['file_dir'] = $file_data['file_name'];
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

            //echo $id;
            $this->M_User->edit_profile($user_data, $id);
            $this->session->set_flashdata('Sukses', 'Anda berhasil terdaftar');
            redirect(site_url('admin/detail_profile'));
        }
        else
        {
            $user_data = array(
                'nama' => $nama,
                'email' => $email,
                'username' => $username,
                'password' => $password,
                'j_kelamin' => $jenis_kelamin,
                'alamat' => $alamat,
                'kode_pos' => $kode_pos,
                'agama' => $agama
            );

            //echo $id;
            $this->M_User->edit_profile($user_data, $id);
            $this->session->set_flashdata('Sukses', 'Anda berhasil terdaftar');
            redirect(site_url('admin/detail_profile'));
        }

//        $id = $this->session->userdata['id'];
//        $user = $this->M_User->get_profile($id);
//        $data['title'] = $user[0]['nama'];
//        $data['user_data'] = $user;
//        $this->load->view('header', $data);
//        $this->load->view('navbar', $data);
//        $this->load->view('admin/edit_profile', $data);
//        $this->load->view('footer', $data);
    }
}