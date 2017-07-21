<?php
/**
 * Created by PhpStorm.
 * User: Shellamae
 * Date: 12/17/2016
 * Time: 10:45 AM
 */
class raspberry_model extends CI_Model{

    public function add_trans($a,$n,$pid){
        date_default_timezone_set('asia/singapore');

        $data = array(
            'date' => date('y/m/d'),
            'time' => date('His'),
            'need' => $a,
            'patient_id' => $pid,
            'attended' => 0
        );
        $this->db->insert('transaction',$data);
    }

    public function check($n){

        // get device id thru name
        $dev_id = $this->get_device_id($n);
        var_dump($dev_id);
        $device_id = null;
        foreach ($dev_id as $key) {
            $id = $key->device_id;
        }

        //get patient id thru device id
        $pid = $this->get_patient_id($id);
        $patient_id = null;
        foreach ($pid as $k) {
            $patient_id = $k->patient_id;
        }
        
        date_default_timezone_set('asia/singapore');
        $this->db->select('trans_id');
        $this->db->from('transaction');
        $this->db->where('attended',0);
        $this->db->where('date',date('y/m/d'));
        $this->db->where('patient_id',$patient_id);

        $q = $this->db->get();
        return $q->result();

    }

    public function get_patient_id($device_id){
        $this->db->select('patient_id');
        $this->db->from('patient');
        $this->db->where('device_id',$device_id);
        $this->db->where('patient.deleted',0);
        $q = $this->db->get();
        return $q->result();
    }


    public function get_device_id($n){
        $this->db->select('device_id');
        $this->db->from('device');
        $this->db->where('name',$n);
        $q = $this->db->get();
        return $q->result();
    }


    public function check_attended($n){

         // get device id thru name
        $dev_id = $this->get_device_id($n);
        $device_id = null;
        foreach ($dev_id as $key) {
            $id = $key->device_id;
        }

        //get patient id thru device id
        $pid = $this->get_patient_id($id);
        $patient_id = null;
        foreach ($pid as $k) {
            $patient_id = $k->patient_id;
        }

        date_default_timezone_set('asia/singapore');
        $this->db->select('trans_id');
        $this->db->from('transaction');
        $this->db->where('attended',1);
        $this->db->where('time_finished=',0);
        $this->db->where('date',date('y/m/d'));
        $this->db->where('patient_id',$patient_id);

        $q = $this->db->get();
        return $q->result();

    }

    public function update_trans($a,$i){
        date_default_timezone_set('asia/singapore');
        $this->db->set('need',$a);
        $this->db->set('time',date('His'));
        $this->db->where('trans_id',$i);
        $this->db->update('transaction');
    }

    public function check_device_id($name){
        $this->db->select('device_id');
        $this->db->from('device');
        $this->db->where('name',$name);

        $q = $this->db->get();
        return $q->result();
    }

    public function check_patient_id($did){
        $this->db->select('patient_id');
        $this->db->from('patient');
        $this->db->where('device_id',$did);
        $this->db->where('patient.deleted',0);
        $q = $this->db->get();
        return $q->result();
    }

    public function check_attended2($pid){ //this check if there is a transaction that was not attended yet (specific device/patient).
        $this->db->select('trans_id');
        $this->db->from('transaction');
        $this->db->where('attended',0);
        $this->db->where('patient_id',$pid);

        $query = $this->db->get();
        if($query->num_rows()>0){
            return 1;
        }else{
            return 0;
        }
    }

    //this check if there is an attended request that is not yet done
    public function check_attended3($pid){
        $this->db->select('trans_id');
        $this->db->from('transaction');
        $this->db->where('attended',1);
        $this->db->where('time_finished',0);
        $this->db->where('patient_id',$pid);

        $query = $this->db->get();
        if($query->num_rows()>0){
            return 1;
        }else{
            return 0;
        }
    }

    public function login_update($name){

         date_default_timezone_set('asia/singapore');
        $this->db->set('last_logged_in_date',date('y/m/d'));
        $this->db->set('last_logged_in',date('His'));
        $this->db->where('name',$name);
        $this->db->update('device');

    }

    public function get_allow_start($name){

        $this->db->select('allow_start');
        $this->db->where('name',$name);
        $this->db->from('device');
        $query = $this->db->get();
        return $query->result();

    }

    public function check_how_many_insert($name){
        $this->db->where('patient_id',$name);
        $this->db->where('attended',0);
        $this->db->from('transaction');
        return $this->db->count_all_results();
    }

    public function select_1_id($pid){
        $this->db->select('trans_id');
        $this->db->limit(1);
        $this->db->where('patient_id',$pid);
        $this->db->where('attended',0);
        $this->db->from('transaction');

        $query = $this->db->get();
        return $query->result(); //stop here
    }

    public function delete_1_id($pid,$tid){
        
        $this->db->where('patient_id',$pid);
        $this->db->where('attended',0);
        $this->db->where('trans_id!=',$tid);
        $this->db->delete('transaction');
    }

    public function get_mac($name){

        $this->db->select('mac');
        $this->db->from('device');
        $this->db->where('name',$name);
        $query = $this->db->get();
        return $query->result();
    }

}
?>