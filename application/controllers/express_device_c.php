<?php 

Class express_device_c extends CI_Controller{

	public function __construct()
	    {
	        parent::__construct();
	        $this->load->model('express_device_m');
	    }

		public function index()
		{
				if(isset($_SESSION['id'])){
					$this->view_beds();
				}else{
					$this->load->view('login');
				}
		}

		public function view_device(){

			if(isset($_SESSION['id'])){
				$data['device'] = $this->express_device_m->view_device();
				$data['patient'] = $this->express_device_m->view_patient();
				$this->load->view('devices',$data);
			}else{
				$this->load->view('login');
			}

		}

		public function view_add_device(){

			if(isset($_SESSION['id'])){	
				$this->load->view('view_add_device');
			}else{
				$this->load->view('login');
			}

		}

		public function add_device(){

			if(isset($_SESSION['id'])){	
				$data = array(

				'name' => $this->input->post('name'),
				'mac' => $this->input->post('mac')

				);

				$this->express_device_m->add_device($data);
				redirect('express_device_c/view_device');
			}else{
				$this->load->view('login');
			}

		}

		public function delete_device($id){


			if(isset($_SESSION['id'])){	
				$this->express_device_m->delete_device($id);
				redirect('express_device_c/view_device');
			}else{
				$this->load->view('login');
			}


		}

		public function update_device($id){

			if(isset($_SESSION['id'])){	
				$name = $this->input->post('name');
				$mac = $this->input->post('mac');
				$this->express_device_m->update_device($name,$id,$mac);
				redirect('express_device_c/view_device');
			}else{
				$this->load->view('login');
			}


		}

		public function update_device_view($id){

			if(isset($_SESSION['id'])){	
				$data['update'] = $this->express_device_m->update_device_view($id);
				$this->load->view('update_device',$data);
			}else{
				$this->load->view('login');
			}

		}


}

?>