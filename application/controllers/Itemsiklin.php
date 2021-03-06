<?php
defined('BASEPATH') OR exit('No direct script access allowed');

header('Access-Control-Allow-Origin: *');
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type');
    exit;
}
//required for REST API
require(APPPATH . '/libraries/REST_Controller.php');
require APPPATH . 'libraries/Format.php';
use Restserver\Libraries\REST_Controller;
class Itemsiklin extends REST_Controller {
	
	function __construct() {
        parent::__construct();
        $this->load->model('itemmodel', 'im');
    }
	
	function items_get() {
        $items = $this->im->getItem_list();
        if ($items) {
            $this->response($items, 200);
        } else {
            $this->response(array(), 200);
        }
    }

    function item_get() {
        if (!$this->get('id')) { //query parameter, example, items?id=1
            $this->response(NULL, 400);
        }
        $item = $this->im->get_item($this->get('id'));
        if ($item) {
            $this->response($item, 200); // 200 being the HTTP response code
        } else {
            $this->response(array(), 500);
        }
    }
	
	function add_item_post() {
        $item_id      = $this->post('item_id');
        $item_name    = $this->post('item_name');
        $item_format   = $this->post('item_format');
        
        $result = $this->im->add_item($item_id, $item_name, $item_format);
        if ($result === FALSE) {
            $this->response(array('status' => 'failed'));
        } else {
            $items = $this->im->itemAfter();
            if ($items) {
                $this->response($items, 200);
            } else {
                $this->response(array(), 200);
            }
        }
    }
    function update_item_put() {
        $id             = $this->put('id');
        $item_id        = $this->put('item_id');
        $item_name      = $this->put('item_name');
        $item_format    = $this->put('item_format');
        $result = $this->im->update_item($id, $item_id, $item_name, $item_format);
        if ($result === FALSE) {
            $this->response(array('status' => 'failed'));
        } else {
            $items = $this->im->itemAfter();
            if ($items) {
                $this->response($items, 200);
            } else {
                $this->response(array(), 200);
            }
        }
    }
	
	function delete_item_delete($id) { //path parameter, example, /delete/1
        $result = $this->im->delete_item($id);
        if ($result === FALSE) {
            $this->response(array('status' => 'failed'));
        } else {
            $this->response(array('status' => 'success'));
        }
    }
	
}