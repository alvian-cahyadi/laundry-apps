<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Packetmodel extends CI_Model {
    private $packet_laundry = 'packet_laundry';
    
    function getPacket_list() {
        
        $this->db->order_by('packet_id','ASC');
        return $this->db->get($this->packet_laundry)->result();
         
        // if ($query) {
        //     return $query->result();
        // }
        // return NULL;
    }

    function packetAfter() {
        
        $this->db->order_by('date','DESC');
        return $this->db->get($this->packet_laundry)->result();
         
        // if ($query) {
        //     return $query->result();
        // }
        // return NULL;
    }

    function get_packet($id) {
        $query = $this->db->get_where($this->packet_laundry, array("id" => $id));
        if ($query) {
            return $query->row();
        }
        return NULL;
    }
    
    function add_packet($packet_id, $packet_name, $packet_price) {
        $data = array('packet_id' => $packet_id, 'packet_name' => $packet_name, 'packet_price' => $packet_price, 'date' => date("Y-m-d h:i:sa"));
        $this->db->insert($this->packet_laundry, $data);
    }
    function update_packet($id, $packet_id, $packet_name, $packet_price){
        $data = array('packet_id' => $packet_id, 'packet_name' => $packet_name, 'packet_price' => $packet_price, 'date' => date("Y-m-d h:i:sa"));
        $this->db->where('id', $id);
        $this->db->update($this->packet_laundry, $data);
    }
    
    function delete_packet($id) {
        $this->db->where('id', $id);
        $this->db->delete($this->packet_laundry);
    }
}