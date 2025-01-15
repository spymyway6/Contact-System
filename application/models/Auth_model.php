<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {

    public function check_user_if_exist($email, $password){
        $data =$this->db->select('*')
            ->from('users')
            ->where("email", $email)
            ->where("password", md5($password))
        ->get()->row_array();

        return isset($data['id']) ? $data : false;
    }

    public function register_this_user(){
        $email      = $this->input->post('email');
        $first_name = $this->input->post('first_name');
        $last_name  = $this->input->post('last_name');
        $password   = md5($this->input->post('password'));
        $data = $this->db->select('*')->from('users')->where("email", $email)->get()->row_array();
        if(isset($data['id'])){
            return false;
        }else{
            $data = array(
                'first_name' => $first_name,
                'last_name'  => $last_name,
                'email'      => $email,
                'password'   => $password,
            );
            $this->db->insert('users', $data);
            $user_id = $this->db->insert_id();
            $this->session->set_userdata(['id' => $user_id]);
            return $user_id;            
        }
    }
}   
