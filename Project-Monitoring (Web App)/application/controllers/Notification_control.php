<?php

class Notification_control extends CI_Controller {

    public function __construct() {
        parent::__construct();
	}

	public function query_real()
	{
			$ip 	= $this->input->get('ip');
			$type 	= $this->input->get('type');



			if($type=="0" && $ip=="1"){

				$sql="select * from log_data order by log_time DESC";
				
			}elseif($type=="0"){

				$sql="select * from log_data where agent_ip='$ip' order by log_time DESC";

			}elseif($ip=="1"){

				$sql="select * from log_data where type_id='$type' order by log_time DESC";


			}else{

				$sql="select * from log_data where agent_ip='$ip' AND type_id='$type' order by log_time DESC";

			}
		    

            $sq=$this->db->query($sql);


            if ($sq->num_rows()==0) 
            {
                $data['sq']=array();
            }
            else{
            		$data['sq'] = array();

            		for ($i=0; $i < $sq->num_rows(); $i++) { 

            			  $a['sq'] = array();
            			  $a['sq'] = $sq->row_array($i);
            			  array_push($data['sq'],$a['sq']);

            		}	
            	}
            	$this->load->view('show_query_ip',$data);


	}
	public function query_audit_log()
	{
			$ip 	= $this->input->post('ip');



			$sql="select * from log_data where type_id='$type' order by log_time DESC";
		    

            $sq=$this->db->query($sql);


            if ($sq->num_rows()==0) 
            {
                $data['sq']=array();
            }
            else{
            		$data['sq'] = array();

            		for ($i=0; $i < $sq->num_rows(); $i++) { 

            			  $a['sq'] = array();
            			  $a['sq'] = $sq->row_array($i);
            			  array_push($data['sq'],$a['sq']);

            		}	
            	}
            	$this->load->view('head');
            	$this->load->view('index_other');
            	$this->load->view('show_query_ip',$data);


	}

    public function index_admin_alert()
    {
        if($this->session->userdata('user_id')!=null)
        {
        	$this->load->model('Alert_model');                //load data from std_model
            $data['query'] = $this->Alert_model->alert_model();

        	$this->load->model('Alert_model');                //load data from std_model
            $data['query1'] = $this->Alert_model->ip_address();

        	$this->load->view('head');
        	$this->load->view('index_other',$data);
        }else{
            redirect("index_control/index","refresh");
            exit();
        }
    }

}
