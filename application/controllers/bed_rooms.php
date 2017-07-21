<?php 
class Bed_rooms extends CI_Controller{

		public function __construct()
	    {
	        parent::__construct();
	        $this->load->model('bed_rooms_m');
	        $this->load->model('patient');
	    }

		public function index()
		{
				if(isset($_SESSION['id'])){
					$this->view_beds();
				}else{
					$this->load->view('login');
				}
		}
		
	
		public function view_beds(){

			$data['bed_room'] = $this->bed_rooms_m->check_bed();
			$data['patient'] = $this->bed_rooms_m->check_patient();
			$this->load->view('bed_room',$data);

		}

		public function view_add_beds(){

			$data['room'] = $this->bed_rooms_m->get_room();
			$this->load->view('add_beds',$data);

		}

		public function view_add_rooms(){

			$this->load->view('add_room');

		}

		public function add_beds(){

			$room = $this->input->post('room');
			$bed= $this->input->post('bed');
			$data['one'] = $this->bed_rooms_m->check_room_bed($room,$bed);

			if($data['one'] == 1){

					echo "<center><div> Already Existed </div></center>";

			} else {
			$data = array(

					'room_no' => $this->input->post('room'),
					'bed_no' => $this->input->post('bed'),
					'parent_no' => $this->input->post('room')

					);

			$this->bed_rooms_m->add_rooms_bed($data);

			}

			$data['bed_room'] = $this->bed_rooms_m->check_bed();
			$data['patient'] = $this->patient->get_all();
			$this->load->view('bed_room',$data);
			
		}

		public function add_rooms(){


			$room = $this->input->post('room');		
			$data['one'] = $this->bed_rooms_m->check_room($room);

			if($data['one'] == 1){

				echo "<center><div> Already Existed </div></center>";

			} else {
				$room = array(

					'room_no' => $this->input->post('room'),
					'bed_no' => 0,
					'parent_no' => 0 

					);
				$this->bed_rooms_m->add_rooms($room);

			}

			$data['bed_room'] = $this->bed_rooms_m->check_bed();
			$data['patient'] = $this->patient->get_all();
			$this->load->view('bed_room',$data);
			
		}


	public function del_bed($id){
		//check if room
		$rn = $this->bed_rooms_m->get_room_no($id);
		foreach ($rn as $key) {
			$rn = $key->room_no;
		}
		$room = $this->bed_rooms_m->bed_or_room($id);
		$not_delete = null;

		//if room
		if($room){
			$data = $this->bed_rooms_m->check_bed_del($rn);
			foreach ($data as $key) {
				if($key->patient_id!=null){
					$not_delete = 1;
				}
			}
			if($not_delete==null){
				$this->bed_rooms_m->del_bed_room($rn);
			}

		}else{ // not room
			$d = $this->bed_rooms_m->check_bed_2($id);
			if($d){
			}else{
				$this->bed_rooms_m->del_bed($id);
			}
		}


		redirect('bed_rooms/view_beds');

	}

	
}
?>