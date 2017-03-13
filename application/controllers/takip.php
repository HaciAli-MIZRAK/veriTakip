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

class Takip extends Admin_Controller
{
    
    /**
     * 
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('cpanel_model');
        $data = $this->Language( $this->session->userdata('lang') );
        $this->load->view("pages/public/header_atc", $data);
        $this->load->view("pages/public/ustmenu_atc");
        /* kullanıcıya özel Koordinat için gerekenler */
        $this->load->model('profile_model');
        $data = $this->profile_model->profile_modeli( $this->session->userdata('userid') );
        if (count($data) == 0) {
            $datax['veri'] = NULL;
        } else {
            for($i = 0;$i <= count($data)-1;$i++) {
               $datax['veri'][] = $data[$i]['metavalue'];
            }
            if (count($datax['veri']) > 4){
                $this->session->set_userdata(array('latitude' => $datax['veri'][4], 'longitude' => $datax['veri'][5]));
            } else {}
        }
    } // end __construct();
    
    /**
     * 
     */
    public function index()
    {
        if($this->session->userdata('userid') == 2){
            redirect(base_url('takip/assanpages'));
        } else if($this->session->userdata('userid') == 17) {
            redirect(base_url('takip/dogakoleji'));
        } else {
            $this->load->view("pages/tracking/atcmaps_atc");
            $this->load->view("pages/tracking/footer_atc");
            $this->load->view("pages/public/footerjs_atc");
        }
    } // end index();
    
    /**
     * 
     */
    public function AddProduct()
    {
        $data['DeviceList'] = $this->DeviceList();
        $this->load->view("pages/product/product", $data);
        $this->load->view("pages/public/footerjs_atc");
        
    } // end AddProduct()
    
    public function DeviceList()
    {
        $this->load->model('cpanel_model');
        $data = array();
        $DeviceMetaList = array();
        if ($this->session->userdata('userstatus') == 6) {
            $DeviceList = $this->cpanel_model->DeviceList_model();
            for ($i = 0;$i <= count($DeviceList)-1;$i++) {
                $DeviceMetaList[] = $this->DeviceMetaList( $DeviceList[$i]->deviceid );
            }
            array_push($data, $DeviceList, $DeviceMetaList);
           return $data;
        } // end if administrator
        
        if ($this->session->userdata('userstatus') == 5) {
           $DeviceList = $this->cpanel_model->DeviceList_model( $this->session->userdata('userid') );
            for ($i = 0;$i <= count($DeviceList)-1;$i++) {
                $DeviceMetaList[] = $this->DeviceMetaList( $DeviceList[$i]->deviceid );
            }
            array_push($data, $DeviceList, $DeviceMetaList);
           return $data; 
        } // end if müşteri
        
        if ($this->session->userdata('userstatus') == 4) {
           $DeviceList = $this->cpanel_model->DeviceList_model( $this->session->userdata('userid') );
            for ($i = 0;$i <= count($DeviceList)-1;$i++) {
                $DeviceMetaList[] = $this->DeviceMetaList( $DeviceList[$i]->deviceid );
            }
            array_push($data, $DeviceList, $DeviceMetaList);
           return $data; 
        } // end if Assan Özel
        
    } // end DeviceList()
    
    public function DeviceMetaList( $deviceId = false )
    {
        $this->load->model('cpanel_model');
        if ($deviceId) {
            $data = $this->cpanel_model->DeviceMetaList_model( $deviceId );
            if ($data) {
                return $data;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    } // end DeviceMetaList( $deviceId )

    /**
     * 
     */
    public function Profile()
    {
        $datax = array();
        
        if ($this->input->post() == true) {
            $this->load->model('profile_model');
            $query['query'] = $this->profile_model->profile_modelx($this->session->userdata('userid'), $this->input->post() );
            redirect('takip/profile');
        }
        
        $this->load->model('profile_model');
        $data = $this->profile_model->profile_modeli( $this->session->userdata('userid') );
        if (count($data) == 0) {
            $datax['veri'] = NULL;
        } else {
            for($i = 0;$i <= count($data)-1;$i++) {
               $datax['veri'][] = $data[$i]['metavalue'];
            }
        }
        $this->load->view("pages/profile/profile", $datax);
        $this->load->view("pages/public/footerjs_atc"); 
        
    } // end Profile()
    
    public function Language( $Lang )
    {
        $this->lang->load('header', languageSelect( $Lang ));
        $this->lang->load('modals', languageSelect( $Lang ));
        $this->lang->load('product', languageSelect( $Lang ));
        $this->lang->load('profile', languageSelect( $Lang ));
        $this->lang->load('footer', languageSelect( $Lang ));
        $data['lang_header']    = $this->lang->line();
        $data['lang_modals']    = $this->lang->line();
        $data['lang_product']   = $this->lang->line();
        $data['lang_profile']   = $this->lang->line();
        $data['lang_footer']    = $this->lang->line();
        return $data;
    }
    
    public function DeviceClearSystem()
    {
        if ($this->input->get() == true) {
            $this->cpanel_model->DeviceClearSystem_model( $this->input->get('deviceClearId') );
            redirect($_SERVER['HTTP_REFERER']);
        }  
    } // end DeviceClearSystem()
    
    public function xMetrePages()
    {
        $this->load->model('xdata_model');
        $data['deviceId'] = $this->xdata_model->xMetreDeviceId_model();
        $this->load->view("pages/xmetre/xmetre", $data);
        $this->load->view("pages/public/footerjs_atc");
    } // end xMetrePages()
    
    public function AssanPages()
    {
        if ($this->session->userdata('userstatus') == 4) {
            $this->load->view("pages/assan/assan-panele");
            $this->load->view("pages/public/footerjs_atc");
        } else {
            redirect(base_url('takip'));
        }
    } // end AssanPages()
    
    public function AssanAreas()
    {
        if ($this->session->userdata('userstatus') == 4) {
            $this->load->view("pages/assan/assan-areas");
            $this->load->view("pages/public/footerjs_atc");
        } else {
            redirect(base_url('takip'));
        }
    }
    
    public function UludagPages()
    {
        $this->load->view("pages/uludag/uludag-panele");
        $this->load->view("pages/public/footerjs_atc");
    } // end UludagPages()
    
    public function DogaKoleji()
    {
        $this->load->view("pages/dogakoleji/doga-koleji");
        $this->load->view("pages/public/footerjs_atc");
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */