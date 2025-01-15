<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	function __construct(){
        parent::__construct();
	}
	
	public function index(){
		if($this->session->userdata('id')){
			redirect('/dashboard');
		}else{
            $data['is_page'] = 'login';
			$this->load->view('Auth/login', $data);
        }
	}

	public function login(){
		if($this->session->userdata('id')){
			redirect('/dashboard');
		}else{
            $data['is_page'] = 'login';
			$this->load->view('Auth/login', $data);
        }
	}

	public function register(){
		if($this->session->userdata('id')){
			redirect('/dashboard');
		}else{
            $data['is_page'] = 'register';
		$this->load->view('Auth/register', $data);
        }
	}

	public function login_user_ajax(){
        if($this->input->post()){
			$email 	  = $this->input->post('email');
			$password = $this->input->post('password');
			if($email && $password){
				$data = $this->auth_model->check_user_if_exist($email, $password);
				if($data){
					$this->session->set_userdata($data);
					echo json_encode(
						array(
							'status' => true,
							'data' => [],
							'message' => 'Logged in successfully.'
						)
					);
				} else{
					echo json_encode(
						array(
							'status' => false,
							'data' => [],
							'message' => 'Incorrect email or password.'
						)
					);
				}
			}else{
				echo json_encode(
					array(
						'status' => false,
						'data' => [],
						'message' => 'All fields are required.'
					)
				);
			}
		}else{
			echo json_encode(
				array(
					'status' => false,
					'data' => [],
					'message' => 'Incorrect email or password.'
				)
			);
		}
	}

	public function register_user_ajax(){
        if($this->input->post()){
			$fname 			= $this->input->post('first_name');
			$lname 			= $this->input->post('last_name');
			$email 			= $this->input->post('email');
			$password 		= $this->input->post('password');
			$conf_password 	= $this->input->post('confirm_password');

			if($fname && $lname && $email && $password && $conf_password){
				$email 	  		= $this->input->post('email');
				$password 		= md5($this->input->post('password'));
				$is_registered 	= $this->auth_model->register_this_user();
				if($is_registered){
					echo json_encode(
						array(
							'status' => true,
							'data' => [],
							'message' => 'Registered successfully.'
						)
					);
				}else{
					echo json_encode(
						array(
							'status' => false,
							'data' => [],
							'message' => 'Email already exist. Please try another email.'
						)
					);
				}
			}else{
				echo json_encode(
					array(
						'status' => false,
						'data' => [],
						'message' => 'All fields are required.'
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

    public function user_logout(){
        $this->session->sess_destroy();
		redirect(base_url());
    }

}