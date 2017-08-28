<?php
class Insert_process extends CI_Model {

        public $title;
        public $content;
        public $date;

        public function __construct()
        {
                parent::__construct();
        }



        public function index()
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
        public function show_process_0()
        {
            $query = $this->db->query('Select * from manage_process where process_status = "0"'); 
            return $query->result_array();
        }
        public function show_process_1()
        {
            $query1 = $this->db->query('Select * from manage_process where process_status = "1"'); 
            return $query1->result_array();
        }
        public function ip_to_activate()
        {
            $query2 = $this->db->query('Select agent_ip,agent_status from computer_agent'); 
            return $query2->result_array();
        }
        
     }
?>