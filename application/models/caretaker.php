<?php 
class Caretaker extends CI_Model{
	
	public function add($data){
		$this->db->insert('staff_t',$data);
	}
	
	public function del_ac($id){
		$this->db->set('deleted', '1');
		$this->db->where('id', $id);
		$this->db->update('staff_t');
	}

	public function act_ac($id){
		$this->db->set('deleted', '0');
		$this->db->where('id', $id);
		$this->db->update('staff_t');
	}

	public function view_profile($id){
		$this->db->select('*');
		$this->db->where('id', $id);
		$this->db->where('staff_type','caretaker');
		$query = $this->db->get('staff_t');
		return $query->result();
	}

	public function view_transaction($id,$from,$to){
		if($from == null && $to == null){
			$this->db->select('*');
			$this->db->from('transaction');
			$this->db->where('staff_id',$id);
			$this->db->join('patient','transaction.patient_id = patient.patient_id');
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
			$this->db->where('staff_id',$id);
			$this->db->where('transaction.date BETWEEN "'. date('Y-m-d', strtotime($from)). '" and "'. date('Y-m-d', strtotime($to)).'"');
			$this->db->join('patient','transaction.patient_id = patient.patient_id');
			$query = $this->db->get();
			return $query->result();

			$this->count_massage($from,$to,$id);
			$this->count_clothes($from,$to,$id);
			$this->count_water($from,$to,$id);
			$this->count_cr($from,$to,$id);
			$this->count_emergency($from,$to,$id);

		}
	}


	public function caretaker_name($id){

		$this->db->select('*');
		$this->db->from('staff_t');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result();

	}

	public function edit_accc($id){

		$this->db->select('*');
		$this->db->where('id',$id);
		$this->db->from('staff_t');
		$query= $this->db->get();
		return $query->result();

	}

	public function count_massage($from,$to,$id){

		if($from!=null && $to!=null){

			$this->db->like('need','massage');
			$this->db->from('transaction');
			$this->db->where('staff_id',$id);
			$this->db->where('transaction.date BETWEEN "'. date('Y-m-d', strtotime($from)). '" and "'. date('Y-m-d', strtotime($to)).'"');
			return $this->db->count_all_results();

		} else {

			$this->db->like('need','massage');
			$this->db->from('transaction');
			$this->db->where('staff_id',$id);
			return $this->db->count_all_results();

		}

	}

	public function count_clothes($from,$to,$id){

		if($from!=null && $to!=null){

			$this->db->like('need','clothes');
			$this->db->from('transaction');
			$this->db->where('staff_id',$id);
			$this->db->where('transaction.date BETWEEN "'. date('Y-m-d', strtotime($from)). '" and "'. date('Y-m-d', strtotime($to)).'"');
			return $this->db->count_all_results();

		} else {

			$this->db->like('need','clothes');
			$this->db->from('transaction');
			$this->db->where('staff_id',$id);
			return $this->db->count_all_results();

		}

	}

	public function count_water($from,$to,$id){

		if($from!=null && $to!=null){

			$this->db->like('need','water');
			$this->db->from('transaction');
			$this->db->where('staff_id',$id);
			$this->db->where('transaction.date BETWEEN "'. date('Y-m-d', strtotime($from)). '" and "'. date('Y-m-d', strtotime($to)).'"');
			return $this->db->count_all_results();

		} else {

			$this->db->like('need','water');
			$this->db->from('transaction');
			$this->db->where('staff_id',$id);
			return $this->db->count_all_results();

		}

	}

	public function count_cr($from,$to,$id){

		if($from!=null && $to!=null){

			$this->db->like('need','cr');
			$this->db->from('transaction');
			$this->db->where('staff_id',$id);
			$this->db->where('transaction.date BETWEEN "'. date('Y-m-d', strtotime($from)). '" and "'. date('Y-m-d', strtotime($to)).'"');
			return $this->db->count_all_results();

		} else {

			$this->db->like('need','cr');
			$this->db->from('transaction');
			$this->db->where('staff_id',$id);
			return $this->db->count_all_results();

		}

	}

	public function count_emergency($from,$to,$id){

		if($from!=null && $to!=null){

			$this->db->like('need','emergency');
			$this->db->from('transaction');
			$this->db->where('staff_id',$id);
			$this->db->where('transaction.date BETWEEN "'. date('Y-m-d', strtotime($from)). '" and "'. date('Y-m-d', strtotime($to)).'"');
			return $this->db->count_all_results();

		} else {

			$this->db->like('need','emergency');
			$this->db->from('transaction');
			$this->db->where('staff_id',$id);
			return $this->db->count_all_results();

		}

	}

	

	
}
?>