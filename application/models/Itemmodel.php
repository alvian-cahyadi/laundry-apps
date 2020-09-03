<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Itemmodel extends CI_Model {
    private $items_laundry = 'items_laundry';
    
    function getItem_list() {
        $this->db->order_by('items_id','ASC');
        return $this->db->get($this->items_laundry)->result();
        // if ($query) {
        //     return $query->result();
        // }
        // return NULL;
    }

    function itemAfter(){
        $this->db->order_by('date', 'DESC');
        return $this->db->get($this->item_laundry)->result();
    }

    function get_item($id) {
        $query = $this->db->get_where($this->items_laundry, array("id" => $id));
        if ($query) {
            return $query->row();
        }
        return NULL;
    }
    
    function add_item($item_id, $item_name, $item_format) {
        $data = array('items_id' => $item_id, 'items_name' => $item_name, 'format' => $item_format, 'date' => date("Y-m-d h:i:sa") );
        $this->db->insert($this->items_laundry, $data);
    }
    function update_item($id, $item_id, $item_name, $item_format){
        $data = array('items_id' => $item_id, 'items_name' => $item_name, 'format' => $item_format, 'date' => date("Y-m-d h:i:sa") );
        $this->db->where('id', $id);
        $this->db->update($this->items_laundry, $data);
    }
    
    function delete_item($id) {
        $this->db->where('id', $id);
        $this->db->delete($this->items_laundry);
    }
}