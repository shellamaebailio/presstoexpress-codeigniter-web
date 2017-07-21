<?php 
class Admin_c extends CI_Controller{
	
	function add_admin(){
		$this->load->view('add_admin');
	}
	
	function add_admin_ac(){
		
		$this->load->model('admin');
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
		$data['s'] = "admin";
		$data['u'] = str_replace(' ','',strtolower($this->input->post('lname')).strtolower($this->input->post('fname')));
		
		if($this->form_validation->run() == false){
			$this->add_admin();
		}else{
		$this->load->view('new_pass_user',$data);
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
				'staff_type' => "admin",
				'username' => strtolower($this->input->post('u')),
				'password' => md5($this->input->post('p')),
				'deleted' => 0
			);
			
			$this->load->model('admin');
			$this->admin->add($data);
			redirect('login/home');
		
	}
	
	function del_admin($id){
		$this->load->model('admin');
		$this->admin->del_ac($id);
		session_destroy();
		$this->session->set_userdata('id', null);
		$this->load->view('login');
	}
	
	
}
