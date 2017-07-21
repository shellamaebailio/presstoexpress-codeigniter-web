<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
			if(isset($_SESSION['id'])){
				$this->home();
			}else{
				$this->load->view('login');
			}
	}
	
	
    public function submit()
    {	
		$Username = $this->input->post('username');
        $this->form_validation->set_rules('username', 'Username', 'trim|callback_check_username');
        $this->form_validation->set_rules('password', 'Password','required');
		
        if ($this->form_validation->run() == FALSE)
        {
			$a = 0;
            $this->index();
        }
        else
        {
            $this->home();
        }
    }

    public function check_username($username){
		
		$password = md5($this->input->post('password'));
		
        $this->load->model('login_m');
        $check = $this->login_m->check_user($username,$password);
        if($check==null){
            $this->form_validation->set_message('check_username', 'Incorrect PASSWORD or USERNAME');
			return false;
        }else{
			foreach($check as $user)
			{

				$this->session->set_userdata('username', $user->username);
				$this->session->set_userdata('password', $user->password);
				$this->session->set_userdata('fname', $user->fname);
				$this->session->set_userdata('mname', $user->mname);
				$this->session->set_userdata('lname', $user->lname);
				$this->session->set_userdata('id', $user->id);
				$this->session->set_userdata('email', $user->email);
				$this->session->set_userdata('gender', $user->gender);
				$this->session->set_userdata('contact_no', $user->contact_no);
				
				
			}
			return true;
		}
    }

    public function home()
    {
		if(isset($_SESSION['id'])){
			$this->load->model('account');
			$data['admin'] = $this->account->get_admin();
			
			$this->load->view('home',$data);
		}else{
			$a = 1;
			$this->index();
		}
		
    }
	
	public function logout()
	{
		session_destroy();
		$this->session->set_userdata('id', null);
		$this->load->view('login');
	}
	
	public function my_profile()
	{
		$data['tab'] ="";
		if(isset($_SESSION['id'])){
			$this->load->view('my_profile',$data);
		}else{
			$this->load->view('login');
		}
	}

}
