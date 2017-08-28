<?php

class Index_control extends CI_Controller {

    public function __construct() {
        parent::__construct();
	}

	public function index()
	{
		$this->load->view('login_material');
	}
	public function check_login()
	{
		$this->load->model('Check_login');
        $data['query'] = $this->Check_login->index();
	}
	public function logout()
	{
		    $this->session->sess_destroy();
            redirect("index_control/index");
            exit();
	}
	public function server_client_agent()
	{
		date_default_timezone_set("Asia/Bangkok");
		$hostname 		= $this->input->post('hostname_host');
		$ip_address		= $this->input->post('ip_host');

		$query = $this->db->query("select * from computer_agent where agent_ip = '$ip_address'");

        $result = $query->result();

        if($query->num_rows() == 0){

        	$data = array(
				'agent_ip'			=> $ip_address,
				'agent_hostname'	=> $hostname,
				'agent_description'	=> 'Agent',
				'agent_status'		=> '1'

				);
			$this->db->insert('computer_agent',$data);
			gen_ip_to_json();

        }else{
            $this->db->where("agent_ip",$ip_address);
            $this->db->update("computer_agent",array('agent_timestamp' => date('Y-m-d-h-m-s'),'agent_status' => '1'));
        }
	}
	public function log_start_agent()
	{
		$data = array(

			'log_event' => $this->input->post('log_event'),
			'agent_ip'	=> $this->input->post('ip_host'),
			'type_id'	=> '1'

			);
		$this->db->insert('log_data',$data);
	}


	public function log_del()
	{

		$data = array(
		'agent_ip' 	=> $this->input->post('ip'),
		'log_event' => $this->input->post('event'),
		'type_id'	=> '2'
		);

		$this->db->insert('log_data',$data);
		echo "ok";

	}

	public function alert_kill()
	{

		 $data = array(
            'log_event'      => $this->input->post('alert_kill'),
            'type_id'		 => "2",
            'agent_ip'		 => $this->input->post('host')
            );
		 $this->db->insert('log_data',$data);
	}

	public function alert_require()
	{
		 $data = array(
            'log_event'      => $this->input->post('alert_reqire'),
            'type_id'		 => "1",
            'agent_ip'		 => $this->input->post('host')
            );
		 $this->db->insert('log_data',$data);
	}

}
