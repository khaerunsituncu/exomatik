<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_konten extends CI_Model {

    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function select_data_konten($order,$limit){//mengambil semua data dari table

        $this->db->select('id_konten,judul_konten,deskripsi,gambar,tag,tgl_rilis,id_user,komentar');
        $this->db->order_by($order, 'DESC');
        $this->db->limit($limit,0);
        $this->db->where('status','rilis');
        $data = $this->db->get('table_konten')->result_array();

        for ($i=0; $i < count($data); $i++){ 
            $data[$i]['link'] = base_url().'konten/'.str_replace(" ","-",preg_replace('/[^A-Z a-z0-9\-]/','', strtolower($data[$i]['judul_konten']))).'/'.$data[$i]['id_konten'];
            $data[$i]['tgl_rilis'] = date_format(date_create($data[$i]['tgl_rilis']), "d M Y");
        }

        return $data;
    }

    public function select_data_detail_konten(){
        $this->db->where('id_konten',$this->uri->segment(3));
        $data = $this->db->get('table_konten')->row_array();

        return $data;
    }
   
}
?>