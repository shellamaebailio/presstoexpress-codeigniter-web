<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class notif_control extends CI_Controller{
	
	public function get_time(){

		$this->load->model('notif');
		$data = $this->notif->get_time();
		$this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));

	}

}

?>