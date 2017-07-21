<?php 
class Transaction extends CI_Model{

	public function get_all($from,$to){

		if( $from!=null && $to!=null){
			$this->db->select('transaction.*');
			$this->db->select('staff_t.fname AS s_fname');
			$this->db->select('staff_t.mname AS s_mname');
			$this->db->select('staff_t.lname AS s_lname');
			$this->db->select('patient.*');
			$this->db->from('transaction');
			$this->db->join('patient','transaction.patient_id = patient.patient_id');
			$this->db->where('transaction.date BETWEEN "'. date('Y-m-d', strtotime($from)). '" and "'. date('Y-m-d', strtotime($to)).'"');
			$this->db->order_by('date, time','ASC');
			$this->db->join('staff_t','transaction.staff_id = staff_t.id');
			$this->db->order_by('transaction.date,transaction.time','DESC');
			$this->db->distinct();
	        $query = $this->db->get();
	        return $query->result();
	    }else{
			$this->db->select('transaction.*');
			$this->db->select('staff_t.fname AS s_fname');
			$this->db->select('staff_t.mname AS s_mname');
			$this->db->select('staff_t.lname AS s_lname');
			$this->db->select('patient.*');
			$this->db->from('transaction');
			$this->db->join('patient','transaction.patient_id = patient.patient_id');
			$this->db->join('staff_t','transaction.staff_id = staff_t.id');
			$this->db->order_by('transaction.date,transaction.time','DESC');
			$query = $this->db->get();
			return $query->result();
		}
	}

	public function get($from,$to){
			if($from == null && $to == null){
				$this->db->select('transaction.*');
				$this->db->select('staff_t.fname AS s_fname');
				$this->db->select('staff_t.mname AS s_mname');
				$this->db->select('staff_t.lname AS s_lname');
				$this->db->select('patient.*');
				$this->db->from('transaction');
				$this->db->join('patient','transaction.patient_id = patient.patient_id');
				$this->db->join('staff_t','transaction.staff_id = staff_t.id');
				$this->db->order_by('transaction.date,transaction.time','ASC');
				$query = $this->db->get();
				return $query->result();
			}else{
				$this->db->select('transaction.*');
				$this->db->select('staff_t.fname AS s_fname');
				$this->db->select('staff_t.mname AS s_mname');
				$this->db->select('staff_t.lname AS s_lname');
				$this->db->select('patient.*');
				$this->db->from('transaction');
				$this->db->join('patient','transaction.patient_id = patient.patient_id');
				$this->db->where('transaction.date BETWEEN "'. date('Y-m-d', strtotime($from)). '" and "'. date('Y-m-d', strtotime($to)).'"');
				$this->db->order_by('date, time','ASC');
				$this->db->join('staff_t','transaction.staff_id = staff_t.id');
				$this->db->order_by('transaction.date,transaction.time','DESC');
				$this->db->distinct();
		        $query = $this->db->get();
		        return $query->result();
			}
	}
	
}
?>