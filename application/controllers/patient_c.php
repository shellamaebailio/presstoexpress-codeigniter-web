<?php 
	class Patient_c extends CI_Controller{
		
		public function view_all()
		{
			if(isset($_SESSION['id'])){
				$this->load->model('patient');
				$data['pat'] = $this->patient->get_all();
				$this->load->view('all_patient',$data);

			}else{
				$this->load->view('login');
			}
		}
		
		public function profile()
		{
			if(isset($_SESSION['id'])){
				$this->load->view('profile');
			}else{
				$this->load->view('login');
			}
		}

		public function profileses($id) //profile of each patient
		{
			$this->load->model('patient');
			if(isset($_SESSION['id'])){
				$from = $this->input->post('from');
				$to = $this->input->post('to');

				
				if($from != null && $to != null){
				$data = $this->patient->view_profile($id);
						foreach($data as $i){
                            $bb = $i->birthdate;
                            list($y,$m,$d) = explode('-', $bb);
                            $age = date('Y')-$y;
							$data['id'] = $i->patient_id;
							$data['fname'] = $i->fname;
							$data['mname'] = $i->mname;
							$data['lname'] = $i->lname;
							$data['gender'] = $i->gender;
							$data['age'] = $age;
							$data['address'] = $i->address;
							$data['device_id'] = $i->device_id;
							$data['bed_room_id'] = $i->bed_room_id;
                            $data['bday'] = $i->birthdate;
						}
						$bed_r = $i->bed_room_id;
						$device = $i->device_id;
						$data['tran'] = $this->patient->view_transaction($id,$from,$to);
						$data['massage'] = $this->patient->count_massage($from,$to,$id);
						$data['clothes'] = $this->patient->count_clothes($from,$to,$id);
						$data['water'] = $this->patient->count_water($from,$to,$id);
						$data['cr'] = $this->patient->count_cr($from,$to,$id);
						$data['emergency'] = $this->patient->count_emergency($from,$to,$id);
						$data['dev_bed'] = $this->patient->device1($id,$bed_r,$device);
						$data['device'] = $this->patient->get_device2();
						$data['room'] = $this->patient->room2();
						$data['from'] = $from;
						$data['to'] =$to;
                        $data['bday'] = $i->birthdate;
						$this->session->set_flashdata('from', $from);
						$this->session->set_flashdata('to', $to);
						$this->load->view('profile',$data);

					
				}else{
					$data = $this->patient->view_profile($id);
						foreach($data as $i){
                            $bb = $i->birthdate;
                            list($y,$m,$d) = explode('-', $bb);
                            $age = date('Y')-$y;
							$data['id'] = $i->patient_id;
							$data['fname'] = $i->fname;
							$data['mname'] = $i->mname;
							$data['lname'] = $i->lname;
							$data['gender'] = $i->gender;
							$data['age'] = $age;
                            $data['bday'] = $i->birthdate;
							$data['address'] = $i->address;
							$data['device_id'] = $i->device_id;
							$data['bed_room_id'] = $i->bed_room_id;
						}
						$bed_r = $i->bed_room_id;
						$device = $i->device_id;
						$data['tran'] = $this->patient->view_transaction($id,$from,$to);
						$data['dev_bed'] = $this->patient->device1($id,$bed_r,$device);
						$data['device'] = $this->patient->get_device2();
						$data['all_device'] = $this->patient->get_all_device();
						$data['massage'] = $this->patient->count_massage($from,$to,$id);
						$data['clothes'] = $this->patient->count_clothes($from,$to,$id);
						$data['water'] = $this->patient->count_water($from,$to,$id);
						$data['cr'] = $this->patient->count_cr($from,$to,$id);
						$data['emergency'] = $this->patient->count_emergency($from,$to,$id);
						$data['room'] = $this->patient->room2();
						// foreach ($data['device'] as $key) {
						// 	echo $key->name."<br>";
						// }
						// foreach ($data['room'] as $key) {
						// 	echo $key->room_no." ".$key->bed_no."<br>";
						// }
						// exit;
						$data['from'] = $from;
						$data['to'] =$to;
						$this->session->set_flashdata('from', $from);
						$this->session->set_flashdata('to', $to);
						$this->load->view('profile',$data);
				}
			

					}else{
						$this->load->view('login');
					}
		}
		
		public function add_patient_v(){
			$this->load->model('patient');
			$data['device'] = $this->patient->get_device();
			$this->load->view('add_patient',$data);
		}

		public function add_patient_vvv(){
			$this->load->model('patient');
			$data['device'] = $this->patient->get_device2();
			$data['room'] = $this->patient->room2();
			$this->load->view('add_patient',$data);
		}
		
		public function add_patient(){
			$this->load->model('patient');
			$data = array(
				'fname' => $this->input->post('fname'),
				'mname' => $this->input->post('mname'),
				'lname' => $this->input->post('lname'),
				'gender' => $this->input->post('gender'),
				'birthdate' => $this->input->post('bday'),
				'address' => $this->input->post('address')
			);
			$this->patient->add($data);
			redirect('patient_c/view_all');
		}

		public function add_patientses(){ // adding patient
			$this->load->model('patient');
			
			$data = array(
				'fname' => $this->input->post('fname'),
				'mname' => $this->input->post('mname'),
				'lname' => $this->input->post('lname'),
				'gender' => $this->input->post('gender'),
				'birthdate' => $this->input->post('bday'),
				'address' => $this->input->post('address'),
				'device_id' => $this->input->post('device_id'),
				'bed_room_id' => $this->input->post('room_no')
			);

			$this->patient->adding($data);
			redirect('patient_c/view_all');

		}

		public function del_patient($id){
		$this->load->model('patient');
		$this->patient->del_pa($id);
		//$this->patient->del_pa_occupied($id);
		redirect('patient_c/view_all');
		}

		public function edit_patient(){
        $this->load->view('profile');
    	}

    	public function up_patient($pid){
    		$this->load->model('patient');

  
    		$data = array(
				'fname' => $this->input->post('fname'),
				'mname' => $this->input->post('mname'),
				'lname' => $this->input->post('lname'),
				'gender' => $this->input->post('gender'),
				'birthdate' => $this->input->post('bday'),
				'address' => $this->input->post('address'),
				'device_id' => $this->input->post('device_id'),
				'bed_room_id' => $this->input->post('room_no')

			);

			
			$this->patient->update_patient($data,$pid);
			redirect('patient_c/view_all');

        }
		
	}

?>