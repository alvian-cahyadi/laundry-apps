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
class Servicesiklin extends REST_Controller {
	
	function __construct() {
        parent::__construct();
        $this->load->model('servicemodel', 'sm');
    }
	
	function services_get() {
        $Service = $this->sm->getService_list();
        if ($Service) {
            $this->response($Service, 200);
        } else {
            $this->response(array(), 200);
        }
    }
    function service_get() {
        if (!$this->get('serviceId')) { //query parameter, example, Service?id=1
            $this->response(NULL, 400);
        }
        $service = $this->sm->get_service($this->get('serviceId'));
        if ($service) {
            $this->response($service, 200); // 200 being the HTTP response code
        } else {
            $this->response(array(), 500);
        }
    }
	
	function add_service_post() {
        $service_id      = $this->post('serviceId');
        $service_name    = $this->post('serviceName');
        $service_price   = $this->post('servicePrice');
        
        $result = $this->sm->add_service($service_id, $service_name, $service_price);
        if ($result === FALSE) {
            $this->response(array('status' => 'failed'));
        } else {
            $this->response(array('status' => 'success'));
        }
    }
    function update_service_put() {
        $service_id       = $this->put('serviceId');
        $service_name     = $this->put('serviceName');
        $service_price    = $this->put('servicePrice');
        $result = $this->sm->update_service($service_id, $service_name, $service_price);
        if ($result === FALSE) {
            $this->response(array('status' => 'failed'));
        } else {
            $this->response(array('status' => 'success'));
        }
    }
	
	function delete_service_delete($service_id) { //path parameter, example, /delete/1
        $result = $this->sm->delete_service($service_id);
        if ($result === FALSE) {
            $this->response(array('status' => 'failed'));
        } else {
            $this->response(array('status' => 'success'));
        }
    }
	
}