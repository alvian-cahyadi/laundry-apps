<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Usersiklin extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Usermodel', 'um');
    }
    
    public function users_get() {
        header('Access-Control-Allow-Origin: *');
        $users = $this->um->getUsers_list();
        $this->output->set_content_type('application/json')->set_output(json_encode($users));
    }

    public function user_get() {
        header('Access-Control-Allow-Origin: *'); 

        $userid             = $this->input->post('id');
        $users              = $this->um->getUsers($userid);
        $userData           = array(
            'idUser'            => $users['_id'],
            'usernameUser'      => $users['username'],
            'firstNameUser'     => $users['first_name'],
            'lastNameUser'      => $users['last_name'],
            'addressUser'       => $users['address'],
            'cityUser'          => $users['city'],
            'zipUser'           => $users['zip'],
            'birthUser'         => $users['birth_of_date'],
            'placeUser'         => $users['place_of_birth'],
            'idnumberUser'      => $users['id_number'],
            'maritalstatusUser' => $users['marital_status'],
            'emailUser'         => $users['email'],
            'phonenumberUser'   => $users['phone_number']
        );
        $this->output->set_content_type('application/json')->set_output(json_encode($userData));
    }

    public function add_users() {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');

        $formdata = json_decode(file_get_contents('php://input'), true);
        
        if(!empty($formdata)){        
            $username       = $formdata['usernameUser'];
            $firstn         = $formdata['firstNameUser'];
            $lastn          = $formdata['lastNameUser'];
            $addr           = $formdata['addressUser'];
            $city           = $formdata['cityUser'];
            $zip            = $formdata['zipUser'];
            $bod            = $formdata['birthUser'];
            $pob            = $formdata['placeUser'];
            $id_number      = $formdata['idnumberUser'];
            $maried         = $formdata['maritalstatusUser'];
            $email          = $formdata['emailUser'];
            $phone          = $formdata['phonenumberUser'];

            $result         = $this->um->insertUsers($username, $firstn, $lastn, $addr, $city, $zip, $bod, $pob, $id_number, $maried, $email, $phone);

            $response       = array('status' => 'success', 'message' => 'user added successfully');
        } else {
            $response       = array('status' => 'error');
        }

        $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }

    public function update_user(){
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');

        $formdata = json_decode(file_get_contents('php://input'), true);
        
        if(!empty($formdata)){ 
            $id             = $formdata['idUser'];
            $username       = $formdata['usernameUser'];
            $firstn         = $formdata['firstNameUser'];
            $lastn          = $formdata['lastNameUser'];
            $addr           = $formdata['addressUser'];
            $city           = $formdata['cityUser'];
            $zip            = $formdata['zipUser'];
            $bod            = $formdata['birthUser'];
            $pob            = $formdata['placeUser'];
            $id_number      = $formdata['idnumberUser'];
            $maried         = $formdata['maritalstatusUser'];
            $email          = $formdata['emailUser'];
            $phone          = $formdata['phonenumberUser'];

            $result = $this->um->updateUsers($id, $username, $firstn, $lastn, $addr, $city, $zip, $bod, $pob, $id_number, $maried, $email, $phone);

            $response       = array('status' => 'success', 'message' => 'user updated successfully');
        } else {
            $response       = array('status' => 'error');
        }

        $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }
    
    public function delete_user($id){
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');

        $id     = $this->input->post('userId');

        $result = $this->um->deleteUsers($id);
        $response    = array(
            'message'   => 'Packet delete successfully'
        );

        $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }

    public function userLogin_list(){
        header('Access-Control-Allow-Origin: *');

        $userlogin = $this->um->getLogin_list();
        $this->output->set_content_type('application/json')->set_output(json_encode($userlogin));
    }

    public function userLogin_get(){
        header('Access-Control-Allow-Origin: *');

        $id             = $this->input->post('usernameUser');
        $userLogin      = $this->um->getLogin($id);
        $userloginData  = array(
            'idUser'        => $userLogin->username,
            'usernameUser'  => $userLogin->username,
            'passwordUser'  => $userLogin->password,
            'roleUser'      => $userLogin->role,
            'isblockedUser' => $userLogin->isblocked
        );
        $this->output->set_content_type('application/json')->set_output(json_encode($userloginData));
    }

    public function userLogin_add(){
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');

        $formdata = json_encode(file_get_contents('php://input'), true);
            
        if(!empty($formdata)){
            $username   = $this->input->post('usernameUser');
            $password   = $this->input->post('passwordUser');
            $role       = $this->input->post('roleUser');

            $result     = $this->um->add_login($username, $password, $roles);

            $response   = array('status' => 'success', 'message' => 'add data login successfully');
        } else {
            $response       = array('status' => 'error');
        }

        $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }

    public function userLogin_update(){
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');

        $formdata = json_encode(file_get_contents('php://input'), true);
            
        if(!empty($formdata)){
            $id         = $this->input->post('idUser');
            $username   = $this->input->post('usernameUser');
            $password   = $this->input->post('passwordUser');
            $role       = $this->input->post('roleUser');

            $result     = $this->um->update_login($id, $username, $password, $roles);

            $response   = array('status' => 'success', 'message' => 'add data login successfully');
        } else {
            $response       = array('status' => 'error');
        }

        $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }

    public function userLogin_delete(){
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');

        $id     = $this->input->post('idUser');

        $result = $this->um->deleteUsers($id);
        $response    = array(
            'message'   => 'Packet delete successfully'
        );

        $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }
}

/* End of file Usersiklin.php */
