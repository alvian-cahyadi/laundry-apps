<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Itemmodel extends CI_Model {
    private $items_laundry = 'items_laundry';
    
    function getItem_list() {
        $query = $this->db->get($this->items_laundry);
        if ($query) {
            return $query->result();
        }
        return NULL;
    }
    function get_item($id) {
        $query = $this->db->get_where($this->items_laundry, array("items_id" => $id));
        if ($query) {
            return $query->row();
        }
        return NULL;
    }
    
    function add_item($item_id, $item_name, $item_format) {
        $data = array('items_id' => $item_id, 'items_name' => $item_name, 'format' => $item_format);
        $this->db->insert($this->items_laundry, $data);
    }
    function update_item($id, $item_id, $item_name, $item_format){
        $data = array('items_id' => $item_id, 'items_name' => $item_name, 'format' => $item_format);
        $this->db->where('items_id', $id);
        $this->db->update($this->items_laundry, $data);
    }
    
    function delete_item($item_id) {
        $this->db->where('items_id', $item_id);
        $this->db->delete($this->items_laundry);
    }
}