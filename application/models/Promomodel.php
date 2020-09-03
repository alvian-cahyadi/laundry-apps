<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Promomodel extends CI_Model {
    private $promos_laundry = 'promos_laundry';
    
    function getPromo_list() {
        $this->db->order_by('promos_id', 'ASC');
        return $this->db->get($this->promos_laundry)->result();
        // if ($query) {
        //     return $query->result();
        // }
        // return NULL;
    }

    function promoAfter(){
        $this->db->order_by('date','DESC');
        return $this->db->get($this->promos_laundry)->result();
    }

    function get_promo($id) {
        $query = $this->db->get_where($this->promos_laundry, array("id" => $id));
        if ($query) {
            return $query->row();
        }
        return NULL;
    }
    
    function add_promo($promo_id, $promo_name, $promo_format, $promo_value) {
        $data = array('promos_id' => $promo_id, 'promos_name' => $promo_name, 'promos_value' => $promo_value, 'promos_format' => $promo_format, 'date' => date("Y-m-d h:i:sa"));
        $this->db->insert($this->promos_laundry, $data);
    }
    function update_promo($id, $promo_id, $promo_name, $promo_format, $promo_value){
        $data = array('promos_id' => $promo_id, 'promos_name' => $promo_name, 'promos_value' => $promo_value, 'promos_format' => $promo_format, 'date' => date("Y-m-d h:i:sa"));
        $this->db->where('id', $id);
        $this->db->update($this->promos_laundry, $data);
    }
    
    function delete_promo($id) {
        $this->db->where('id', $id);
        $this->db->delete($this->promos_laundry);
    }
}