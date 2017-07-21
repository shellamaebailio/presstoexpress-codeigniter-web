<?php

Class express_device_m extends CI_Model{

	public function view_device(){
		$this->db->select('*');
		$this->db->from('device');
		$this->db->where('deleted',0);
		$q=$this->db->get();
		return $q->result();
	}

	public function view_patient(){
		$this->db->select('*');
		$this->db->from('patient');
		$this->db->where('deleted',0);
		$q=$this->db->get();
		return $q->result();
	}


	public function add_device($data){

		$this->db->insert('device',$data);

	}

	public function delete_device($id){

		if($this->check_used_device($id)){
			
		}else{
			$this->db->set('deleted',1);
			$this->db->where('device_id',$id);
			$this->db->update('device');
		}
	}

	public function check_used_device($device_id)
	{

		$this->db->select('*');
		$this->db->from('patient');
		$this->db->where('device_id',$device_id);

		$query = $this->db->get();

		if($query->num_rows()>0){
			return 1;
		} else  {
			return 0;
		}
	}
	

	public function update_device($name,$id,$mac){

		$this->db->set('name',$name);
		$this->db->set('mac',$mac);
		$this->db->where('device_id',$id);
		$this->db->update('device');

	}

	public function update_device_view($id){

		$this->db->select('*');
		$this->db->where('device_id',$id);
		$query = $this->db->get('device');
		return $query->result();

	}

}

?>