<?php

class Policy_control extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
	}

	public function index()
	{
		$this->load->view('login_material');
	}
	public function setting()
	{
		if($this->session->userdata('user_id')!=null)
		{
			$this->load->model('Insert_process');
	        $data['query'] = $this->Insert_process->show_process_0();

			$this->load->view('head');
			$this->load->view('setting_latest',$data);
		}else{
			redirect("index_control/index","refresh");
			exit();
		}

	}

	public function ip()
	{
		$array = $this->input->post('block');
		file_put_contents('extension/file/json_block_web.json',$array);
		echo "ok";
	}

	public function save_setting_agent()
	{
		$alert_time = $this->input->post('alert_kill')*1000;
		$time_block = $this->input->post('block_time')*1000;
		$data = array(

				'time_alert_kill'	=> "$alert_time",
				'time_to_block'		=> "$time_block"

			);
		$save_json = json_encode($data);
		file_put_contents('extension/file/config_time.json', $save_json);
		echo "ok";

	}
	public function activate_policy_allow()
	{
			$sql1="select * from manage_process where process_status = 0";


            $sq1=$this->db->query($sql1);

            if ($sq1->num_rows()==0) 
            {
                $data['sq1']=array();
            }

            foreach ($sq1->result() as $item) {

				 $data_json1[] = $item->process_name;


            } 

            	$data_convert_json = array('process_normal'=>$data_json1);
            	$data_json_convert = json_encode($data_convert_json,true);       	
            	file_put_contents('extension/file/process_normal.json', $data_json_convert);

            	


	}
	public function activate_policy_mallicious()
	{
		    $sql="select * from manage_process where process_status = 1";

            $sq=$this->db->query($sql);

            if ($sq->num_rows()==0) 
            {
                $data['sq']=array();
            }


            foreach ($sq->result() as $item) {

				 $data_json[] = $item->process_name;


            } 
            	$data_convert_json = array('process_danger'=>$data_json);
            	$data_json_convert = json_encode($data_convert_json,true);       	
            	file_put_contents('extension/file/process_mallicious.json', $data_json_convert);

            	


	}
    public function import_file()
    {

             if(!empty($_FILES["file_import"]))
                    {
                        $config['file_name'] = "json_block_web";
                        $config['overwrite'] = TRUE;
                        $config['upload_path'] = './extension/file';
                        $config['allowed_types'] = '*';
                        $config['max_size'] = '0';
                        $config['max_width'] = '0';
                        $config['max_height'] = '0';

         
                        $this->upload->initialize($config);
                        // print_r($config);
                    if (!$this->upload->do_upload('file_import'))
                        {
                        echo json_encode(array('success'=>false,'message'=>lang('config_saved_unsuccessfully')));
                        }
                    else
                        {
                        $data = $this->upload->data();

		               	echo '<script language="javascript">';
		              	echo 'alert("Upload file Success if to file working click Activate please")';
		              	echo '</script>';

		              	redirect('policy_control/setting','refresh');

                    }
                }
                		echo '<script language="javascript">';
		              	echo 'alert("File is Null")';
		              	echo '</script>';
    }

    public function manage_process()
    {
		if($this->session->userdata('user_id')!=null)
		{
	    	$this->load->model('Insert_process');
	        $data['query'] = $this->Insert_process->show_process_0();

	    	$this->load->model('Insert_process');
	        $data['query1'] = $this->Insert_process->show_process_1();

	        $this->load->model('Insert_process');
	        $data['query2'] = $this->Insert_process->ip_to_activate();

	        $this->load->view('head');
	        $this->load->view('in_out_process',$data);
	    }else{
	    	redirect("index_control/index","refresh");
	    	exit();
	    }
		
	}
	public function process_tracking()
    {
		if($this->session->userdata('user_id')!=null)
		{
	    	$this->load->model('Insert_process');
	        $data['query'] = $this->Insert_process->show_process_0();

	        $this->load->model('Insert_process');
	        $data['query2'] = $this->Insert_process->ip_to_activate();

	        $this->load->view('head');
	        $this->load->view('process_tracking',$data);
	    }else{
	    	redirect("index_control/index","refresh");
	    	exit();
	    }
		
	}

	public function del_process($process_id)
	{
			$this->db->delete('manage_process',array('process_id' =>  $process_id));
			echo "ok";
	}
	public function insert_process()
	{

           $process_id            = $this->input->post('process_id');
           $process_name          = $this->input->post('process_name');
           $process_description   = $this->input->post('process_description');
           $process_status        = $this->input->post('process_status');

        $data = array(
            'process_id'           => $process_id,         
            'process_name'         => $process_name,              
            'process_description'  => $process_description,
            'process_status'       => $process_status

            );
		$this->db->insert('manage_process',$data);
	}
	public function insert_process_normal()
	{

		$data_normal = array(
			'process_name' 			=> $this->input->post('process_name_normal'),
			'process_description' 	=> $this->input->post('process_des_normal'),
			'process_status' 		=> "0"

			);
		$this->db->insert('manage_process',$data_normal);
		echo "ok";
	}
	public function insert_process_danger()
	{
		$data_danger = array(
			"process_name" 			=> $this->input->post('process_name_danger'),
			"process_description" 	=> $this->input->post('process_des_danger'),
			"process_status" 		=> "1"

			);
		$this->db->insert('manage_process',$data_danger);
		echo "ok";
	}
	public function export_file()
	{

		$data = file_get_contents('extension/file/json_block_web.json');
		$name = 'FilePolicy'; 
		force_download($name,$data); 

		force_download('/extension/file/json_block_web.json');
	}
	public function log_activate_process_malicious()
	{
		$ip_address =  $this->input->post('ip');
		$event = $ip_address." is Activated Malicious Process!";

		$data = array(
			'agent_ip' 	=> $ip_address,
			'log_event'	=> $event,
			'type_id'	=> "1"

			);
		$this->db->insert('log_data',$data);
	}

	public function log_unactivate_process_malicious()
	{
		$ip_address =  $this->input->post('ip');
		$event = $ip_address." is No Activate Malicious Process!!";

		$data = array(
			'agent_ip' 	=> $ip_address,
			'log_event'	=> $event,
			'type_id'	=> "2"

			);
		$this->db->insert('log_data',$data);
	}

	public function log_activate_process_normal()
	{
		$ip_address =  $this->input->post('ip');
		$event = $ip_address." is Activated Tracking Process!";

		$data = array(
			'agent_ip' 	=> $ip_address,
			'log_event'	=> $event,
			'type_id'	=> "1"

			);
		$this->db->insert('log_data',$data);
	}

	public function log_unactivate_process_normal()
	{
		$ip_address =  $this->input->post('ip');
		$event = $ip_address." is No Activate Tracking Process!!";

		$data = array(
			'agent_ip' 	=> $ip_address,
			'log_event'	=> $event,
			'type_id'	=> "2"

			);
		$this->db->insert('log_data',$data);
	}

}
