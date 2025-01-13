<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct(){
        parent::__construct();
	}
	
	public function dashboard(){
		if($this->session->userdata('id')){
			$data['is_page'] = 'dashboard';
			$data['contacts'] = $this->contacts_model->get_all_contacts();
			$this->load->view('User/dashboard', $data);
		}else{
			redirect('/login');
        }
	}

	public function add_new_contact(){
		if($this->session->userdata('id')){
			$contact_id = $this->input->post('sel_contact_id');
			if($contact_id !== 0){
				$contact = $this->contacts_model->add_this_contact();
			}else{
				$contact = $this->contacts_model->edit_this_contact($contact_id);
			}

			if($contact){
				echo json_encode(
					array(
						'status' => true,
						'data' => [],
						'message' => 'Contact saved successfully.'
					)
				);
			}else{
				echo json_encode(
					array(
						'status' => false,
						'data' => [],
						'message' => 'The contact you are adding is already exists.'
					)
				);
			}
		}else{
			echo json_encode(
				array(
					'status' => false,
					'data' => [],
					'message' => 'A problem occured. Please try again.'
				)
			);
        }
	}

	public function delete_contact($contact_id=""){
		if($this->session->userdata('id')){
			if($contact_id){
				$contact_deleted = $this->contacts_model->delete_contact($contact_id);
				if($contact_deleted){
					echo json_encode(
						array(
							'status' => true,
							'data' => [],
							'message' => 'Contact deleted successfully.'
						)
					);
				}else{
					echo json_encode(
						array(
							'status' => false,
							'data' => [],
							'message' => 'Error deleting contact.'
						)
					);
				}
			}else{
				echo json_encode(
					array(
						'status' => false,
						'data' => [],
						'message' => 'Error deleting contact. Invalid ID parameters.'
					)
				);
			}
		}else{
			echo json_encode(
				array(
					'status' => false,
					'data' => [],
					'message' => 'A problem occured. Please try again.'
				)
			);
        }
	}
	
	public function fetch_contact($contact_id=""){
		if($this->session->userdata('id')){
			if($contact_id){
				$contact = $this->contacts_model->fetch_this_contact($contact_id);
				if($contact){
					echo json_encode(
						array(
							'status' => true,
							'data' => $contact,
							'message' => 'Contact fetched successfully.'
						)
					);
				}else{
					echo json_encode(
						array(
							'status' => false,
							'data' => [],
							'message' => 'Error fetching contacts.'
						)
					);
				}
			}else{
				echo json_encode(
					array(
						'status' => false,
						'data' => [],
						'message' => 'Error fetching contacts.'
					)
				);
			}
		}else{
			echo json_encode(
				array(
					'status' => false,
					'data' => [],
					'message' => 'A problem occured. Please try again.'
				)
			);
        }
	}

	

}