<?php
 
class Account extends CI_Model{
	
	public function get_admin(){
		$this->db->select('*');
		$this->db->from('staff_t');
		$this->db->where('staff_type','admin');
		$this->db->where('deleted',0);
		$this->db->where('id!=',$_SESSION['id']);
		
		$query = $this->db->get();
		return $query->result();
	}
	public function get_accept_request_avg(){
		$this->db->select('time');
		$this->db->select('time_attended');
		$this->db->select('time_finished');
		$this->db->select('staff_id');
		$this->db->from('transaction');

		$q = $this->db->get();
		return $q->result();
	}
	
	public function get_caretakers()
	{
		$this->db->select('*');
		$this->db->from('staff_t');
		$this->db->where('staff_type','caretaker');
		
		$query = $this->db->get();
		return $query->result();
	}	
	
	public function edit_bio($username,$fname,$mname,$lname,$gender,$contact_no,$email)
	{
		$this->db->set('username', $username);
		$this->db->set('fname', $fname);
		$this->db->set('mname', $mname);
		$this->db->set('lname', $lname);
		$this->db->set('gender', $gender);
		$this->db->set('contact_no', $contact_no);
		$this->db->set('email', $email);
		$this->db->where('id', $_SESSION['id']);
		$this->db->update('staff_t');
	}
	
	public function edit_pass($p){
		$this->db->set('password', $p);
		$this->db->where('id', $_SESSION['id']);
		$this->db->update('staff_t');
	}
}

?>