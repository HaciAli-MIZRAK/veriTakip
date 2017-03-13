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

class cPanel extends Admin_Controller
{
    
    /**
     * 
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('cpanel_model');
    } // end __construct();
    
    /**
     * 
     */
    public function index()
    {
    } // end index();
    
    /**
     * 
     */
    public function AddDevicePlus()
    {
        if ($this->input->post() == true) {
            $query['query'] = $this->cpanel_model->adddeviceplus_model( $this->input->post() );
        }
    } // end AddDevicePlus()
    
    /**
     * 
     */
    public function DeviceControl()
    {
        $data = $this->cpanel_model->DeviceControl_model( $this->input->get('imeiId') );
        if($data == true) {
            $ImeiIdControl['imeiidcontrol'] = 'var';
        } else {
            $ImeiIdControl['imeiidcontrol'] = 'yok';
        }
        echo json_encode($ImeiIdControl);
    } // end DeviceControl()
    
    /**
     * 
     */
    public function DeviceListStatus()
    {
        if ($this->input->get() == true) {
            $ProductCheckId = explode("_", $this->input->get('productcheckid'));
            $AdminStatus = $this->input->get('adminstatus');
            $data = $this->cpanel_model->DeviceListStatus_model( $ProductCheckId[1], $AdminStatus );
            echo json_encode($data);
        }
    } // end DeviceListStatus()
    
////////////////////////////////////////////////////////////////////////////////
///////////// DOĞA KOLEJİ İÇİN HAZIRLANAN FUNCTIONLAR //////////////////////////
////////////////////////////////////////////////////////////////////////////////
    /**
     * Doğa Koleji Akıllı Sınıf Aydınlatma Sistemi için Aç Kapat function
     * Kapı Tarafını Kontrol Et
     * 100ok Açma Komutu
     * 200ok Kapatma Komutu
     * =========================================================================
     * =========================================================================
     * Dolap Tarafını Kontrol Et
     * 300ok Açma Komutu
     * 400ok Kapatma Komutu
     */
    public function SmartClassLighting()
    {
        if ($this->input->get() == true)
        {
            $Status = $this->input->get('status');
            // kapı tarafı aydınlatma aç
            if($Status == '100ok')
            {
                $data = $this->cpanel_model->SmartClass_model( $this->input->get('imeiid') );
                $array = array(
                    'Id'            => $data->id,
                    'ImeiId'        => $data->imeiid,
                    'SocketOrder'   => $data->socketorder,
                    'AtcCommand'    => '#ID;1234;11!#HX;1234;22!'
                );
                $Command = $this->cpanel_model->xAtcCommand_model( $array, $this->session->userdata('userid') );
                //$Command = true;
                if ($Command == true) {
                    $CommandStatus = array(
                        'successful' => 'ok1100' 
                    );
                } else {
                   $CommandStatus = array(
                        'successful' => 'error' // bu hata bildirimi
                    ); 
                } // end $Command == true
            } // end $Status == '100ok'
            
            // kapı tarafı aydınlatma kapat
            if($Status == '200ok')
            {
                $data = $this->cpanel_model->SmartClass_model( $this->input->get('imeiid') );
                $array = array(
                    'Id'            => $data->id,
                    'ImeiId'        => $data->imeiid,
                    'SocketOrder'   => $data->socketorder,
                    'AtcCommand'    => '#ID;1234;10!#HX;1234;22!'
                );
                $Command = $this->cpanel_model->xAtcCommand_model( $array, $this->session->userdata('userid') );
                //$Command = true;
                if ($Command == true) {
                    $CommandStatus = array(
                        'successful' => 'ok1200' 
                    );
                } else {
                   $CommandStatus = array(
                        'successful' => 'error' // bu hata bildirimi
                    ); 
                } // end $Command == true
            } // end $Status == '200ok'
            
            // Dolap Tarafı Aydınlatma Aç
            if($Status == '300ok')
            {
                $data = $this->cpanel_model->SmartClass_model( $this->input->get('imeiid') );
                $array = array(
                    'Id'            => $data->id,
                    'ImeiId'        => $data->imeiid,
                    'SocketOrder'   => $data->socketorder,
                    'AtcCommand'    => '#ID;1234;44!#HX;1234;22!'
                );
                $Command = $this->cpanel_model->xAtcCommand_model( $array, $this->session->userdata('userid') );
                //$Command = true;
                if ($Command == true) {
                    $CommandStatus = array(
                        'successful' => 'ok1300' 
                    );
                } else {
                   $CommandStatus = array(
                        'successful' => 'error' // bu hata bildirimi
                    ); 
                } // end $Command == true
            } // end $Status == '300ok'
            
            // Dolap tarafı aydınlatma kapat
            if($Status == '400ok')
            {
                $data = $this->cpanel_model->SmartClass_model( $this->input->get('imeiid') );
                $array = array(
                    'Id'            => $data->id,
                    'ImeiId'        => $data->imeiid,
                    'SocketOrder'   => $data->socketorder,
                    'AtcCommand'    => '#ID;1234;40!#HX;1234;22!'
                );
                $Command = $this->cpanel_model->xAtcCommand_model( $array, $this->session->userdata('userid') );
                //$Command = true;
                if ($Command == true) {
                    $CommandStatus = array(
                        'successful' => 'ok1400' 
                    );
                } else {
                   $CommandStatus = array(
                        'successful' => 'error' // bu hata bildirimi
                    ); 
                } // end $Command == true
            } // end $Status == '400ok'
            
        } // end $this->input->get() == true
        echo json_encode($CommandStatus);
    } // end SmartClassLighting()
    
    /**
     * Doğa Koleji Akıllı Sınıf Perdeler Sistemi için Aç Kapat function
     * 500ok Yukarı Komutu
     * 600ok Durdurma Komutu
     * =========================================================================
     * =========================================================================
     * 700ok Aşağı Komutu
     * 800ok Durdurma Komutu
     */
    public function SmartClassCurtain()
    {
        if ($this->input->get() == true)
        {
            $Status = $this->input->get('status');
            /* Perde Kontrol Yukarı Açmak için */
            if($Status == '500ok')
            {
                $data = $this->cpanel_model->SmartClass_model( $this->input->get('imeiid') );
                $array = array(
                    'Id'            => $data->id,
                    'ImeiId'        => $data->imeiid,
                    'SocketOrder'   => $data->socketorder,
                    'AtcCommand'    => '#ID;1234;44!#HX;1234;22!'
                );
                $Command = $this->cpanel_model->xAtcCommand_model( $array, $this->session->userdata('userid') );
                if ($Command == true) {
                    $CommandStatus = array(
                        'successful' => 'ok1500' 
                    );
                } else {
                   $CommandStatus = array(
                        'successful' => 'error' // bu hata bildirimi
                    ); 
                } // end $Command == true
            } // end $Status == '500ok'
            
            /* Perde Kontrol Durdurmak için */
            if($Status == '600ok')
            {
                $data = $this->cpanel_model->SmartClass_model( $this->input->get('imeiid') );
                $array = array(
                    'Id'            => $data->id,
                    'ImeiId'        => $data->imeiid,
                    'SocketOrder'   => $data->socketorder,
                    'AtcCommand'    => '#ID;1234;F0!#HX;1234;22!'
                );
                $Command = $this->cpanel_model->xAtcCommand_model( $array, $this->session->userdata('userid') );
                if ($Command == true) {
                    $CommandStatus = array(
                        'successful' => 'ok1600' 
                    );
                } else {
                   $CommandStatus = array(
                        'successful' => 'error' // bu hata bildirimi
                    ); 
                } // end $Command == true
            } // end $Status == '600ok'
            
            /* Perde Kontrol Aşağı İndirmek için */
            if($Status == '700ok')
            {
                $data = $this->cpanel_model->SmartClass_model( $this->input->get('imeiid') );
                $array = array(
                    'Id'            => $data->id,
                    'ImeiId'        => $data->imeiid,
                    'SocketOrder'   => $data->socketorder,
                    'AtcCommand'    => '#ID;1234;11!#HX;1234;22!'
                );
                $Command = $this->cpanel_model->xAtcCommand_model( $array, $this->session->userdata('userid') );
                if ($Command == true) {
                    $CommandStatus = array(
                        'successful' => 'ok1700' 
                    );
                } else {
                   $CommandStatus = array(
                        'successful' => 'error' // bu hata bildirimi
                    ); 
                } // end $Command == true
            } // end $Status == '700ok'
            
            /* Perde Kontrol Durdurmak için */
            if($Status == '800ok')
            {
                $data = $this->cpanel_model->SmartClass_model( $this->input->get('imeiid') );
                $array = array(
                    'Id'            => $data->id,
                    'ImeiId'        => $data->imeiid,
                    'SocketOrder'   => $data->socketorder,
                    'AtcCommand'    => '#ID;1234;F0!#HX;1234;22!'
                );
                $Command = $this->cpanel_model->xAtcCommand_model( $array, $this->session->userdata('userid') );
                if ($Command == true) {
                    $CommandStatus = array(
                        'successful' => 'ok1800' 
                    );
                } else {
                   $CommandStatus = array(
                        'successful' => 'error' // bu hata bildirimi
                    ); 
                } // end $Command == true
            } // end $Status == '800ok'
            
        } // end $this->input->get() == true
        echo json_encode($CommandStatus);
    } // end SmartClassCurtain()
    
    /**
     * Doğa Koleji Akıllı Sınıf Perdeler Sistemi için Aç Kapat function
     * 900ok Açma Komutu
     * 1000ok Kapatma Komutu
     */
    public function SmartClassAirConditioning()
    {
        if ($this->input->get() == true)
        {
            $Status = $this->input->get('status');
            if($Status == '900ok')
            {
                $data = $this->cpanel_model->SmartClass_model( $this->input->get('imeiid') );
                $array = array(
                    'Id'            => $data->id,
                    'ImeiId'        => $data->imeiid,
                    'SocketOrder'   => $data->socketorder,
                    'AtcCommand'    => '#ID;1234;11!#HX;1234;22!'
                );
                $Command = $this->cpanel_model->xAtcCommand_model( $array, $this->session->userdata('userid') );
                if ($Command == true) {
                    $CommandStatus = array(
                        'successful' => 'ok1900' 
                    );
                } else {
                   $CommandStatus = array(
                        'successful' => 'error' // bu hata bildirimi
                    ); 
                } // end $Command == true
            } // end $Status == '500ok'
            
            if($Status == '1000ok')
            {
                $data = $this->cpanel_model->SmartClass_model( $this->input->get('imeiid') );
                $array = array(
                    'Id'            => $data->id,
                    'ImeiId'        => $data->imeiid,
                    'SocketOrder'   => $data->socketorder,
                    'AtcCommand'    => '#ID;1234;F0!#HX;1234;22!'
                );
                $Command = $this->cpanel_model->xAtcCommand_model( $array, $this->session->userdata('userid') );
                if ($Command == true) {
                    $CommandStatus = array(
                        'successful' => 'ok11000' 
                    );
                } else {
                   $CommandStatus = array(
                        'successful' => 'error' // bu hata bildirimi
                    ); 
                } // end $Command == true
            } // end $Status == '600ok'
            
        } // end $this->input->get() == true
        echo json_encode($CommandStatus);
    } // end SmartClassAirConditioning()
    
    /**
     * Doğa Koleji Akıllı Bahçe Sulama Sistemi için Aç Kapat function
     * 700ok Açma Komutu
     * 800ok Kapatma Komutu
     */
    public function SmartClassIrrigation()
    {
        if ($this->input->get() == true)
        {
            $Status = $this->input->get('status');
            if($Status == '700ok')
            {
                $data = $this->cpanel_model->SmartClass_model( $this->input->get('imeiid') );
                $array = array(
                    'Id'            => $data->id,
                    'ImeiId'        => $data->imeiid,
                    'SocketOrder'   => $data->socketorder,
                    'AtcCommand'    => '#ID;1234;11!'
                );
                $Command = $this->cpanel_model->xAtcCommand_model( $array, $this->session->userdata('userid') );
                if ($Command == true) {
                    $CommandStatus = array(
                        'successful' => 'ok1700' 
                    );
                } else {
                   $CommandStatus = array(
                        'successful' => 'error' // bu hata bildirimi
                    ); 
                } // end $Command == true
            } // end $Status == '700ok'
            
            if($Status == '800ok')
            {
                $data = $this->cpanel_model->SmartClass_model( $this->input->get('imeiid') );
                $array = array(
                    'Id'            => $data->id,
                    'ImeiId'        => $data->imeiid,
                    'SocketOrder'   => $data->socketorder,
                    'AtcCommand'    => '#ID;1234;10!'
                );
                $Command = $this->cpanel_model->xAtcCommand_model( $array, $this->session->userdata('userid') );
                if ($Command == true) {
                    $CommandStatus = array(
                        'successful' => 'ok1800' 
                    );
                } else {
                   $CommandStatus = array(
                        'successful' => 'error' // bu hata bildirimi
                    ); 
                } // end $Command == true
            } // end $Status == '800ok'
            
        } // end $this->input->get() == true
        echo json_encode($CommandStatus);
    } // end SmartClassIrrigation()

////////////////////////////////////////////////////////////////////////////////
/////////////////////// STANDART MOTOR BLOKAJ KOMUT FUNCTION ///////////////////
////////////////////////////////////////////////////////////////////////////////    
    /**
     * 
     */
    public function SuddenBlockageEngine()
    {
        if ($this->input->get() == true)
        {
            $Status = $this->input->get('status');
            if($Status == '200ok')
            {
                $data = $this->cpanel_model->SuddenBlockageEngine_model( $this->input->get('imeiid') );
                $array = array(
                    'Id'            => $data->id,
                    'ImeiId'        => $data->imeiid,
                    'SocketOrder'   => $data->socketorder,
                    'AtcCommand'    => '#ID;1234;88!'
                );
                $Command = $this->cpanel_model->xAtcCommand_model( $array, $this->session->userdata('userid') );
                if ($Command == true) {
                    $CommandStatus = array(
                        'successful' => 'ok700' 
                    );
                } else {
                   $CommandStatus = array(
                        'successful' => 'ok100' 
                    ); 
                }
            }
            if($Status == '600ok')
            {
                $data = $this->cpanel_model->SuddenBlockageEngine_model( $this->input->get('imeiid') );
                $array = array(
                    'Id'            => $data->id,
                    'ImeiId'        => $data->imeiid,
                    'SocketOrder'   => $data->socketorder,
                    'AtcCommand'    => '#ID;1234;80!'
                );
                $Command = $this->cpanel_model->xAtcCommand_model( $array, $this->session->userdata('userid') );
                if ($Command == true) {
                    $CommandStatus = array(
                        'successful' => 'ok800' 
                    );
                } else {
                   $CommandStatus = array(
                        'successful' => 'ok300' 
                    ); 
                }
            }
        }
        echo json_encode($CommandStatus);
    } // end SuddenBlockageEngine()

////////////////////////////////////////////////////////////////////////////////
//////////////////// M70A İÇİN FOTOĞRAF ÇEKME KOMUT FUNCTION ///////////////////
////////////////////////////////////////////////////////////////////////////////
    
    /**
     * 
     */
    public function FotografCheck()
    {
        if ($this->input->get() == true) {
            $Status = $this->input->get('status');
            $CamNo = $this->input->get('camno');
            if($Status == '200ok'){
                $data = $this->cpanel_model->FotografCheck_modal( $this->input->get('imeiid') );
                for($i = 0;$i < count($data);$i++) {
                    $array = array(
                        'Id'            => $data[$i]->id,
                        'ImeiId'        => $data[$i]->imeiid,
                        'SocketOrder'   => $data[$i]->socketorder,
                        'AtcCommand'    => '#DW;1234;C2;' .  substr($CamNo, 3, 1) . '!'
                    );
                }
                $Command = $this->cpanel_model->xAtcCommand_model( $array, $this->session->userdata('userid') );
                if ($Command == true) {
                    $CommandStatus = array(
                        'successful' => 'ok700' 
                    );
                } else {
                   $CommandStatus = array(
                        'successful' => 'ok100' 
                    ); 
                }
            }
        }
        echo json_encode($CommandStatus);
    } // end FotografCheck()

////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
    
    /**
     * 
     */
    public function DeviceCMDSend()
    {
        if ($_GET) {
            $data = $this->cpanel_model->xAtcDeviceCommand_model( $this->input->get('imeiid') );
            if($data[0]->socketorder == '-1') {
                $array = array(
                    'error' => 'Cihaz Bağlı Değil'
                );
            } else {
                for($i = 0;$i < count($data);$i++) {
                    $array = array(
                        'ImeiId'        => $data[$i]->imeiid,
                        'SocketOrder'   => $data[$i]->socketorder,
                        'AtcCommand'    => str_replace('devicecmdsend=', '', $this->input->get('cmdSend'))
                    ); 
                }
                $Command = $this->cpanel_model->xAtcCommand_model( $array, $this->session->userdata('userid') );
            }
            echo json_encode($array); 
        }
        
    } // end DeviceCMDSend()
    
    /**
     * 
     */
    public function AccessorySave()
    {
        $AccessoryArray = array(
            '_imeiid'   => $this->input->get('_imeiid'),
            '_top'      => $this->input->get('_top'),
            '_left'     => $this->input->get('_left'),
        );
        $this->cpanel_model->AccessorySave( $AccessoryArray );
    } // end AccessorySave()
    
}
