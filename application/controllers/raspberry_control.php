<?php
/**
 * Created by PhpStorm.
 * User: Shellamae
 * Date: 12/17/2016
 * Time: 10:28 AM
 */
class Raspberry_control extends CI_Controller{

    public function index(){
        date_default_timezone_set('asia/singapore');
        echo date('His');
        $this->load->view('rasp_temp');

    }

    public function check($name){ //attended 0
        $this->load->model('raspberry_model');
        $data = $this->raspberry_model->check($name);
        $id = null;
        foreach ($data as $k) {
            $id = $k->trans_id;
        }

        return $id;
    }

    public function check_attended($name){ //attended 1 finished 0
        $this->load->model('raspberry_model');
        $data = $this->raspberry_model->check_attended($name);
        $id = null;
        foreach ($data as $k) {
            $id = $k->trans_id;
        }

        return $id;
    }

    public function check_patient($name){ // get the patient id of the device holder
        $this->load->model('raspberry_model');
        $device_id = $this->raspberry_model->check_device_id($name);
        $d = null;
        foreach ($device_id as $k) {
            $d = $k->device_id;
        }

        $patient_id = $this->raspberry_model->check_patient_id($d);
        $pid = null;
        foreach ($patient_id as $k) {
            $pid = $k->patient_id;
        }

        return $pid;

    }

    public function main_process($a,$name,$mac){

        $this->load->model('raspberry_model');

        $mac_db = $this->raspberry_model->get_mac($name);
        foreach ($mac_db as $key) {
            $mac_db = $key->mac;
        }

        if($mac==$mac_db){ // check if mac from device matches the mac in the database
            $id = $this->check($name);
            $attended_but_not_finished = $this->check_attended($name);
            $pid  = $this->check_patient($name);
            if($pid==null){
                echo "no patient";
            }else{
                if($id!=null){  // attended 0
                    $this->raspberry_model->update_trans($a,$id);
                    echo " need".$a." ";
                    echo "transid".$id;
                    echo "update lang cya stupid!!";
                }else{
                    if($attended_but_not_finished!=null){
                       echo "do nothing";
                    }else{
                        $this->raspberry_model->add_trans($a,$name,$pid);
                       echo "add";
                       //check how many insert
                        $count = $this->raspberry_model->check_how_many_insert($pid);
                       //select 1 ID
                        $id = $this->raspberry_model->select_1_id($pid);
                        $transid = null;
                        foreach($id as $r){
                            $transid = $r->trans_id;
                        }
                       //delete except 1 ID
                        $this->raspberry_model->delete_1_id($pid,$transid);
                    }
                }
            }    
        }    
    }

    public function emergency($names){ //from raspberry pi device

        list($name,$mac) = explode('.', $names);
        $a = "emergency";
        $this->main_process($a,$name,$mac);
        
    }
    public function cr($names){ //from raspberry pi device

        list($name,$mac) = explode('.', $names);
        $a = "cr";
        $this->main_process($a,$name,$mac);
    }
    public function clothes($names){ //from raspberry pi device

        list($name,$mac) = explode('.', $names);
        $a = "clothes";
        $this->main_process($a,$name,$mac);
    }

    public function water($names){ //from raspberry pi device

        list($name,$mac) = explode('.', $names);
        $a = "water";
        $this->main_process($a,$name,$mac);
    }
    public function massage($names){ //from raspberry pi device

        list($name,$mac) = explode('.', $names);
        $a = "massage";
        $this->main_process($a,$name,$mac);
    }

    // responses

    public function request_status($names){ //from raspberry pi device
        list($name,$mac) = explode('.', $names);

        $pid = $this->check_patient($name); // get the patient id thru device name 
        //get queries where attended = 0
        // 1 if there is a request that was not yet attended.
        // 2 if there is an attended request but not yet done.
        $a = $this->raspberry_model->check_attended2($pid);
        if($a==0){
            $a = $this->raspberry_model->check_attended3($pid);
            if($a==0){
                echo 0;
            }else{
                echo 2;
            }
        }else{
            echo 1;
        }
    }


    public function login_update($names){ //from raspberry pi device

        list($name,$mac) = explode('.', $names);

        $this->load->model('raspberry_model');
        $this->raspberry_model->login_update($name);


    }

    public function get_allow_start($name){

        $result =$this->raspberry_model->get_allow_start($name);
        $start = null;
        foreach ($result as $r){
            $start = $r->allow_start;
        }

        if($start==1){
            echo 1;
        }else{
            echo 0;
        }

    }
}
?>