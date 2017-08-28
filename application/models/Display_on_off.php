<?php
class Display_on_off extends CI_Model {

        public $title;
        public $content;
        public $date;

        public function __construct()
        {
                parent::__construct();
        }
        public function show_status_agent()
        {



            $query = $this->db->query('Select agent_ip from computer_agent'); 

            
            return $query->result_array();
        }
        
     }
?>
<!-- ('select * from computer_agent c,log_data l where l.agent_ip=c.agent_ip AND c.agent_ip = (select distinct agent_ip from log_data where c.agent_ip=l.agent_ip order by log_time desc) order by agent_timestamp desc');  -->
