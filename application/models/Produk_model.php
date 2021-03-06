<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Produk_model extends CI_Model
{

    public $table = 'produk';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id', $q);
	$this->db->or_like('nama_produk', $q);
	$this->db->or_like('harga_beli', $q);
	$this->db->or_like('vendor', $q);
	$this->db->or_like('status', $q);
	$this->db->or_like('created_at', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0,$q) {
        $this->db->select("bb.*,aa.*,bb.id as id_vendor, aa.id as id");
        $this->db->order_by("aa.".$this->id, $this->order);
        $this->db->or_like('aa.id', $q);
    	$this->db->or_like('aa.nama_produk', $q);
    	$this->db->or_like('bb.nama_vendor', $q);
    	$this->db->limit($limit, $start);
        $this->db->join('vendor bb', 'aa.vendor=bb.id', 'left');
        return $this->db->get($this->table." aa")->result();
        //die($this->db->last_query());

    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}

/* End of file Produk_model.php */
/* Location: ./application/models/Produk_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-06-09 10:36:02 */
/* http://harviacode.com */