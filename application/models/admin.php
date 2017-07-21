<?php
class Admin extends CI_Model{
	
	public function add($data){
		$this->db->insert('staff_t',$data);
	}
	public function get_pass($u){
		$this->db->select('password');
		$this->db->from('staff_t');
		$this->db->where('staff_type',"admin");
		$this->db->where('username',$u);
		
		$q = $this->db->get();
		return $q->result();
	}
	public function del_ac($id){
		$this->db->set('deleted', '1');
		$this->db->where('id', $id);
		$this->db->update('staff_t');
	}
	
}

 
?>