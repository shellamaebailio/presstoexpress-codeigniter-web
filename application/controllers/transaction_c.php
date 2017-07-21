<?php 
class Transaction_c extends CI_Controller{
	public function view_transactions(){
		if(isset($_SESSION['id'])){

			$this->load->model('transaction');
			$from = $this->input->post('from');
			$to = $this->input->post('to');

			$data['froms']= $from;
			$data['to'] = $to;
				
			$data['tran'] = $this->transaction->get_all($from,$to);
			$this->session->set_flashdata('from', $from);
			$this->session->set_flashdata('to', $to);
			
			$this->load->view('transaction',$data);
			}else{
				$this->load->view('login');
			}
	}


}
?>