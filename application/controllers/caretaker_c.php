<?php 
class Caretaker_c extends CI_Controller{
		
		public function add_view(){
			
			$this->load->view('add_caretaker');
		}
		
		
		
		public function add_caretaker(){
			
			$this->form_validation->set_rules('fname', 'Firstname','required|min_length[2]');
			$this->form_validation->set_rules('lname', 'Lastname','required|min_length[2]');
			$this->form_validation->set_rules('address', 'Address','min_length[10]');
			
			$data['p'] = $this->GeraHash(10);
			$data['f'] = strtolower($this->input->post('fname'));
			$data['m'] = strtolower($this->input->post('mname'));
			$data['l'] = strtolower($this->input->post('lname'));
			$data['a'] = strtolower($this->input->post('address'));
			$data['g'] = strtolower($this->input->post('gender'));
			$data['e'] = strtolower($this->input->post('email'));
			$data['c'] = strtolower($this->input->post('contact#'));
			$data['s'] = "caretaker";
			$data['u'] = str_replace(' ','',strtolower($this->input->post('lname')).strtolower($this->input->post('fname')));
			
			if($this->form_validation->run() == false){
				$this->add_view();
				}else{
				$this->load->view('new_pass_user_caretaker',$data);
			}
		}
			
			
			
		function GeraHash($qtd){ 
		$Caracteres = 'abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMPQRSTUVXWYZ123456789'; 
		$QuantidadeCaracteres = strlen($Caracteres); 
		$QuantidadeCaracteres--; 

		$Hash=NULL; 
			for($x=1;$x<=$qtd;$x++){ 
				$Posicao = rand(0,$QuantidadeCaracteres); 
				$Hash .= substr($Caracteres,$Posicao,1); 
			} 
			
		return $Hash; 
		} 	
		
		function submit_add(){
			$data = array(
				'fname' => strtolower($this->input->post('f')),
				'mname' => strtolower($this->input->post('m')),
				'lname' => strtolower($this->input->post('l')),
				'address' => strtolower($this->input->post('a')),
				'gender' => strtolower($this->input->post('g')),
				'email' => strtolower($this->input->post('e')),
				'contact_no' => strtolower( $this->input->post('c') ),
				'staff_type' => "caretaker",
				'username' => strtolower($this->input->post('u')),
				'password' => md5($this->input->post('p')),
				'deleted' => 0
			);
			
			$this->load->model('caretaker');
			$this->caretaker->add($data);
			redirect('account_c/caretaker');
		
		}
		
	function del_caretaker($id){
		$this->load->model('caretaker');
		$this->caretaker->del_ac($id);
		redirect('account_c/caretaker');
	}

	function act_caretaker($id){
		$this->load->model('caretaker');
		$this->caretaker->act_ac($id);
		redirect('account_c/caretaker');
	}

	public function profile($id)
		{
			$this->load->model('caretaker');
			if(isset($_SESSION['id'])){
				$from = $this->input->post('from');
				$to = $this->input->post('to');
				if($from != null && $to != null){
				$data = $this->caretaker->view_profile($id);
				foreach($data as $i){
					$data['id'] = $i->id;
					$data['fname'] = $i->fname;
					$data['mname'] = $i->mname;
					$data['lname'] = $i->lname;
					$data['gender'] = $i->gender;
					$data['fname'] = $i->fname;
					$data['contact'] = $i->contact_no;
					$data['address'] = $i->address;
					$data['email'] = $i->email;
					$data['username'] = $i->username;
					$data['staff_type'] = $i->staff_type;
				}
				$data['trans'] = $this->caretaker->view_transaction($id,$from,$to);
				$data['massage'] = $this->caretaker->count_massage($from,$to,$id);
				$data['clothes'] = $this->caretaker->count_clothes($from,$to,$id);
				$data['water'] = $this->caretaker->count_water($from,$to,$id);
				$data['cr'] = $this->caretaker->count_cr($from,$to,$id);
				$data['emergency'] = $this->caretaker->count_emergency($from,$to,$id);
				$data['from'] = $from;
				$data['to'] =$to;
				$this->session->set_flashdata('from', $from);
				$this->session->set_flashdata('to', $to);
				$this->load->view('caretaker_profile',$data);

			}else{
				$data = $this->caretaker->view_profile($id);
				foreach($data as $i){
					$data['id'] = $i->id;
					$data['fname'] = $i->fname;
					$data['mname'] = $i->mname;
					$data['lname'] = $i->lname;
					$data['gender'] = $i->gender;
					$data['fname'] = $i->fname;
					$data['contact'] = $i->contact_no;
					$data['address'] = $i->address;
					$data['email'] = $i->email;
					$data['username'] = $i->username;
					$data['staff_type'] = $i->staff_type;
				}
				$data['trans'] = $this->caretaker->view_transaction($id,$from,$to);
				$data['massage'] = $this->caretaker->count_massage($from,$to,$id);
				$data['clothes'] = $this->caretaker->count_clothes($from,$to,$id);
				$data['water'] = $this->caretaker->count_water($from,$to,$id);
				$data['cr'] = $this->caretaker->count_cr($from,$to,$id);
				$data['emergency'] = $this->caretaker->count_emergency($from,$to,$id);
				$data['from'] = $from;
				$data['to'] =$to;
				$this->session->set_flashdata('from', $from);
				$this->session->set_flashdata('to', $to);
				$this->load->view('caretaker_profile',$data);
			}
				}else{
					$this->load->view('login');
				}
		}

		public function edit_accc($id)
			{
				$this->load->model('caretaker');
				$data = $this->caretaker->edit_accc($id);
				 $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));

			}
		
	}
?>