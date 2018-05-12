<?php

class M_User extends CI_Model
{
    function register($data)
    {
        $this->db->insert('users', $data);
    }

    function login($username, $password)
    {
        $query = $this->db->get_where('users', array('username' => $username, 'password' => md5($password)));

        if($query->num_rows() == 1)
        {
            $row = $this->db->query("select id_user, nama, foto_profile from users where username ='".$username."'");
            $id_user = $row->row();
            $nama = $id_user->nama;
            $profile = $id_user->foto_profile;
            $id = $id_user->id_user;

            $this->session->set_userdata('username', $username);
            $this->session->set_userdata('nama', $nama);
            $this->session->set_userdata('id_login', uniqid(rand()));
            $this->session->set_userdata('foto_profile', $profile);
            $this->session->set_userdata('id', $id);

            redirect(site_url('admin'));
        }
        else
        {
            $this->session->set_flashdata('login_failed','Username atau password anda salah, silakan coba lagi.');
            redirect(site_url('user'));
        }

        return false;
    }

    function cek_login()
    {
        if($this->session->userdata('username') == "")
        {
            $this->session->set_flashdata('login_failed', 'Anda Belum Melakukan Login');
            redirect('user');
        }
    }

    function regiter($data)
    {
        $this->db->insert('users', $data);
    }

    function logout()
    {
        $items = array('username', 'id_login', 'id', 'nama', 'foto_profile');
        $this->session->unset_userdata($items);
        $this->session->sess_destroy();
        redirect(site_url('article'));
    }

    function get_profile($id)
    {
        $this->db->where('id_user', $id);
        return $this->db->get('users')->result_array();
    }

    function get_all()
    {
        return $this->db->get('users')->result();
    }

    function edit_profile($data, $id)
    {
        $this->db->set($data);
        $this->db->where('id_user', $id);
        $edit = $this->db->update('users', $data);

        if($edit)
        {
            return true;
        }
    }
}