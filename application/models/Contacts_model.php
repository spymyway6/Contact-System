<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contacts_model extends CI_Model {

    public function hello(){
        return false;
    }

    public function get_all_contacts($limit, $offset){
        $user_id = $this->session->userdata('id');
        return $this->db->select('*')->from('contacts')->where('user_id', $user_id)->limit($limit, $offset)->get()->result_array();
    }

    public function get_all_contacts_search($limit, $offset, $keyword) {
        $user_id = $this->session->userdata('id');
        $this->db->select('*')->from('contacts');
        $this->db->where('user_id', $user_id);
        if($keyword){
           // Group the LIKE conditions together
            $this->db->group_start(); // Opens a bracket
            $this->db->or_like('name', $keyword, 'both');
            $this->db->or_like('company', $keyword, 'both');
            $this->db->or_like('phone', $keyword, 'both');
            $this->db->or_like('email', $keyword, 'both');
            $this->db->group_end(); // Closes the bracket 
        }
        // Set the limit and offset for pagination
        $this->db->limit($limit, ($offset));
        return $this->db->get()->result_array();
    }

    public function get_contacts_count($keyword='') {
        $user_id = $this->session->userdata('id');
        $this->db->select('COUNT(*) as count')->from('contacts');
        $this->db->where('user_id', $user_id);
        if($keyword){
           // Group the LIKE conditions together
            $this->db->group_start(); // Opens a bracket
            $this->db->or_like('name', $keyword, 'both');
            $this->db->or_like('company', $keyword, 'both');
            $this->db->or_like('phone', $keyword, 'both');
            $this->db->or_like('email', $keyword, 'both');
            $this->db->group_end(); // Closes the bracket 
        }
        // Set the limit and offset for pagination
        $result = $this->db->get()->row_array();
        return $result['count'];
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

    public function fetch_this_contact($contact_id){
        $user_id = $this->session->userdata('id');
        return $this->db->select('*')->from('contacts')->where('id', $contact_id)->where('user_id', $user_id)->get()->row_array();
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

    public function delete_contact($contact_id) {
        $this->db->where('id', $contact_id);
        $this->db->delete('contacts');
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}   
