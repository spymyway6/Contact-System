<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct(){
        parent::__construct();
	}
	
	public function dashboard(){
		if($this->session->userdata('id')){
			$data['is_page'] = 'dashboard';
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
			$limit 	  	  = ($this->input->post('limit')) ? $this->input->post('limit') : 5;
			$offset       = ($this->input->post('page')) ? $this->input->post('page') : 0;
			$keyword  	  = ($this->input->post('keyword')) ? $this->input->post('keyword') : '';
			$total_rows   = $this->contacts_model->get_contacts_count($keyword); // Total Contacts
			$per_page     = $limit;
			$total_pages  = ceil($total_rows / $limit);
			$current_page = floor($offset / $per_page);
			
			$pagination_num = '';
			$page_range 	= 5; // Limit the number of page links to show
			$start_page 	= max(1, $current_page - floor($page_range / 2));
			$end_page 		= min($total_pages, $current_page + floor($page_range / 2));

			// Adjust the range to ensure it fits within the total pages
			if ($end_page - $start_page < $page_range - 1) {
				if ($start_page == 1) {
					$end_page = min($total_pages, $page_range);
				} else {
					$start_page = max(1, $total_pages - $page_range + 1);
				}
			}
			$contacts = $this->contacts_model->get_all_contacts_search($limit, $offset, $keyword);
			$page_row = 0;
			for ($i = $start_page; $i <= $end_page; $i++):
				// Calculate the correct offset for each page
				$page_row = ($i - 1) * $limit;
				$pagination_num .= '<button type="button" class="pagination-btn page-num ' . ($current_page == ($i-1) ? 'active' : '') . '" onclick="fetchAllContacts(' . $page_row . ')">' . $i . '</button>';
			endfor;

			$prev_offset = ($offset) ? $offset - $limit : 0;
			$pagination_prev = '<button type="button" class="pagination-btn page-arrows" '.(!$offset ? 'disabled' : '').' onclick="fetchAllContacts(' . $prev_offset . ')"><i class="fa-solid fa-angles-left"></i></button>';

			$next_offset = $offset + $limit;
			$pagination_next = '<button type="button" class="pagination-btn page-arrows" '.(($next_offset<=$page_row) ? '' : 'disabled').' onclick="fetchAllContacts(' . $next_offset . ')"><i class="fa-solid fa-angles-right"></i></button>';
			
			$pagination = '
				<ul>
					<li><button type="button" class="pagination-btn page-arrows pag-words" onclick="fetchAllContacts(0)">First</button></li>
					'.$pagination_prev.'
					<li class="page-num-wrapper">
						'.$pagination_num.'
					</li>
					'.$pagination_next.'
					<li><button class="pagination-btn page-arrows pag-words" onclick="fetchAllContacts('.($page_row).')">Last</button></li>
				</ul>
			';
			$total_of = 0;
			if($contacts){
				$data = '';
				foreach($contacts as $contact){
					$total_of+=1;
					$data .= '
						<tr>
							<td>'.$contact['name'].'</td>
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
						'data' => array(
							'contacts' => $data,
							'pagination' => $pagination,
							'total_results' => 'Total of '.$total_of.' results (out of '.$total_rows.')'
						),
						'message' => 'Contacts fetched successfully.'
					)
				);
			}else{
				echo json_encode(
					array(
						'status' => true,
						'data' => array(
							'contacts' => '',
							'pagination' => '',
							'total_results' => ''
						),
						'message' => 'Error fetching contacts.'
					)
				);
			}
		}else{
			echo json_encode(
				array(
					'status' => false,
					'data' => array(
						'contacts' => '',
						'pagination' => '',
						'total_results' => ''
					),
					'message' => 'A problem occured. Please try again.'
				)
			);
        }
	}

	public function search_fetch_contacts(){
		$data = '';
		if($this->session->userdata('id')){
			$limit 	  = ($this->input->post('limit')) ? $this->input->post('limit') : 1;
			$offset   = ($this->input->post('page')) ? $this->input->post('page')-1 : 0;
			$keyword  = ($this->input->post('keyword')) ? $this->input->post('keyword') : '';
			$contacts = $this->contacts_model->get_all_contacts_search($limit, $offset, $keyword);
			if($contacts){
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
						'data2' => $contacts,
						'message' => 'Contacts fetched successfully.'
					)
				);
			}else{
				echo json_encode(
					array(
						'status' => true,
						'data' => '
							<tr class="loader-full">
								<td colspan="6">
									<div class="loading-table">
										<i class="fa-regular fa-folder-open"></i>
										<span>No contacts found.</span>
									</div>
								</td>
							</tr>
						',
						'data2' => $contacts,
						'message' => 'No contacts found.'
					)
				);
			}
		}else{
			echo json_encode(
				array(
					'status' => false,
					'data' => '
						<tr class="loader-full">
							<td colspan="6">
								<div class="loading-table">
									<i class="fa-regular fa-folder-open"></i>
									<span>No contacts found.</span>
								</div>
							</td>
						</tr>
					',
					'message' => 'A problem occured. Please try again.'
				)
			);
        }
	}
}	