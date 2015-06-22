<?php
class Home extends CI_Controller {
	
	function index()
	{
		if($this->session->userdata('is_logged_in')){
			
		$this->load->view('admin/home');	
		}
		else
		{
			redirect('admin/login');
		}
	}
	
	function logout()
	{
		$data = array(
				'user_name' => '',
				'is_logged_in' => false
		);
		
		//session_destroy();
		
		$this->session->set_userdata($data);
                $this->session->sess_destroy();
		redirect('admin/login');
		
	}
	
}
?>