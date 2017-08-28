<?php

class control extends CI_Controller {

    public function __construct() {
        parent::__construct();
	}

	public function index()
	{
		$this->load->view('login_material');
	}
	public function setting()
	{
		$this->load->model('insert_process');
        $data['query'] = $this->insert_process->show_process_0();

		$this->load->view('head');
		$this->load->view('setting_latest',$data);

	}
	public function query_time()
	{
		$this->load->model('query_time');                //load data from std_model
        $data['query'] = $this->query_time->index();

        foreach ($data['query'] as $item) {

        	echo $item['data_time'];
        	echo "\n";
        	$ip =  $item['agent_ip'];
        	echo $ip;
        	echo "\n";

        	$this->update_agent($ip);

        }
    	
	}
	public function ip()
	{
		$array = $this->input->post('block');
		// $data['url_block'] =  $this->input->post('obj_url');
		var_dump($array);
		// $array['ip_block'] = null;

		// for($i=0;$i<count($data['url_block']);$i++){
		// 	$array['ip_block'][$i] = gethostbyname($data['url_block'][$i]);
		// }

		// $json = json_encode(($array));
		// echo $json;

		// array_push($data['sq1'],$a['sq1']);



		// $ip = gethostbyname($this->input->post('ip'));
		// echo json_encode($ip);

		file_put_contents('extension/file/json_block_web.json',$array);
	}


	public function ip_test()
	{
		$ip = gethostbyname("www.google.com");
		echo "google.com = ".$ip.'<br>';
		$ip1 = gethostbyname("www.youtube.com");
		echo "youtube.com = ".$ip1.'<br>';
		$ip2 = gethostbyname("www.wu.ac.th");
		echo "wu.ac.th = ".$ip2.'<br>';
	}
	public function block_test()
	{
		$this->load->view('head');
		$this->load->view('block_test');
	}

	public function block_edit()
	{
		$this->load->view('head');
		$this->load->view('setting_edit');
	}

	public function setting_agent()
	{
		$this->load->view('head');
		$this->load->view('setting_time');
	}

	public function setting_new()
	{
		$this->load->view('head');
		$this->load->view('setting_1');
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
	public function log_activate()
	{
		$data = array(

		'agent_ip' 	=> $this->input->post('ip'),
		'log_event' => $this->input->post('event'),
		'type_id'	=> '1'
		);

		$this->db->insert('log_data',$data);
		echo "ok";

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

	public function update_agent($ip)
	{
		    $id = $ip;
            $this->db->where("agent_ip",$id);
            $this->db->update("computer_agent",array('agent_status' => '0'));
	}

	public function test_3()
	{
		$data['rs']=$this->db->get("manage_process")->result_array();
		$this->load->view('tan',$data);
	}

	public function add_ajax()
	{
		$ar = array(
				"process_name" 			=>$this->input->post('process_name'),
				"process_description" 	=>$this->input->post('process_des'),
				"process_status" 		=>$this->input->post('process_status')
			);
		$this->db->insert('manage_process',$ar);
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
	public function client_1()
	{
		$this->load->view('client');
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

	public function ip_call_java()
	{
			$sql="select agent_ip from computer_agent";

            $sq=$this->db->query($sql);

            if ($sq->num_rows()==0) 
            {
                $data['sq']=array();
            }else{

                $data['sq']=$sq->row_array();
            }

            $this->load->view('head');
			$this->load->view('in_out_process',$data);
	}
	public function gen_ip_to_json()
	{
		    $sql="select agent_ip from computer_agent";

            $sq=$this->db->query($sql);

            if ($sq->num_rows()==0) 
            {
                $data['sq']=array();
            }

            foreach ($sq->result() as $item) {

				 $data_json[] = $item->agent_ip;


            } 
            	$data_convert_json = array('agent_ip'=>$data_json);
            	$data_json_convert = json_encode($data_convert_json,true);     	
            	file_put_contents('extension/file/agent_ip.json', $data_json_convert);

}



	public function check_com()
	{
		$this->load->view('head');
		$this->load->view('check-com');
		//$this->load->view('foot');
	}
	public function report()
	{
		$this->load->view('head');
		$this->load->view('report');
		//$this->load->view('foot');
	}
	public function get_data()
	{



			$data = $this->input->post('in');
			$data1 = $this->input->post('put');
			echo "SSSS";
			$fp = fsockopen("localhost", 7090, $errno, $errstr, 10);



  			if (!$fp) {
      					echo "$errstr ($errno)<br />\n";
  			} else {
      					$out = 	"$data ";
					    $out .= "$data1 ";
					    $out .= "Sending_Success!!!\r\n\r\n";
     					fwrite($fp, $out);
     		while (!feof($fp)) {
         				echo fgets($fp, 128);
     		}
     					fclose($fp);
 			}



	}
	public function post_data()
	{
		
	}
	public function test_6()
	{
		$this->load->view('head');
		$this->load->view('test');
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
	public function logout()
	{
		    $this->session->sess_destroy();
            redirect("control/index");
            exit();
	}

	public function show_input_client()
	{
		$this->load->view('client');
	}

	public function index_dash()
	{
		// $this->load->view('head');
		$this->load->view('index_dash');
		//$this->load->view('foot');
	}
	public function show_agent_detail($agent_ip)
	{
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

	}
	public function input_file(){
		$this->load->view("test_inputfile");
	}
	public function header()
	{
		$this->load->view('header');
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
	public function login_material()
	{
		$this->load->view('login_material');
	}

    public function import_file()
    {

             if(!empty($_FILES["file_import"]))
                    {
                        $config['file_name'] = "json_block_web_1";
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

		              	redirect('control/setting','refresh');

                    }
                }
                		echo '<script language="javascript">';
		              	echo 'alert("File is Null")';
		              	echo '</script>';
    }
    public function index_admin_alert()
    {
    	$this->load->model('alert_model');                //load data from std_model
        $data['query'] = $this->alert_model->alert_model();

    	$this->load->model('alert_model');                //load data from std_model
        $data['query1'] = $this->alert_model->ip_address();

    	$this->load->view('head');
    	$this->load->view('index_other',$data);
    }


    public function manage_process()
    {

    	$this->load->model('insert_process');                //load data from std_model
        $data['query'] = $this->insert_process->show_process_0();

    	$this->load->model('insert_process');                //load data from std_model
        $data['query1'] = $this->insert_process->show_process_1();

        $this->load->model('insert_process');                //load data from std_model
        $data['query2'] = $this->insert_process->ip_to_activate();

        // var_dump($data['query2']);
        $this->load->view('head');
        $this->load->view('in_out_process',$data);
		
	}
	public function process_tracking()
    {

    	$this->load->model('insert_process');                //load data from std_model
        $data['query'] = $this->insert_process->show_process_0();

        $this->load->view('head');
        $this->load->view('process_tracking',$data);
		
	}

	public function del_process($process_id)
	{
			$this->db->delete('manage_process',array('process_id' =>  $process_id));
			echo "ok";
			// redirect("control/manage_process");
	}

    public function test_json_input(){
    	$this->load->view('head');
    	$this->load->view('test_json_input');
    }
    public function doJson()
    {

		$data1 = array(
			'web_block' => array(
				array(
				'url' 	 => $this->input->post('name1'),
				'action' => $this->input->post('name2')
				),
				array(
				'url' 	 => $this->input->post('name3'),
				'action' => $this->input->post('name4')
				)
			),
			'port_block' => array(
				array(
				'url' 	 => $this->input->post('name5'),
				'action' => $this->input->post('name6')
				),
				array(
				'url' 	 => $this->input->post('name7'),
				'action' => $this->input->post('name8')
				)
			)
		);
		// echo json_encode($data);
		file_put_contents('extension/file/test1.json', json_encode($data1));
       
	}
	public function test_json()
	{
		if($this->input->post('name1') != null && $this->input->post('name2') != null){
			$a1 = $this->input->post('name1');
			$a2 = $this->input->post('name2');
			echo $a1;
			echo $a2;
		}else {
			if($this->input->post('name1') == null){
				echo "name 1 NULL";
			}else{
				echo "name 2 Null";
			}
		}
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
          
        // redirect("control/manage_process","refresh");
	}


	public function check()
	{
		$this->load->view('head');
		$this->load->view('test_check');
	}
	public function check_login()
	{
		$this->load->model('check_login');
        $data['query'] = $this->check_login->index();
	}

	public function test_check()
	{

		if($this->input->post('on_off4') != null){
			echo $this->input->post('web1');
		}
		if($this->input->post('on_off5') != null){
			echo $this->input->post('web2');
		}
		if($this->input->post('on_off6') != null){
			echo $this->input->post('web3');
		}
	}
	public function test_check1()
	{

		if($this->input->post('on_off') != null){
			echo $this->input->post('name1');
			echo $this->input->post('name2');
		}
		if($this->input->post('on_off1') != null){
			echo $this->input->post('name3');
		}

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
	public function show_on_off()
	{
		$this->load->model('display_on_off');                //load data from std_model
        $data['query'] = $this->display_on_off->show_status_agent();

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
	}
	public function index_dash_sum()
	{
		$this->load->view('head');
		$this->load->view('index_other');
	}

	public function setting_old()
	{
		$this->load->view('head');
		$this->load->view('setting');
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
	public function show_process()
	{
		$this->load->view('client');
	}

	public function export_file()
	{

		$data = file_get_contents('extension/file/json_block_web.json');
		$name = 'json_block_web.json'; 
		force_download($name,$data); 

		force_download('/extension/file/json_block_web.json');
	}

	public function get_data_agent()
	{ 
		$cpu 		= $this->input->post('cpu_send');
		$ram 		= $this->input->post('ram_send');
		$ip 		= $this->input->post('ip_host');
		$disk 		= $this->input->post('disk_send');
		
		if($cpu > 80){
			$alert_cpu 	= $ip." Alert CPU ".$cpu;
			$cpu_data = array(
				'log_event' => $alert_cpu,
				'agent_ip' => $ip,
				'type_id'  => '2'
				);

			$this->db->insert('log_data',$cpu_data);

		}elseif ($ram > 80) {
			$alert_ram 	= $ip." Alert RAM ".$ram;
			$ram_data = array(
				'log_event' => $alert_ram,
				'agent_ip' => $ip,
				'type_id'  => '2'
				);

			$this->db->insert('log_data',$ram_data);
		}

		$data = array(
            'data_cpu'     => $cpu,         
            'data_ram'     => $ram,              
            'agent_ip'     => $ip,
            'data_disk'    => $disk

            );
		$this->db->insert('computer_data',$data);
	}

	public function server_client1()
	{
		$a	= $this->input->post('data');

		$data_normal = array(

            'username'     => $a,
            'password'	   => "mssssss"        
        
            );
		
		$this->db->insert('member_test',$data_normal);
		
	}

	public function input_setting(){

		$on_off1 	 = $this->input->post('on_off1');
		$web1 	 	 = $this->input->post('web1');
		$action1 	 = $this->input->post('select1');
//----------------------------------------------------------------
//----------------------------------------------------------------
		$on_off2 	 = $this->input->post('on_off2');
		$web2 	 	 = $this->input->post('web2');
		$action2 	 = $this->input->post('select2');
//----------------------------------------------------------------
//----------------------------------------------------------------
		$on_off3 	 = $this->input->post('on_off3');
		$web3 	 	 = $this->input->post('web3');
		$action3 	 = $this->input->post('select3');
//----------------------------------------------------------------
//----------------------------------------------------------------
		$on_off4	 	 = $this->input->post('on_off4');
		$action4 	 	 = $this->input->post('select4');
//----------------------------------------------------------------
		if($this->input->post('field_name[0]') == null){
			$web4_1 	 = "null";
		}else{
			$web4_1 	 = $this->input->post('field_name[0]');
		}
//----------------------------------------------------------------
		if($this->input->post('field_name[1]') == null){
			$web4_2 	 = "null";
		}else{
			$web4_2 	 = $this->input->post('field_name[1]');
		}
//----------------------------------------------------------------
		if($this->input->post('field_name[2]') == null){
			$web4_3 	 = "null";
		}else{
			$web4_3 	 = $this->input->post('field_name[2]');
		}
//----------------------------------------------------------------
		if($this->input->post('field_name[3]') == null){
			$web4_4 	 = "null";
		}else{
			$web4_4 	 = $this->input->post('field_name[3]');
		}
//----------------------------------------------------------------
		if($this->input->post('field_name[4]') == null){
			$web4_5 	 = "null";
		}else{
			$web4_5 	 = $this->input->post('field_name[4]');
		}
//----------------------------------------------------------------
		if($this->input->post('field_name[5]') == null){
			$web4_6 	 = "null";
		}else{
			$web4_6 	 = $this->input->post('field_name[5]');
		}
//----------------------------------------------------------------
		if($this->input->post('field_name[6]') == null){
			$web4_7 	 = "null";
		}else{
			$web4_7 	 = $this->input->post('field_name[6]');
		}
//----------------------------------------------------------------
		if($this->input->post('field_name[7]') == null){
			$web4_8 	 = "null";
		}else{
			$web4_8 	 = $this->input->post('field_name[7]');
		}
//----------------------------------------------------------------
		if($this->input->post('field_name[8]') == null){
			$web4_9 	 = "null";
		}else{
			$web4_9 	 = $this->input->post('field_name[8]');
		}
//----------------------------------------------------------------
		if($this->input->post('field_name[9]') == null){
			$web4_10 	 = "null";
		}else{
			$web4_10 	 = $this->input->post('field_name[9]');
		}
//----------------------------------------------------------------
//----------------------------------------------------------------		

		$on_off5	 	 = $this->input->post('on_off5');
		$action5 	 	 = $this->input->post('select5');
//----------------------------------------------------------------	
		if($this->input->post('field_name1[0]') == null){
			$web5_1 	 = "null";
		}else{
			$web5_1 	 = $this->input->post('field_name1[0]');
		}
//----------------------------------------------------------------	
		if($this->input->post('field_name1[1]') == null){
			$web5_2 	 = "null";
		}else{
			$web5_2 	 = $this->input->post('field_name1[1]');
		}
//----------------------------------------------------------------	
		if($this->input->post('field_name1[2]') == null){
			$web5_3 	 = "null";
		}else{
			$web5_3 	 = $this->input->post('field_name1[2]');
		}
//----------------------------------------------------------------	
		if($this->input->post('field_name1[3]') == null){
			$web5_4 	 = "null";
		}else{
			$web5_4 	 = $this->input->post('field_name1[3]');
		}
//----------------------------------------------------------------	
		if($this->input->post('field_name1[4]') == null){
			$web5_5 	 = "null";
		}else{
			$web5_5 	 = $this->input->post('field_name1[4]');
		}
//----------------------------------------------------------------	
		if($this->input->post('field_name1[5]') == null){
			$web5_6 	 = "null";
		}else{
			$web5_6 	 = $this->input->post('field_name1[5]');
		}
//----------------------------------------------------------------	
		if($this->input->post('field_name1[6]') == null){
			$web5_7 	 = "null";
		}else{
			$web5_7 	 = $this->input->post('field_name1[6]');
		}
//----------------------------------------------------------------	
		if($this->input->post('field_name1[7]') == null){
			$web5_8 	 = "null";
		}else{
			$web5_8 	 = $this->input->post('field_name1[7]');
		}
//----------------------------------------------------------------	
		if($this->input->post('field_name1[8]') == null){
			$web5_9 	 = "null";
		}else{
			$web5_9 	 = $this->input->post('field_name1[8]');
		}
//----------------------------------------------------------------	
		if($this->input->post('field_name1[9]') == null){
			$web5_10 	 = "null";
		}else{
			$web5_10 	 = $this->input->post('field_name1[9]');
		}
//----------------------------------------------------------------	
//----------------------------------------------------------------	
		$on_off6	 	 = $this->input->post('on_off6');
		$action6 	 	 = $this->input->post('select6');
		$protocal		 = $this->input->post('protocal');
//----------------------------------------------------------------
		if($this->input->post('field_name2[0]') == null){
			$web6_1 	 = "null";
		}else{
			$web6_1 	 = $this->input->post('field_name2[0]');
		}
//----------------------------------------------------------------
		if($this->input->post('field_name2[1]') == null){
			$web6_2 	 = "null";
		}else{
			$web6_2 	 = $this->input->post('field_name2[1]');
		}
//----------------------------------------------------------------
		if($this->input->post('field_name2[2]') == null){
			$web6_3 	 = "null";
		}else{
			$web6_3 	 = $this->input->post('field_name2[2]');
		}
//----------------------------------------------------------------
		if($this->input->post('field_name2[3]') == null){
			$web6_4 	 = "null";
		}else{
			$web6_4 	 = $this->input->post('field_name2[3]');
		}
//----------------------------------------------------------------
		if($this->input->post('field_name2[4]') == null){
			$web6_5 	 = "null";
		}else{
			$web6_5 	 = $this->input->post('field_name2[4]');
		}
//----------------------------------------------------------------
		if($this->input->post('field_name2[5]') == null){
			$web6_6 	 = "null";
		}else{
			$web6_6 	 = $this->input->post('field_name2[5]');
		}
//----------------------------------------------------------------
		if($this->input->post('field_name2[6]') == null){
			$web6_7 	 = "null";
		}else{
			$web6_7 	 = $this->input->post('field_name2[6]');
		}
//----------------------------------------------------------------
		if($this->input->post('field_name2[7]') == null){
			$web6_8 	 = "null";
		}else{
			$web6_8 	 = $this->input->post('field_name2[7]');
		}
//----------------------------------------------------------------
		if($this->input->post('field_name2[8]') == null){
			$web6_9 	 = "null";
		}else{
			$web6_9 	 = $this->input->post('field_name2[8]');
		}
//----------------------------------------------------------------
		if($this->input->post('field_name2[9]') == null){
			$web6_10 	 = "null";
		}else{
			$web6_10 	 = $this->input->post('field_name2[9]');
		}
//----------------------------------------------------------------
//----------------------------------------------------------------
//----------------------------------------------------------------


		$data = array(
			'web_block' => array(
							isset($on_off1) ? 
							array(
								'url' 	 => $web1,
								'action' =>	$action1
								) : array(
											'url' 	 => "null",
											'action' =>	"null"
											),
							isset($on_off2) ? 
							array(
								'url' 	 => $web2,
								'action' => $action2
								) : array(
											'url' 	 => "null",
											'action' =>	"null"
											),
							isset($on_off3) ? 
							array(
								'url' 	 => $web3,
								'action' => $action3
								) : array(
											'url' 	 => "null",
											'action' =>	"null"
											),
//-----------------------Start On_off4----Block site another---------------------------------
							isset($on_off4) ? 
							array(
								'url' 	 => $web4_1,
								'action' => $action4
								) : array(
											'url' 	 => "null",
											'action' =>	"null"
											),
							isset($on_off4) ? 
							array(
								'url' 	 => $web4_2,
								'action' => $action4
								) : array(
											'url' 	 => "null",
											'action' =>	"null"
											),
							isset($on_off4) ? 
							array(
								'url' 	 => $web4_3,
								'action' => $action4
								) : array(
											'url' 	 => "null",
											'action' =>	"null"
											),
							isset($on_off4) ? 
							array(
								'url' 	 => $web4_4,
								'action' => $action4
								) : array(
											'url' 	 => "null",
											'action' =>	"null"
											),
							isset($on_off4) ? 
							array(
								'url' 	 => $web4_5,
								'action' => $action4
								) : array(
											'url' 	 => "null",
											'action' =>	"null"
											),
							isset($on_off4) ? 
							array(
								'url' 	 => $web4_6,
								'action' => $action4
								) : array(
											'url' 	 => "null",
											'action' =>	"null"
											),
							isset($on_off4) ? 
							array(
								'url' 	 => $web4_7,
								'action' => $action4
								) : array(
											'url' 	 => "null",
											'action' =>	"null"
											),
							isset($on_off4) ? 
							array(
								'url' 	 => $web4_8,
								'action' => $action4
								) : array(
											'url' 	 => "null",
											'action' =>	"null"
											),
							isset($on_off4) ? 
							array(
								'url' 	 => $web4_9,
								'action' => $action4
								) : array(
											'url' 	 => "null",
											'action' =>	"null"
											),
							isset($on_off4) ? 
							array(
								'url' 	 => $web4_10,
								'action' => $action4
								) : array(
											'url' 	 => "null",
											'action' =>	"null"
											),
//-----------------------Start On_off5----Network all---------------------------------
							isset($on_off5) ? 
							array(
								'url' 	 => $web5_1,
								'action' => $action5
								) : array(
											'url' 	 => "null",
											'action' =>	"null"
											),
							isset($on_off5) ? 
							array(
								'url' 	 => $web5_2,
								'action' => $action5
								) : array(
											'url' 	 => "null",
											'action' =>	"null"
											),
							isset($on_off5) ? 
							array(
								'url' 	 => $web5_3,
								'action' => $action5
								) : array(
											'url' 	 => "null",
											'action' =>	"null"
											),
							isset($on_off5) ? 
							array(
								'url' 	 => $web5_4,
								'action' => $action5
								) : array(
											'url' 	 => "null",
											'action' =>	"null"
											),
							isset($on_off5) ? 
							array(
								'url' 	 => $web5_5,
								'action' => $action5
								) : array(
											'url' 	 => "null",
											'action' =>	"null"
											),
							isset($on_off5) ? 
							array(
								'url' 	 => $web5_6,
								'action' => $action5
								) : array(
											'url' 	 => "null",
											'action' =>	"null"
											),
							isset($on_off5) ? 
							array(
								'url' 	 => $web5_7,
								'action' => $action5
								) : array(
											'url' 	 => "null",
											'action' =>	"null"
											),
							isset($on_off5) ? 
							array(
								'url' 	 => $web5_8,
								'action' => $action5
								) : array(
											'url' 	 => "null",
											'action' =>	"null"
											),
							isset($on_off5) ? 
							array(
								'url' 	 => $web5_9,
								'action' => $action5
								) : array(
											'url' 	 => "null",
											'action' =>	"null"
											),
							isset($on_off5) ? 
							array(
								'url' 	 => $web5_10,
								'action' => $action5
								) : array(
											'url' 	 => "null",
											'action' =>	"null"
											)
				),
//----------------------Start On_off6--------------------------------------
			'port_block' => array(
							isset($on_off6) ? 
							array(
								'port' 	 	=> $web6_1,
								'action' 	=> $action6,
								'protocal'	=> $protocal
								) : array(
											'port' 	 	=> "null",
											'action' 	=> "null",
											'protocal'	=> "null"
											),
							isset($on_off6) ? 
							array(
								'port' 	 	=> $web6_2,
								'action' 	=> $action6,
								'protocal'	=> $protocal
								) : array(
											'port' 	 	=> "null",
											'action' 	=> "null",
											'protocal'	=> "null"
											),
							isset($on_off6) ? 
							array(
								'port' 	 	=> $web6_3,
								'action' 	=> $action6,
								'protocal'	=> $protocal
								) : array(
											'port' 	 	=> "null",
											'action' 	=> "null",
											'protocal'	=> "null"
											),
							isset($on_off6) ? 
							array(
								'port' 	 	=> $web6_4,
								'action' 	=> $action6,
								'protocal'	=> $protocal
								) : array(
											'port' 	 	=> "null",
											'action' 	=> "null",
											'protocal'	=> "null"
											),
							isset($on_off6) ? 
							array(
								'port' 	 	=> $web6_5,
								'action' 	=> $action6,
								'protocal'	=> $protocal
								) : array(
											'port' 	 	=> "null",
											'action' 	=> "null",
											'protocal'	=> "null"
											),
							isset($on_off6) ? 
							array(
								'port' 	 	=> $web6_6,
								'action' 	=> $action6,
								'protocal'	=> $protocal
								) : array(
											'port' 	 	=> "null",
											'action' 	=> "null",
											'protocal'	=> "null"
											),
							isset($on_off6) ? 
							array(
								'port' 	 	=> $web6_7,
								'action' 	=> $action6,
								'protocal'	=> $protocal
								) : array(
											'port' 	 	=> "null",
											'action' 	=> "null",
											'protocal'	=> "null"
											),
							isset($on_off6) ? 
							array(
								'port' 	 	=> $web6_8,
								'action' 	=> $action6,
								'protocal'	=> $protocal
								) : array(
											'port' 	 	=> "null",
											'action' 	=> "null",
											'protocal'	=> "null"
											),
							isset($on_off6) ? 
							array(
								'port' 	 	=> $web6_9,
								'action' 	=> $action6,
								'protocal'	=> $protocal
								) : array(
											'port' 	 	=> "null",
											'action' 	=> "null",
											'protocal'	=> "null"
											),
							isset($on_off6) ? 
							array(
								'port' 	 	=> $web6_10,
								'action' 	=> $action6,
								'protocal'	=> $protocal
								) : array(
											'port' 	 	=> "null",
											'action' 	=> "null",
											'protocal'	=> "null"
											)
						)
			);
		file_put_contents('extension/file/json_block_web.json', json_encode($data));

	}

}
