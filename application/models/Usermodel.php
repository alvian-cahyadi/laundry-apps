<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usermodel extends CI_Model {
    private $users_mongo          = 'users';
    private $user_laundry         = 'user_laundry';

    # get data from MongoDB use library for get connection
    # start of function of users profile
    public function getUsers_list(){
        $query = $this->mongo_db->get($this->users_mongo);
        if($query){
            return $query;
        }
        return NULL;
    }
    
    public function getUsers($id){
        $query = $this->mongo_db->where(array('_id'=> new mongoId($id)))->get($this->users_mongo);
        if($query){
            return $query;
        }
        return NULL;
    }

    public function insertUsers($username, $firstn, $lastn, $addr, $city, $zip, $bod, $pob, $id_number, $maried, $email, $phone) {
        $data = array(
            'username' => $username, 
            'first_name' => $firstn,
            'last_name' => $lastn,
            'address' => $addr,
            'city' => $city,
            'zip' => $zip,
            'birth_of_date' => $bod,
            'place_of_birth' => $pob,
            'id_number' => $id_number,
            'marital_status' => $maried,
            'email' => $email,
            'phone_number' => $phone
        );
        $this->mongo_db->insert('users', $data);
    }

    public function updateUsers($id, $username, $firstn, $lastn, $addr, $city, $zip, $bod, $pob, $id_number, $maried, $email, $phone){
        $data = array( 
            'username' => $username,
            'first_name' => $firstn,
            'last_name' => $lastn,
            'address' => $addr,
            'city' => $city,
            'zip' => $zip,
            'birth_of_date' => $bod,
            'place_of_birth' => $pob,
            'id_number' => $id_number,
            'marital_status' => $maried,
            'email' => $email,
            'phone_number' => $phone
        );
        $this->mongo_db->where(array('_id'=> new mongoId($id)))->set($data)->update('users');
    }

    public function deleteUsers($id){
        $this->mongo_db->where(array('_id'=> new mongoId($id)))->delete('users');
    }

    # end of function of users profile

    # get data login form mysql 
    # start function of users login
    public function getLogin_list(){
        $query = $this->db->get($this->user_laundry);
        return $query->result();
    }

    public function getLogin($id){
        $this->db->where('username', $id);
        $query = $this->db->get($this->user_laundry);
        return $query->row();
    }

    public function add_login($username, $password, $roles){
        $data = array('username' => $username, 'password' => MD5($password), 'roles' => $roles);
        $this->db->insert($this->user_laundry);
    }

    public function update_login($id, $username, $password, $roles){
        $data = array('username' => $username, 'password' => MD5($password), 'roles' => $roles);
        $this->db->where('username', $id);
        $this->db->update($this->user_laundry, $data);
    }

    public function delete_login($username){
        $this->db->where('username', $username);
        $this->db->delete($this->user_laundry);
    }

    public function cek_oldpass($username, $password){
        $this->db->where(array('username' => $username, 'password' => $password));
        $this->db->from($this->user_laundry);
        return $this->db->countAllResults()->row();
    }
    # end function of users login
}

/* End of file Usermodel.php */
