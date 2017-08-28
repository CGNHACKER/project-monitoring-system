<?php
class Query_time extends CI_Model {

        public $title;
        public $content;
        public $date;

        public function __construct()
        {
                parent::__construct();
        }



        public function index()
        {


                        
            $query = $this->db->query ('select * 
                                                from computer_data 
                                                where date(data_time)<=date_add(curdate(),interval -30 MINUTE)');   
                return $query->result_array(); 
          //redirect("controllerbase/add_article","refresh");
            //exit();

        }
        
     }
?>