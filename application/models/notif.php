<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class notif extends CI_Model{

	public function get_time(){

		$this->db->select('time');
		$this->db->where('attended',0);
		$this->db->where('date',date('Y-m-d'));
		$this->db->where('staff_id',0);
		$this->db->from('transaction');
		$query = $this->db->get();
	
		if($query->num_rows()>0){
            return 1;
        } else  {
            return 0;   
        }


	}

}

?>