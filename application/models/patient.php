<?php 

class Patient extends CI_Model{
	
	public function view_profile($id){
		$this->db->select('*');
		$this->db->from('patient');
		$this->db->where('patient_id',$id);
		$query = $this->db->get();
		return $query->result();
	}
	public function view_transaction($id,$from,$to){
		if($from == null && $to == null){
			$this->db->select('*');
			$this->db->from('transaction');
			$this->db->where('patient_id',$id);
			$this->db->join('staff_t','transaction.staff_id = staff_t.id');
			$this->db->order_by('date, time','ASC');
			$query = $this->db->get();
			return $query->result();

			$this->count_massage($from,$to,$id);
			$this->count_clothes($from,$to,$id);
			$this->count_water($from,$to,$id);
			$this->count_cr($from,$to,$id);
			$this->count_emergency($from,$to,$id);

			
		}else{
		
        	$this->db->select('*');
			$this->db->from('transaction');
			$this->db->where('patient_id',$id);
			$this->db->join('staff_t','transaction.staff_id = staff_t.id');
			$this->db->where('transaction.date BETWEEN "'. date('Y-m-d', strtotime($from)). '" and "'. date('Y-m-d', strtotime($to)).'"');
			$this->db->order_by('date, time','ASC');
			$query = $this->db->get();
			return $query->result();

			$this->count_massage($from,$to,$id);
			$this->count_clothes($from,$to,$id);
			$this->count_water($from,$to,$id);
			$this->count_cr($from,$to,$id);
			$this->count_emergency($from,$to,$id);
			
		}

		
	}


	public function count_massage($from,$to,$id){

		if($from!=null && $to!=null){

			$this->db->like('need','massage');
			$this->db->from('transaction');
			$this->db->where('patient_id',$id);
			$this->db->where('transaction.date BETWEEN "'. date('Y-m-d', strtotime($from)). '" and "'. date('Y-m-d', strtotime($to)).'"');
			return $this->db->count_all_results();

		} else {

			$this->db->like('need','massage');
			$this->db->from('transaction');
			$this->db->where('patient_id',$id);
			return $this->db->count_all_results();

		}

	}

	public function count_clothes($from,$to,$id){

		if($from!=null && $to!=null){

			$this->db->like('need','clothes');
			$this->db->from('transaction');
			$this->db->where('patient_id',$id);
			$this->db->where('transaction.date BETWEEN "'. date('Y-m-d', strtotime($from)). '" and "'. date('Y-m-d', strtotime($to)).'"');
			return $this->db->count_all_results();

		} else {

			$this->db->like('need','clothes');
			$this->db->from('transaction');
			$this->db->where('patient_id',$id);
			return $this->db->count_all_results();

		}

	}

	public function count_water($from,$to,$id){

		if($from!=null && $to!=null){

			$this->db->like('need','water');
			$this->db->from('transaction');
			$this->db->where('patient_id',$id);
			$this->db->where('transaction.date BETWEEN "'. date('Y-m-d', strtotime($from)). '" and "'. date('Y-m-d', strtotime($to)).'"');
			return $this->db->count_all_results();

		} else {

			$this->db->like('need','water');
			$this->db->from('transaction');
			$this->db->where('patient_id',$id);
			return $this->db->count_all_results();

		}

	}

	public function count_cr($from,$to,$id){

		if($from!=null && $to!=null){

			$this->db->like('need','cr');
			$this->db->from('transaction');
			$this->db->where('patient_id',$id);
			$this->db->where('transaction.date BETWEEN "'. date('Y-m-d', strtotime($from)). '" and "'. date('Y-m-d', strtotime($to)).'"');
			return $this->db->count_all_results();

		} else {

			$this->db->like('need','cr');
			$this->db->from('transaction');
			$this->db->where('patient_id',$id);
			return $this->db->count_all_results();

		}

	}

	public function count_emergency($from,$to,$id){

		if($from!=null && $to!=null){

			$this->db->like('need','emergency');
			$this->db->from('transaction');
			$this->db->where('patient_id',$id);
			$this->db->where('transaction.date BETWEEN "'. date('Y-m-d', strtotime($from)). '" and "'. date('Y-m-d', strtotime($to)).'"');
			return $this->db->count_all_results();

		} else {

			$this->db->like('need','emergency');
			$this->db->from('transaction');
			$this->db->where('patient_id',$id);
			return $this->db->count_all_results();

		}

	}

	public function patient_name($id){

		$this->db->select('*');
		$this->db->from('patient');
		$this->db->where('patient_id',$id);
		$query = $this->db->get();
		return $query->result();

	}

	public function device1($id,$bed_r,$device){
		$this->db->select('*');
		$this->db->from('patient');
		$this->db->where('patient_id',$id);
		$this->db->where('bed_room.id',$bed_r);
		$this->db->where('device.device_id',$device);
		$this->db->join('device','patient.device_id = device.device_id');
		$this->db->join('bed_room','patient.bed_room_id = bed_room.id');
		$query = $this->db->get();
		return $query->result();
	}

	public function all_device(){
		$this->db->select('*');
		$this->db->from('device');
		$query = $this->db->get();
		return $query->result();
	}

	public function all_room(){
		$this->db->select('*');
		$this->db->from('bed_room');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_all(){
		$this->db->select('*');
		$this->db->from('patient');
		$this->db->where('deleted',0);
		$query = $this->db->get();
		return $query->result();
	}
	
	public function add(){
		$this->load->model('patient');
		$data = array(
			'fname' => $this->input->post('fname')	
		);
	}

	public function adding($data){
		$this->db->insert('patient',$data);
	}
	


	public function get_used_device(){
		$this->db->select('device_id');
		$this->db->from('patient');
		$this->db->where('deleted',0);
		$query = $this->db->get();
		return $query->result();
	}

	public function get_room($room,$bed){
		$this->db->select('id');
		$this->db->where('room_no', $room);
		$this->db->where('bed_no', $bed);
		$this->db->from('bed_room');
		$query = $this->db->get();
		return $query->result();
	}
	
	//checks room if bed is already use
	public function room(){

		$this->db->select('bed_room.*');
		$this->db->select('patient.patient_id');
		$this->db->from('bed_room');
		$this->db->where('bed_room.deleted',0);
		$this->db->where('patient.deleted',0);
		$this->db->where('parent_no !=',0);
		$this->db->join('patient', 'bed_room.id = patient.bed_room_id');
		$query = $this->db->get();
		return $query->result();
	}

	public function room2(){
		$q = $this->room();
		$count=0;
		$data[]=null;
		foreach ($q as $key) {
			$data[$count] = $key->id;
			$count+=1;
		}
		$en =  null;
		for($a=0;$a<$count;$a++){
			$en.=$data[$a];
		}
		$this->db->select('bed_no');
		$this->db->select('room_no');
		$this->db->select('id');
		$this->db->from('bed_room');
		$this->db->where('deleted',0);
		$this->db->where('parent_no !=',0);
		$this->db->where_not_in('id',$data);

		$q = $this->db->get();
		return $q->result();

	}

	public function get_device(){ // get the used devices
		
		$this->db->select('device.name');
		$this->db->select('device.device_id');
		$this->db->select('device.mac');
		$this->db->select('patient.patient_id');
		$this->db->select('patient.deleted');
		$this->db->from('device');
		$this->db->where('device.deleted',0);
		$this->db->where('patient.deleted',0);
		$this->db->join('patient','device.device_id=patient.device_id');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_device2(){ //get all not used devices
		$d = $this->get_device();
		$count=0;
		$data[]=null;
	
		foreach ($d as $key) {
			$data[$count] = $key->device_id;
			$count+=1;
		}

		$en = null;
		for($a=0;$a<$count;$a++){
			$en .=$data[$a]; 
		}
		// $data = array($data[0],$data[1],$data[2],$data[3],$data[4],$data[5],$data[6],$data[7],$data[8],$data[10],
		// 			$data[11],$data[12],$data[13],$data[14],$data[15],$data[16],$data[17],$data[18],$data[19],$data[20]);
		$this->db->select('device.name');
		$this->db->select('device.device_id');
		$this->db->select('device.mac');
		$this->db->from('device');
		$this->db->where('device.deleted',0);
		$this->db->where_not_in('device_id',$data);
		$q = $this->db->get();
		return $q->result();
	}

	public function get_all_device(){
		// this should just get all the device
		$this->db->select('device.*');
		$this->db->from('device');
		$this->db->where('deleted',0);
		$query = $this->db->get();
		return $query->result();

	}

	public function del_pa($id){
		$this->db->set('deleted', '1');
		$this->db->where('patient_id', $id);
		$this->db->update('patient');
	}

	public function edit_fname($data){

        $a = $_SESSION['fname'];
        $this->db->where('UserName',$a);
        $this->db->update('patient',$data);
        echo $a;
    }

    public function update_patient($data,$pid){
    	$this->db->where('patient_id',$pid);
        $this->db->update('patient',$data);
    }
	
}

?>