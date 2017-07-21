<?php
class Account_c extends CI_Controller{

		public function tryss(){
			echo 0%2;
		}
		
		public function caretaker(){
			if(isset($_SESSION['id'])){
			$this->load->model('account');
			$data['caretakers'] = $this->account->get_caretakers();
			$data['avg'] = $this->account->get_accept_request_avg();
			// foreach ($data['avg'] as $k) {
			// 	echo $k->staff_id." ".$k->req." ".$k->ta." ".$k->tf." <br>";
			// }
			// exit;
			$this->load->view('caretaker_accounts',$data);
			}else{
				$this->load->view('login');
			}
		}
		
		public function edit_bio()
		{
			if(isset($_SESSION['id'])){
				$fname = $this->input->post('fname');
				$mname = $this->input->post('mname');
				$lname = $this->input->post('lname');
				$username = $this->input->post('username');
				$gender = $this->input->post('gender');
				$email = $this->input->post('email');
				$contact_no = $this->input->post('contact_no');
				$this->load->model('account');
				$this->account->edit_bio($username,$fname,$mname,$lname,$gender,$contact_no,$email);
				redirect('login/logout');
			}else{
				$this->load->view('login');
			}	
		}
		
		public function edit_pass()
		{
			$this->form_validation->set_rules('pass', 'Password', 'required|min_length[5]');
			$this->form_validation->set_rules('pass_c', 'Password Confirmation', 'required|matches[pass]');
			
			if($this->form_validation->run()==false){
				$data['tab'] = "pass";
				$this->load->view('my_profile',$data);
			}else{
				
					$password = md5($this->input->post('pass'));
				
				$this->load->model('account');
				$this->account->edit_pass($password);
				redirect('login/logout');
			}
			
		}
		
	}

?>