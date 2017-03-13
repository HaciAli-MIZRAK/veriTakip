<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Index Page for this controller.
*
* Maps to the following URL
* 		http://example.com/index.php/welcome
*	- or -  
* 		http://example.com/index.php/welcome/index
*	- or -
* Since this controller is set as the default controller in 
* config/routes.php, it's displayed at http://example.com/
*
* So any other public methods not prefixed with an underscore will
* map to /index.php/welcome/<method_name>
* @see http://codeigniter.com/user_guide/general/urls.html
*/

class Pages extends Public_Controller
{
    
    /**
     * 
     */
    public function __construct()
    {
        parent::__construct();
    } // end __construct();
    
    /**
     * 
     */
    public function index()
    {

        redirect(base_url('pages/login'));
 
    } // end index();
    
    public function Login()
    {
        $data = $this->Language( $this->session->userdata('lang') );
        if($this->input->post() == false) {
            $this->load->view('login/login_atc', $data);
        } else {
            $this->load->model('login_model');
            $data = $this->login_model->login_modelx( $this->input->post() );
            if($this->db->affected_rows()) {
                $SessionCreate = array(
                    'login'                => true,
                    'userid'               => $data->userid,
                    'username'             => $data->username,
                    'useremail'            => $data->useremail,
                    'userstatus'           => $data->userstatus,
                    'userregistered'       => $data->userregistered,
                );
                $this->session->set_userdata($SessionCreate);
                redirect(base_url('takip/'));
            } else {
                redirect(base_url('pages/login'));
            }
        }
    } // end Login()
    
    /**
     * 
     */
    public function logout()
    {
        
        $this->session->sess_destroy();
        redirect('pages/');
        
    } // end logout()
    
    public function LanguageLoad()
    {
        if ($this->input->get() == false) {
        } else {
            $this->session->set_userdata('lang', $this->input->get('lang')); 
            echo $this->session->userdata('lang');
            redirect(base_url('pages/login'));
        }
    }
    private function Language( $Lang )
    {
        $this->lang->load('login', languageSelect( $Lang ));
        $data['lang_login']    = $this->lang->line();
        return $data;
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */