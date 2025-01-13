<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contacts_model extends CI_Model {

    public function hello(){
        return false;
    }

    public function get_all_contacts(){
        $user_id = $this->session->userdata('id');
        return $this->db->select('*')->from('contacts')->where('user_id', $user_id)->get()->result_array();
    }

    public function add_this_contact(){
        $user_id = $this->session->userdata('id');
        $name    = $this->input->post('name');
        $phone   = $this->input->post('phone');
        $company = $this->input->post('company');
        $email   = $this->input->post('email');
        $data    = $this->db->select('*')->from('contacts')
            ->where("phone", $phone)
            ->where("user_id", $user_id)
        ->get()->row_array();

        if(isset($data['id'])){
            return false;
        }else{
            $data = array(
                'name'    => $name,
                'phone'   => $phone,
                'email'   => $email,
                'company' => $company,
                'user_id' => $user_id,
            );
            $this->db->insert('contacts', $data);
            $user_id = $this->db->insert_id();
            return $user_id;
        }
    }

    public function edit_this_contact($contact_id){
        $user_id = $this->session->userdata('id');
        $name    = $this->input->post('name');
        $phone   = $this->input->post('phone');
        $company = $this->input->post('company');
        $email   = $this->input->post('email');
        $data    = $this->db->select('*')->from('contacts')
            ->where("phone", $phone)
            ->where("user_id", $user_id)
            ->where("id !=", $contact_id)
        ->get()->row_array();

        if(isset($data['id'])){
            return false;
        }else{
            $data = array(
                'name'    => $name,
                'phone'   => $phone,
                'email'   => $email,
                'company' => $company,
            );
            $this->db->where('id', $contact_id);
            $result = $this->db->update('contacts', $data);
            return true;
        }
    }
}   
