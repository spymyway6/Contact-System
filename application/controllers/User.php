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
			if($contact_id){
				$contact = $this->contacts_model->edit_this_contact($contact_id);
			}else{
				$contact = $this->contacts_model->add_this_contact();
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

	public function fetch_all_contacts(){
		if($this->session->userdata('id')){
			$contacts = $this->contacts_model->get_all_contacts();
			if($contacts){
				$data = '';
				foreach($contacts as $contact){
					$data .= '
						<tr>
							<td>
								<div class="tbl-content-wrapper">
									<h6>'.$contact['name'].'</h6>
								</div>
							</td>
							<td>'.$contact['phone'].'</td>
							<td>'.$contact['company'].'</td>
							<td>'.$contact['email'].'</td>
							<td>'.date('M d, Y h:i A', strtotime($contact['date_created'])).'</td>
							<td class="action-row">
								<div class="tbl-act-grp">
									<button class="tbl-act-btn" title="Edit Details" onclick="editContact('.$contact['id'].')"><i class="fa-solid fa-pen-to-square tbl-btn-icon"></i></i></button>
									<button class="tbl-act-btn" title="Delete" onclick="deleteContact('.$contact['id'].')"><i class="fa-solid fa-trash tbl-btn-icon"></i></button>
								</div>
							</td>   
						</tr>
					';
				}

				echo json_encode(
					array(
						'status' => true,
						'data' => $data,
						'message' => 'Contacts fetched successfully.'
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
					'message' => 'A problem occured. Please try again.'
				)
			);
        }
	}

}