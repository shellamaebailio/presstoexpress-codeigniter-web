<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Mobile_c extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		   $this->load->model('mobile');
	}

  public function online(){
      $data = file_get_contents("php://input");
      $request = json_decode($data);

      $caretaker_id = $request->caretaker_id;
      $this->mobile->online($caretaker_id);

  }
	
	public function login(){
	  
      $data = file_get_contents("php://input");
      $request = json_decode($data);

      $user = $request->username;
      $pass = md5($request->password);

      $login = $this->mobile->login($user,$pass);
	  
      $username = null;
      $password = null;
      $id = null;
	  
      foreach($login as $r){
		  
          $id = $r->id;
          $username = $r->username;
          $password = $r->password;
          
      }
	  

      if($password==$pass){
          $this->mobile->logged_in($id);
          echo $id;
      } else {
          echo 0;
      }

	}

  public function get_request(){
        $this->load->model('mobile');
        $data_temp = $this->mobile->get_request('emergency');
        if($data_temp==null){
            $data_temp = $this->mobile->get_request('cr');
            if($data_temp==null){
                $data_temp = $this->mobile->get_request('water');
                if($data_temp==null){
                    $data_temp = $this->mobile->get_request('clothes');
                    if($data_temp==null){
                        $data_temp = $this->mobile->get_request('massage');
                        if($data_temp==null){

                        }else{
                            foreach($data_temp as $key){
                                $bb = $key->birthdate;
                                list($y,$m,$d) = explode('-', $bb);
                                $key->age = date('Y')-$y;
                            }
                        }
                    }else{
                        foreach($data_temp as $key){
                            $bb = $key->birthdate;
                            list($y,$m,$d) = explode('-', $bb);
                            $key->age = date('Y')-$y;
                        }
                    }
                }else{
                    foreach($data_temp as $key){
                        $bb = $key->birthdate;
                        list($y,$m,$d) = explode('-', $bb);
                        $key->age = date('Y')-$y;
                    }
                }
            }else{
                foreach($data_temp as $key){
                    $bb = $key->birthdate;
                    list($y,$m,$d) = explode('-', $bb);
                    $key->age = date('Y')-$y;
                }
            }
        }else{
            foreach($data_temp as $key){
                $bb = $key->birthdate;
                list($y,$m,$d) = explode('-', $bb);
                $key->age = date('Y')-$y;
            }
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data_temp));
    }


   public function accept_req($id){
      $data = file_get_contents("php://input");
      $request = json_decode($data);

      $tid = $request->trans_id;
      $cid = $request->caretaker_id;

      $this->mobile->accept_req($tid,$cid);

  }

    public function add_details(){

      $data = file_get_contents("php://input");
      $request = json_decode($data);

      $tid = $request->trans_id;
      $did = $request->details;

      $this->mobile->add_details($tid,$did);

    }

    public function get_detail($id){

      $data = $this->mobile->get_detail($id);

       $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }

    public function cancel_req(){

      $data = file_get_contents("php://input");
      $request = json_decode($data);

      $tid = $request->trans_id;
      $this->mobile->cancel_req($tid);

    }

    public function update($id){

       $data = file_get_contents("php://input");
      $request = json_decode($data);


      $fname = $request->fname;
      $mname = $request->mname;
      $lname = $request->lname;
      $gender = $request->gender;
      $email = $request->email;
      $con = $request->contact_no;
      $add = $request->address;

      $this->mobile->update($id,$fname,$mname,$lname,$gender,$email,$con,$add);

    }


    public function update_uname($id){

      $data = file_get_contents("php://input");
      $request = json_decode($data);
      $uname = $request->username;
      
      $this->mobile->update_uname($uname,$id);

    }

    public function update_pass($id){

      $data = file_get_contents("php://input");
      $request = json_decode($data);
      $pass =  md5($request->password);
      
      $this->mobile->update_pass($pass,$id);

    }

    public function logged_out($id){

      $data = file_get_contents("php://input");
      $request = json_decode($data);
      $out =  md5($request->logged_in);

      $this->mobile->logged_out($out,$id);
   
    }

    public function no_details($id){
      
       $data = $this->mobile->no_details($id);

       $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));

    }

    public function no_details_n($id){
      
       $data = $this->mobile->no_details_n($id);

       $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));

    }

  
  	
}
?>