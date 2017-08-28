<?php

class Dashboard_control extends CI_Controller {

    public function __construct() {
        parent::__construct();
	}

	public function index()
	{
		$this->load->view('login_material');
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
	public function show_agent_detail($agent_ip)
	{
		if($this->session->userdata('user_id')!=null){

			 $ip = $agent_ip;
			 $sql = "select log_data.log_id as log_id,log_data.agent_ip as agent_ip,computer_agent.agent_status as agent_status,log_data.type_id as type_id,computer_agent.agent_hostname as agent_hostname from log_data,computer_agent where log_data.agent_ip=computer_agent.agent_ip AND log_data.agent_ip='$ip' AND log_id = (select max(log_id) from log_data where agent_ip='$ip' order by log_time) order by log_data.log_time desc";


			 $sql1="select * from log_data where agent_ip='$ip' order by log_time DESC";

			 $sq=$this->db->query($sql);

			 $sq1=$this->db->query($sql1);

	            if ($sq1->num_rows()==0) 
	            {
	                $data['sq1']=array();
	            }
	            else{
	            		$data['sq1'] = array();

	            		for ($i=0; $i < $sq1->num_rows(); $i++) { 

	            			  $a['sq1'] = array();
	            			  $a['sq1'] = $sq1->row_array($i);
	            			  array_push($data['sq1'],$a['sq1']);

	            		}	
	            	}


	            $sq=$this->db->query($sql);

	            if ($sq->num_rows()==0) 
	            {
	                $data['sq']=array();
	            }
	            else{

	                $data['sq']=$sq->row_array();
	            }
	    	// var_dump($data['sq1']);
	            $this->load->view('head');
				$this->load->view('index_dash_edit',$data);

		}else{
			redirect("index_control/index","refresh");
			exit();
		}


	}
	public function update_agent()
	{
		$ip_address = $this->input->post('ip');
		$event = $ip_address." Offline!";
       	$this->db->where("agent_ip",$ip_address);
        $this->db->update("computer_agent",array('agent_timestamp' => date('Y-m-d-h-m-s'),'agent_status' => '0'));
        $this->log_shutdown($ip_address,$event);
        echo "ok";
	}
	public function log_shutdown($ip_address,$event)
	{
		$data = array(

			'log_event' => $event,
			'agent_ip'	=> $ip_address,
			'type_id'	=> '2'

			);
		$this->db->insert('log_data',$data);
	}
	public function show_on_off()
	{

		if($this->session->userdata('user_id')!=null){

			$this->load->model('Display_on_off');                //load data from std_model
	        $data['query'] = $this->Display_on_off->show_status_agent();

	        $data['sq']=array();

	        for($i=0;$i<count($data['query']);$i++){

	        	    $ip = $data['query'][$i]['agent_ip'];


	        		$sql = "select log_data.log_id as log_id,log_data.agent_ip as agent_ip,computer_agent.agent_status as agent_status,log_data.type_id as type_id from log_data,computer_agent where log_data.agent_ip=computer_agent.agent_ip AND log_data.agent_ip='$ip' AND log_id = (select max(log_id) from log_data where agent_ip='$ip' order by log_time) order by log_data.log_time desc";


	        		$sq=$this->db->query($sql);

	        		if ($sq->num_rows()==0) 
	        		{
	        			$data['sq']=array();
	        		}
	        		else{
	        			
	        			$a['sq'] = array();
	        			$a['sq'] = $sq->row_array();
	        			array_push($data['sq'],$a['sq']);

	        		}
	        		
	        	}	

					$this->load->view('head');
					$this->load->view('show_on_off',$data);
			}else{
				redirect("index_control/index","refresh");
				exit();
			}
		
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

}
