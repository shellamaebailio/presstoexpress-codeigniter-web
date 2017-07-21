<?php
/**
 * Created by PhpStorm.
 * User: Shellamae
 * Date: 12/21/2016
 * Time: 9:27 PM
 */
class Login_m extends CI_model{

    public function check_user($u,$p){
        $this->db->select('*');
        $this->db->from('staff_t');
        $this->db->where('username',$u);
        $this->db->where('password',$p);
        $this->db->where('staff_type','admin');
        $this->db->where('deleted',0);
        $query = $this->db->get();
		
        return $query->result();

    }


}
?>