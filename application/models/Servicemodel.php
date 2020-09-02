<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Servicemodel extends CI_Model {
    private $services_laundry = 'services_laundry';
    
    function getService_list() {
        $query = $this->db->get($this->services_laundry);
        if ($query) {
            return $query->result();
        }
        return NULL;
    }
    function get_service($id) {
        $query = $this->db->get_where($this->services_laundry, array("services_id" => $id));
        if ($query) {
            return $query->row();
        }
        return NULL;
    }
    
    function add_service($service_id, $service_name, $service_price) {
        $data = array('services_id' => $service_id, 'services_name' => $service_name, 'price' => $service_price);
        $this->db->insert($this->services_laundry, $data);
    }
    function update_service($id, $service_id, $service_name, $service_price){
        $data = array('services_id' => $service_id, 'services_name' => $service_name, 'price' => $service_price);
        $this->db->where('services_id', $id);
        $this->db->update($this->services_laundry, $data);
    }
    
    function delete_service($service_id) {
        $this->db->where('services_id', $service_id);
        $this->db->delete($this->services_laundry);
    }
}