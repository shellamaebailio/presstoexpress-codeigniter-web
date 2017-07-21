<?php
 
class Bed_rooms_m extends CI_Model{

	public function view_bed_room(){

		$this->db->select('*');
		$this->db->from('bed_room');
		$this->db->where('deleted',0);
		$this->db->where('parent_no !=',0);
		$query = $this->db->get();
		return $query->result();

	}

	public function check_room($room){

		$this->db->select('*');
		$this->db->where('room_no',$room);
		$query = $this->db->get('bed_room');

		if($query->num_rows()>0){
			return 1;
		} else  {
			return 0;
		}

	}

	public function check_room_bed($room,$bed){

		$this->db->select('*');
		$this->db->where('room_no',$room);
		$this->db->where('bed_no',$bed);
		$query = $this->db->get('bed_room');

		if($query->num_rows()>0){
			return 1;
		} else  {
			return 0;
		}

	}

	public function add_rooms_bed($data){

		$this->db->insert('bed_room',$data);

	}

	public function add_rooms($data){

		$this->db->insert('bed_room',$data);

	}

	public function del_bed($id){

		$this->db->set('deleted',1);
		$this->db->where('id',$id);
		$this->db->update('bed_room');

	}

	public function del_bed_room($rn){

		$this->db->set('deleted',1);
		$this->db->where('room_no',$rn);
		$this->db->update('bed_room');

	}

	public function info_bed(){

		$this->db->select('patient.*');
		$this->db->select('bed_room.*');
		$this->db->from('bed_room');
		$this->db->join('patient','patient.bed_room_id=bed_room.id');
		$query = $this->db->get();
		return $query->result();

	}

	

	public function check_bed(){

		$this->db->select('*');
		$this->db->from('bed_room');
		$this->db->where('deleted',0);
		$this->db->order_by('bed_room.room_no,bed_room.parent_no,bed_room.bed_no', 'ASC');
		$query = $this->db->get();
		return $query->result();

	}

	public function check_patient(){
		$this->db->select('*');
		$this->db->from('patient');
		$this->db->where('patient.deleted',0);
		$query = $this->db->get();
		return $query->result();
	}

	public function bed_or_room($id){
		$this->db->select('id');
		$this->db->from('bed_room');
		$this->db->where('id',$id);
		$this->db->where('parent_no',0);

		$query = $this->db->get();
		if($query->num_rows()>0){
			return true;
		}else{
			return false;
		}
	}

	public function check_bed_del($id){

		$this->db->select('patient.patient_id');
		$this->db->from('bed_room');
		$this->db->where('bed_room.parent_no',$id);
		$this->db->join('patient', 'bed_room.id = patient.bed_room_id','left');
		$query = $this->db->get();
		return $query->result();

	}

	public function get_room_no($id){
		$this->db->select('room_no');
		$this->db->from('bed_room');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result();
	}

	public function check_bed_2($id){

		$this->db->select('patient_id');
		$this->db->from('patient');
		$this->db->where('bed_room_id',$id);
		$this->db->where('patient.deleted',0);
		$query = $this->db->get();
		if($query->num_rows()>0){
			return true;
		}else{
			return false;
		}
	}

	public function get_room(){
		$this->db->select('*');
		$this->db->where('parent_no',0);
		$this->db->where('bed_no',0);
		$query = $this->db->get('bed_room');
		return $query->result();
	}



}

?>