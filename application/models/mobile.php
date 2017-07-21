<?php 
class Mobile extends CI_Model{

    public function online($caretaker_id){
        date_default_timezone_set('asia/singapore');
        $this->db->set('last_logged_in_date',date('y/m/d'));
        $this->db->set('last_logged_in',date('His'));
        $this->db->where('id',$caretaker_id);
        $this->db->update('staff_t');
    }


	public function login($user,$pass){

        $this->db->select('*');
        $this->db->where('username',$user);
        $this->db->where('password',$pass);
        $this->db->where('staff_type',"caretaker");
        $this->db->where('deleted',0);
        $this->db->from('staff_t');
        $query = $this->db->get();
        return $query->result();
	}	

	public function get_request($type)
    {

        $date = $this->get_date($type);
        foreach($date as $d){
            $da = $d->date;

        }

        $a = $this->get_min_time($type);
        foreach($a as $t){
            $a = $t->time;
        }

        date_default_timezone_set('asia/singapore');
        $time = date('His');
        $date_now= date('Y-m-d');
        $get = $time-$a;

        if($get>= 030000 ||  $da != $date_now){
            $this->db->set('attended',2);
            $this->db->where('need',$type);
            $this->db->where('attended',0);
            $this->db->update('transaction');
        } else {
        $this->db->select('*');
        $this->db->from('transaction');
        $this->db->where('attended',0);
        $this->db->where('time',$a);
        $this->db->where('need',$type);
        $this->db->join('patient','patient.patient_id=transaction.patient_id');
        $this->db->join('device','device.device_id=patient.device_id');
        $this->db->join('bed_room','bed_room.id=patient.bed_room_id');
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->result();
        }
    }
    public function get_min_time($type){
        $this->db->select_min('time');
        $this->db->from('transaction');
        $this->db->where('attended',0);
        $this->db->where('need',$type);
        $query = $this->db->get();
        return $query->result();

    }

      public function get_date($type){
        $this->db->select('date');
        $this->db->from('transaction');
        $this->db->where('attended',0);
        $this->db->where('need',$type);
        $query = $this->db->get();
        return $query->result();
    }
	
    public function accept_req($t,$c){
        date_default_timezone_set('asia/singapore');
        $this->db->set('staff_id',$c);
        $this->db->set('attended',1);
        $this->db->set('time_attended',date('His'));
        $this->db->where('trans_id', $t);
        $this->db->update('transaction');

    }

    public function add_details($tid,$did){

        date_default_timezone_set('asia/singapore');
        $this->db->set('details',$did);
        $this->db->set('time_finished',date('His'));
        $this->db->where('trans_id', $tid);
        $this->db->update('transaction');

    }

    public function get_detail($tid){

        $this->db->select('*');
        $this->db->where('trans_id',$tid);
        $this->db->from('transaction');
        $query = $this->db->get();
        return $query->result();

    }

    public function update($id,$fname,$mname,$lname,$gender,$email,$con,$add){
       
        $this->db->set('fname',$fname);
        $this->db->set('mname',$mname);
        $this->db->set('lname',$lname);
        $this->db->set('gender', $gender);
        $this->db->set('email',$email);
        $this->db->set('contact_no',$con);
        $this->db->set('address',$add);
        $this->db->where('id',$id);
        $this->db->update('staff_t');
    }

    public function cancel_req($tid){

        $this->db->set('attended',0);
        $this->db->set('staff_id',0);
        $this->db->set('time_attended',0);
        $this->db->where('trans_id',$tid);
        $this->db->update('transaction');

    }

    public function job_done($tid){
        
    }

    public function update_uname($uname,$id){

        $this->db->set('username',$uname);
        $this->db->where('id',$id);
        $this->db->update('staff_t');

    }

     public function update_pass($pass,$id){

        $this->db->set('password',$pass);
        $this->db->where('id',$id);
        $this->db->update('staff_t');

    }

    public function logged_in($id){

        $this->db->set('logged_in',1);
        $this->db->where('id',$id);
        $this->db->update('staff_t');

    }

    public function logged_out($out,$id){

        $this->db->set('logged_in',$out);
        $this->db->where('id',$id);
        $this->db->update('staff_t');

    }

    public function no_details($id){

        $this->db->select('trans_id');
        $this->db->where('staff_id',$id);
        $this->db->where('attended',1);
        $this->db->where('time_finished',0);
        $query = $this->db->get('transaction');

        if($query->num_rows()>0){
            return 1;
        } else  {
            return 0;   
        }

    }

     public function no_details_n($id){

        $this->db->select('trans_id');
        $this->db->where('staff_id',$id);
        $this->db->where('attended',1);
        $this->db->where('time_finished',0);
        $query = $this->db->get('transaction');

        if($query->num_rows()>0){
            return $query->result();
        } else  {
            return 0;   
        }

    }
}
?>