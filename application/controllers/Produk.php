<?php
//codesource: www.youtube.com/c/peternakkode

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Produk extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('Produk_model');
        $this->load->library('form_validation');
    }

    public function index() {
        //validasi, jika url memanggil nama controller produk, maka akan diredirect ke dashboard
        // if (ucwords($this->uri->segment(1)) == 'Produk') {
        //     redirect('welcome', 'refresh');
        // }

        $q     = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q != '') {
            $config['base_url']  = base_url() . 'produk/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'produk/index.html?q=' . urlencode($q);
        } else {
            $config['base_url']  = base_url() . 'produk/index.html';
            $config['first_url'] = base_url() . 'produk/index.html';
        }

        $config['per_page']          = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows']        = $this->Produk_model->total_rows($q);
        $produk                      = $this->Produk_model->get_limit_data($config['per_page'], $start, $q);
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'produk_data' => $produk,
            'q'           => $q,
            'pagination'  => $this->pagination->create_links(),
            'total_rows'  => $config['total_rows'],
            'start'       => $start,
            'content'     => 'produk/produk_list',
        );
        $this->load->view("layouts", $data);
    }

    public function chart() {
        $data = [
            'content' => "produk/produk_chart",
        ];
        $this->load->view("layouts", $data);
    }

    public function get_tot() {
        $tot           = $this->Produk_model->total_rows();
        $result['tot'] = $tot;
        $result['msg'] = "Berhasil direfresh secara realtime";
        echo json_encode($result);
    }

    public function read($id) {
        $row = $this->Produk_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id'          => $row->id,
                'nama_produk' => $row->nama_produk,
                'harga_beli'  => $row->harga_beli,
                'vendor'      => $row->vendor,
                'status'      => $row->status,
                'created_at'  => $row->created_at,
            );
            $this->load->view('produk/produk_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('produk'));
        }
    }

    public function create() {
        $data = array(
            'button'      => 'Create',
            'action'      => site_url('produk/create_action'),
            'id'          => set_value('id'),
            'nama_produk' => set_value('nama_produk'),
            'harga_beli'  => set_value('harga_beli'),
            'data_vendor' => get_combo('vendor', 'id', 'nama_vendor', array('' => ">> Pilih vendor")),
            'vendor'      => set_value('vendor'),
            'status'      => set_value('status'),
            'created_at'  => set_value('created_at'),
            'content'     => 'produk/produk_form',
        );
        $this->load->view('layouts', $data);
    }

    public function create_action() {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'id'          => getAutoNumber('produk', 'id', 'PROD', 8),
                'nama_produk' => $this->input->post('nama_produk', TRUE),
                'harga_beli'  => $this->input->post('harga_beli', TRUE),
                'vendor'      => $this->input->post('vendor', TRUE),
                'status'      => $this->input->post('status', TRUE),
                'created_at'  => date("Y-m-d H:i:s"),
            );

            $this->Produk_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('produk'));
        }
    }

    public function update($id) {
        $row = $this->Produk_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button'      => 'Update',
                'action'      => site_url('produk/update_action'),
                'id'          => set_value('id', $row->id),
                'nama_produk' => set_value('nama_produk', $row->nama_produk),
                'harga_beli'  => set_value('harga_beli', $row->harga_beli),
                'data_vendor' => get_combo('vendor', 'id', 'nama_vendor', array('' => ">> Pilih vendor")),
                'vendor'      => set_value('vendor', $row->vendor),
                'status'      => set_value('status', $row->status),
                'created_at'  => set_value('created_at', $row->created_at),
                'content'     => "produk/produk_form",
            );
            $this->load->view(layout(), $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('produk'));
        }
    }

    public function update_action() {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
                'nama_produk' => $this->input->post('nama_produk', TRUE),
                'harga_beli'  => $this->input->post('harga_beli', TRUE),
                'vendor'      => $this->input->post('vendor', TRUE),
                'status'      => $this->input->post('status', TRUE),
                'created_at'  => $this->input->post('created_at', TRUE),
            );

            $this->Produk_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('produk'));
        }
    }

    public function delete($id) {
        $row = $this->Produk_model->get_by_id($id);

        if ($row) {
            $this->Produk_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('produk'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('produk'));
        }
    }

    public function changestat() {
        $idprod = $this->input->post("idprod", TRUE);
        // die($idprod);
        $cekprod = $this->Produk_model->get_by_id($idprod);
        $newstat = $cekprod->status == 1 ? 2 : 1;
        $data    = array(
            'status' => $newstat,
        );

        $this->Produk_model->update($idprod, $data);
        $res['msg'] = "Update " . $cekprod->nama_produk . " berhasil";
        echo json_encode($res);
    }

    public function _rules() {
        $this->form_validation->set_rules('nama_produk', 'nama produk', 'trim|required');
        $this->form_validation->set_rules('harga_beli', 'harga beli', 'trim|required');
        $this->form_validation->set_rules('vendor', 'vendor', 'trim|required');
        $this->form_validation->set_rules('status', 'status', 'trim|required');
        $this->form_validation->set_rules('created_at', 'created at', 'trim');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel() {
        $this->load->helper('exportexcel');
        $namaFile  = "produk.xls";
        $judul     = "produk";
        $tablehead = 0;
        $tablebody = 1;
        $nourut    = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
        xlsWriteLabel($tablehead, $kolomhead++, "Nama Produk");
        xlsWriteLabel($tablehead, $kolomhead++, "Harga Beli");
        xlsWriteLabel($tablehead, $kolomhead++, "Vendor");
        xlsWriteLabel($tablehead, $kolomhead++, "Status");
        xlsWriteLabel($tablehead, $kolomhead++, "Created At");

        foreach ($this->Produk_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->nama_produk);
            xlsWriteLabel($tablebody, $kolombody++, $data->harga_beli);
            xlsWriteNumber($tablebody, $kolombody++, $data->vendor);
            xlsWriteNumber($tablebody, $kolombody++, $data->status);
            xlsWriteLabel($tablebody, $kolombody++, $data->created_at);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function backup_database() {

        $this->load->dbutil();

        $prefs = array(
            'format'   => 'sql',
            'filename' => "nananina_" . date("Ymd-His") . '.sql',
        );

        $backup = &$this->dbutil->backup($prefs);

        $db_name = "nananina_" . date("Ymd-His") . '.sql';
        $save    = FCPATH . 'assets/db/' . $db_name;
        $this->load->helper('file');
        write_file($save, $backup);

        $this->load->helper('download');
        force_download($db_name, $backup);

    }

}

/* End of file Produk.php */
/* Location: ./application/controllers/Produk.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2019-06-09 10:36:02 */
/* http://harviacode.com */