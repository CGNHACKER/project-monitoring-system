<?php
class Check_login extends CI_Model {
        public $title;
        public $content;
        public $date;

        public function __construct()
        {
                parent::__construct();
        }



        public function index()
        {
            $id       = $this->input->post('username');
            $password = $this->input->post('password');

                        
                    $query = $this->db->query("select * from user where user_username = '$id' AND user_password ='$password'");

            $result = $query->result();

            if($query->num_rows() > 0){

                $sessiondata = array(
                    'user_id'        => $result[0]->user_id,
                    'user_firstname' => $result[0]->user_firstname,
                    'user_lastname'  => $result[0]->user_lastname,
                    'user_username'  => $result[0]->user_username,
                    'user_password'  => $result[0]->user_password,
                    'user_position'  => $result[0]->user_position
              );
              $this->session->set_userdata($sessiondata);
                redirect('dashboard_control/show_on_off', 'refresh');
                exit();

            }else{
                  echo '<script type="text/javascript">';
                  echo 'alert("Username or Password incorrect");';
                  echo '</script>';
              redirect('control/login_material',"refresh");
              // exit();
            }     
     }
   }
?>