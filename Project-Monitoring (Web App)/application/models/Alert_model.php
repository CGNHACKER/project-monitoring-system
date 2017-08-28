<?php
class Alert_model extends CI_Model {

        /*public $title;
        public $content;
        public $date;*/

        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
        }

        public function alert_model()
        {
                $query = $this->db->query ('select * from log_data order by log_time DESC');   
                return $query->result_array();            
        }

        public function ip_address()
        {
                $query1 = $this->db->query ('select * from computer_agent');   
                return $query1->result_array();            
        }
        
        
     }
?>