<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Usersiklin extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Usermodel', 'um');
    }
    
    public function usersprofile() {
        header('Access-Control-Allow-Origin: *');
        $users = $this->um->getUsers_list();
        $this->output->set_content_type('application/json')->set_output(json_encode($users));
    }

    public function userprofile_scc() {
        header('Access-Control-Allow-Origin: *'); 

        $userid             = $this->input->post('_id');
        $users              = $this->um->getUsers($userid);
        $userData           = array(
            '_id'           => $users['_id'],
            'username'      => $users['username'],
            'first_name'    => $users['first_name'],
            'last_name'     => $users['last_name'],
            'address'       => $users['address'],
            'city'          => $users['city'],
            'zip'           => $users['zip'],
            'birth_of_date' => $users['birth_of_date'],
            'place_of_birth'=> $users['place_of_birth'],
            'id_number'     => $users['id_number'],
            'marital_status'=> $users['marital_status'],
            'email'         => $users['email'],
            'phone_number'  => $users['phone_number']
        );
        $this->output->set_content_type('application/json')->set_output(json_encode($userData));
    }

    public function addprofile() {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');

        $formdata = json_decode(file_get_contents('php://input'), true);
        
        if(!empty($formdata)){        
            $username       = $formdata['username'];
            $firstn         = $formdata['first_name'];
            $lastn          = $formdata['last_name'];
            $addr           = $formdata['address'];
            $city           = $formdata['city'];
            $zip            = $formdata['zip'];
            $bod            = $formdata['birth_of_date'];
            $pob            = $formdata['place_of_birth'];
            $id_number      = $formdata['id_number'];
            $maried         = $formdata['marital_status'];
            $email          = $formdata['email'];
            $phone          = $formdata['phone_number'];

            $result         = $this->um->insertUsers($username, $firstn, $lastn, $addr, $city, $zip, $bod, $pob, $id_number, $maried, $email, $phone);
           
            $response       = $this->um->usersAfter();
        } else {
            $response       = array('status' => 'failed');
        }

        $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }

    public function updateprofile(){
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');

        $formdata = json_decode(file_get_contents('php://input'), true);
        
        if(!empty($formdata)){ 
            $id             = $formdata['_id'];
            $username       = $formdata['username'];
            $firstn         = $formdata['first_name'];
            $lastn          = $formdata['last_name'];
            $addr           = $formdata['address'];
            $city           = $formdata['city'];
            $zip            = $formdata['zip'];
            $bod            = $formdata['birth_of_date'];
            $pob            = $formdata['place_of_birth'];
            $id_number      = $formdata['id_number'];
            $maried         = $formdata['marital_status'];
            $email          = $formdata['email'];
            $phone          = $formdata['phone_number'];

            $result = $this->um->updateUsers($id, $username, $firstn, $lastn, $addr, $city, $zip, $bod, $pob, $id_number, $maried, $email, $phone);

            $response       = $this->um->usersAfter();
        } else {
            $response       = array('status' => 'failed');
        }

        $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }
    
    public function deleteprofile($id){
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');

        $id     = $this->input->post('_id');

        $result = $this->um->deleteUsers($id);
        $response    = array(
            'status' => 'success'
        );

        $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }

    public function userLogin_list(){
        header('Access-Control-Allow-Origin: *');

        $userlogin = $this->um->getLogin_list();
        $this->output->set_content_type('application/json')->set_output(json_encode($userlogin));
    }

    public function userLogin(){
        header('Access-Control-Allow-Origin: *');

        $id             = $this->input->post('usernameUser');
        $userLogin      = $this->um->getLogin($id);
        $userloginData  = array(
            'id'        => $userLogin->id,
            'username'  => $userLogin->username,
            'password'  => $userLogin->password,
            'role'      => $userLogin->role,
            'isblocked' => $userLogin->isblocked
        );
        $this->output->set_content_type('application/json')->set_output(json_encode($userloginData));
    }

    public function addLogin(){
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');

        $formdata = json_encode(file_get_contents('php://input'), true);
            
        if(!empty($formdata)){
            $username   = $this->input->post('username');
            $password   = $this->input->post('password');
            $role       = $this->input->post('role');

            $result     = $this->um->add_login($username, $password, $roles);

            $response   = $this->um->loginAfter();
        } else {
            $response       = array('status' => 'error');
        }

        $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }

    public function updateLogin(){
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');

        $formdata = json_encode(file_get_contents('php://input'), true);
            
        if(!empty($formdata)){
            $id         = $this->input->post('id');
            $username   = $this->input->post('username');
            $password   = $this->input->post('password');
            $role       = $this->input->post('role');

            $result     = $this->um->update_login($id, $username, $password, $roles);

            $response   = $this->um->loginAfter();
        } else {
            $response       = array('status' => 'error');
        }

        $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }

    public function deleteLogin(){
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');

        $id     = $this->input->post('id');

        $result = $this->um->deleteUsers($id);
        $response    = array(
            'status' => 'success'
        );

        $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }
}

/* End of file Usersiklin.php */
