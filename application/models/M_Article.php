<?php
class M_Article extends CI_Model 
{
    function get($tb)
    {
        $this->db->select("article.*', users.nama");
        $this->db->from($tb);
        $this->db->join('users', 'users.id_user = article.id_user');
        //$this->db->join('users', 'users.id_user = article.id_user');
        return $this->db->get()->result();
    }

    function get_byid_user($tb)
    {
        $this->db->select("article.*, users.nama");
        $this->db->from($tb);
        $this->db->where('article.id_user', $this->session->userdata('id'));
        $this->db->join('users', 'users.id_user = article.id_user');
        return $this->db->get()->result();
    }

    function get_by_id($tb, $id)
    {
        $this->db->where('id_article', $id);
        return $this->db->get($tb)->result_array();
    }

    function article_detail($tb, $id)
    {
        $this->db->select("article.*, users.nama");
        $this->db->from($tb);
        $this->db->where('article.id_article', $id);
        $this->db->join('users', 'users.id_user = article.id_user');
        return $this->db->get()->result_array();
    }

    function get_article_public($tb)
    {
        $this->db->select("article.*, users.nama");
        $this->db->from($tb);
        $this->db->where('status', 'Publish');
        $this->db->join('users', 'users.id_user = article.id_user');
        $this->db->order_by('last_update', 'DESC');
        return $this->db->get()->result();
    }

    function add($tb, $data)
    {
        $create = $this->db->insert($tb, $data);
        if($create)
        {
            return true;
        }
    }

    function update($tb, $data, $id)
    {
        $this->db->set($data);
        $this->db->where('id_article', $id);
        $edit = $this->db->update($tb, $data);

        if($edit)
        {
            return true;
        }
    }

    function delete($tb, $id)
    {
        $this->db->where('id_article', $id);
        $this->db->delete($tb);
    }
}