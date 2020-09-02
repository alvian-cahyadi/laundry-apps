<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    header('Access-Control-Allow-Origin: *');
    if($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
        header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type');
        exit;
    }
//required for REST API
require(APPPATH . '/libraries/REST_Controller.php');
require APPPATH . 'libraries/Format.php';
use Restserver\Libraries\REST_Controller;
class Packetsiklin extends REST_Controller {
	
	function __construct() {
        parent::__construct();
        $this->load->model('packetmodel', 'pm');
    }
	
	function packets_get() {
        $packets = $this->pm->getPacket_list();
        if ($packets) {
            $this->response($packets, 200);
        } else {
            $this->response(array(), 200);
        }
    }
    function packet_get() {
        if (!$this->get('id')) { //query parameter, example, packets?id=1
            $this->response(NULL, 400);
        }
        $packet = $this->pm->get_packet($this->get('id'));
        if ($packet) {
            $this->response($packet, 200); // 200 being the HTTP response code
        } else {
            $this->response(array(), 500);
        }
    }
	
	function add_packet_post() {
        $packet_id      = $this->post('packet_id');
        $packet_name    = $this->post('packet_name');
        $packet_price   = $this->post('packet_price');
        
        $result = $this->pm->add_packet($packet_id, $packet_name, $packet_price);
        if ($result === FALSE) {
            $this->response(array('status' => 'failed'));
        } else {
            $packets = $this->pm->packetAfter();
            if ($packets) {
                $this->response($packets, 200);
            } else {
                $this->response(array(), 200);
            }
        }
    }
    function update_packet_put() {
        $id              = $this->put('id');
        $packet_id       = $this->put('packet_id');
        $packet_name     = $this->put('packet_name');
        $packet_price    = $this->put('packet_price');
        $result = $this->pm->update_packet($id, $packet_id, $packet_name, $packet_price);
        if ($result === FALSE) {
            $this->response(array('status' => 'failed'));
        } else {
            $packets = $this->pm->packetAfter();
            if ($packets) {
                $this->response($packets, 200);
            } else {
                $this->response(array(), 200);
            }
        }
    }
	
	function delete_packet_delete($id) { //path parameter, example, /delete/1
        $result = $this->pm->delete_packet($id);
        if ($result === FALSE) {
            $this->response(array('status' => 'failed'));
        } else {
            $this->response(array('status' => 'success'));
        }
    }
	
}