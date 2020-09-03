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
        if (!$this->get('id')) { //query parameter, example, Service?id=1
            $this->response(NULL, 400);
        }
        $service = $this->sm->get_service($this->get('id'));
        if ($service) {
            $this->response($service, 200); // 200 being the HTTP response code
        } else {
            $this->response(array(), 500);
        }
    }
	
	function add_service_post() {
        $service_id      = $this->post('service_id');
        $service_name    = $this->post('service_name');
        $service_price   = $this->post('service_price');
        
        $result = $this->sm->add_service($service_id, $service_name, $service_price);
        if ($result === FALSE) {
            $this->response(array('status' => 'failed'));
        } else {
            $Service = $this->sm->serviceAfter();
            if ($Service) {
                $this->response($Service, 200);
            } else {
                $this->response(array(), 200);
            }
        }
    }
    function update_service_put() {
        $id               = $this->put('id');
        $service_id       = $this->put('service_id');
        $service_name     = $this->put('service_name');
        $service_price    = $this->put('service_price');
        $result = $this->sm->update_service($id, $service_id, $service_name, $service_price);
        if ($result === FALSE) {
            $this->response(array('status' => 'failed'));
        } else {
            $Service = $this->sm->serviceAfter();
            if ($Service) {
                $this->response($Service, 200);
            } else {
                $this->response(array(), 200);
            }
        }
    }
	
	function delete_service_delete($id) { //path parameter, example, /delete/1
        $result = $this->sm->delete_service($id);
        if ($result === FALSE) {
            $this->response(array('status' => 'failed'));
        } else {
            $this->response(array('status' => 'success'));
        }
    }
	
}