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
class Promosiklin extends REST_Controller {
	
	function __construct() {
        parent::__construct();
        $this->load->model('promomodel', 'pm');
    }
	
	function promos_get() {
        $promos = $this->pm->getPromo_list();
        if ($promos) {
            $this->response($promos, 200);
        } else {
            $this->response(array(), 200);
        }
    }
    function promo_get() {
        if (!$this->get('id')) { //query parameter, example, promo?id=1
            $this->response(NULL, 400);
        }
        $promo = $this->pm->get_promo($this->get('id'));
        if ($promo) {
            $this->response($promo, 200); // 200 being the HTTP response code
        } else {
            $this->response(array(), 500);
        }
    }
	
	function add_promo_post() {
        $promo_id      = $this->post('promo_id');
        $promo_name    = $this->post('promo_name');
        $promo_format  = $this->post('promo_format');
        $promo_value   = $this->post('promo_value');
        
        $result = $this->pm->add_promo($promo_id, $promo_name, $promo_format, $promo_value);
        if ($result === FALSE) {
            $this->response(array('status' => 'failed'));
        } else {
            $promos = $this->pm->promoAfter();
            if ($promos) {
                $this->response($promos, 200);
            } else {
                $this->response(array(), 200);
            }
        }
    }
    function update_promo_put() {
        $id             = $this->put('id');
        $promo_id       = $this->put('promo_id');
        $promo_name     = $this->put('promo_name');
        $promo_format   = $this->put('promo_format');
        $promo_value    = $this->put('promo_value');
        $result = $this->pm->update_promo($id, $promo_id, $promo_name, $promo_format, $promo_value);
        if ($result === FALSE) {
            $this->response(array('status' => 'failed'));
        } else {
            $promos = $this->pm->promoAfter();
            if ($promos) {
                $this->response($promos, 200);
            } else {
                $this->response(array(), 200);
            }
        }
    }
	
	function delete_promo_delete($id) { //path parameter, example, /delete/1
        $result = $this->pm->delete_promo($id);
        if ($result === FALSE) {
            $this->response(array('status' => 'failed'));
        } else {
            $this->response(array('status' => 'success'));
        }
    }
	
}