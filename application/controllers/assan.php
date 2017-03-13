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

class Assan extends xData
{
    /**
     * 
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('assan_model');
    } // end __construct()
    
    /**
     * 
     */
    public function index()
    {
        
    } // end index()
    
    /**
     * Bu alan Geçici yapıldı düzenlenecek
     */
    public function AlarmInfoMail()
    {
        //print_r($this->input->post());
        $this->email->from('info@marmaranet.net', 'Haci Ali MIZRAK');   
        $this->email->to('mizraklar@hotmail.com');   
        $this->email->subject('mail basligi');   
        $this->email->message('mail icerigimiz buraya');   
        $this->email->send();
        echo $this->email->print_debugger();
    } // end AlarmInfoMail()
    
    
    /**
     * 
     */
    public function AssanPanelBluetooth()
    {
        if ($this->session->userdata('userstatus') == 4 || $this->session->userdata('userstatus') == 6) {
            $IMEIIdx = $this->cpanel_model->AccessoryDeviceImeiId_model( 'Bluetooth' );
            for($i = 0;$i < count($IMEIIdx);$i++){
                $SensorData = $this->xdata_model->AccessoryxSensor_model( $IMEIIdx[$i] );
                $data['imeiid'][] = "imeiid " . $SensorData->imeiid;
                $data['DataxId'][]  = $SensorData->id;
                $data['accessory'][] = $this->xdata_model->Accessory_model( $IMEIIdx[$i] );
            }
            echo json_encode($data);
        }
    } // end AssanPanelBluetooth()
    
    /**
     * 
     */
    public function AssanPanelBluetoothData()
    {
        if ($this->session->userdata('userstatus') == 4 || $this->session->userdata('userstatus') == 6) {
            $IMEIId = $this->cpanel_model->AccessoryDeviceImeiId_model( 'Bluetooth' );
            if($_GET) {
                $LastDataId = $this->input->get('lastdataid');
                $AssanImeiId = $this->input->get('assanimeiid');
                $SensorData = $this->xdata_model->AccessoryxSensorData_model( $LastDataId, $AssanImeiId );
                if($this->db->affected_rows()) {
                    for ($i = 0;$i < count($SensorData);$i++) {
                        $data['xSensorData'][] = array(
                            'xSensorData' => $this->autosensor->AutoSensorControl( $SensorData[$i]->sensordata ),
                            'imeiid'    => "imeiid " . $SensorData[$i]->imeiid,
                            'DataxId'   => $SensorData[$i]->id,
                        );
                    }
                } else {
                    $data['hata'] = 'undefined';
                }
                echo json_encode($data);
            }
        }
    } // end AssanPanelBluetoothData()
    
////////////////////////////////////////////////////////////////////////////////
//////////// KAPILAR İÇİN GEÇİCİ ALAN HAZIRLANIYOR /////////////////////////////
////////////////////////////////////////////////////////////////////////////////
    /**
     * Depo dibi Yangın ve Geçiş Kapıları
     */
    public function AssanPanelDoor01()
    {
        $data = $this->assan_model->AssanAreas_model( '86107402543441975' );
        $ArrayDizi = array(
            'doorAlarm' => $this->xStatus( $data->status ) 
        );
        echo json_encode($ArrayDizi);
    } // end AssanPanelDoor01()
    
    /**
     * Bilgi işlem alanında bulunan kapı ve sensörler
     */
    public function AssanPanelDoor02()
    {
        $data = $this->assan_model->AssanAreas_model( '86107402992669175' );
        $ArrayDizi = array(
            'doorAlarm' => $this->xStatus( $data->status ),
        );
        echo json_encode($ArrayDizi);
    } // end AssanPanelDoor02()
    
    /**
     * 
     */
    public function AssanPanelDoor03()
    {
        $data = $this->assan_model->AssanAreas_model( '86573302587606112' );
        $ArrayDizi = array(
            'doorAlarm' => $this->xStatus( $data->status ) 
        );
        echo json_encode($ArrayDizi);
    } // end AssanPanelDoor03()
    
    /**
     * 
     */
    public function AssanPanelDoor04()
    {
        $data = $this->assan_model->AssanAreas_model( '86107402998333875' );
        $ArrayDizi = array(
            'doorAlarm' => $this->xStatus( $data->status ) 
        );
        echo json_encode($ArrayDizi);
    } // end AssanPanelDoor04()
    
    /**
     * 
     */
    public function AssanPanelDoor05()
    {
        $data = $this->assan_model->AssanAreas_model( '86573302591037312' );
        $ArrayDizi = array(
            'doorAlarm' => $this->xStatus( $data->status ) 
        );
        echo json_encode($ArrayDizi);
    } // end AssanPanelDoor05()
    
    /**
     * 
     */
    public function AssanPanelDoor06()
    {
        $data = $this->assan_model->AssanAreas_model( '86107402998217375' );
        $ArrayDizi = array(
            'doorAlarm' => $this->xStatus( $data->status ) 
        );
        echo json_encode($ArrayDizi);
    } // end AssanPanelDoor06()
    
    /**
     * Assan Üretim Sevkiyat Ana Kapı Yanı Acil Çıkış
     */
    public function AssanPanelDoor07()
    {
        $data = $this->assan_model->AssanAreas_model( '86107402995463675' );
        $ArrayDizi = array(
            'doorAlarm' => $this->xStatus( $data->status ) 
        );
        echo json_encode($ArrayDizi);
    } // end AssanPanelDoor07()

////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
    
    /**
     * Assan Bölgeler Ankara Depo içinde Bulunan Ürünler
     * Bu Cihazda Beacon, Panik Butonu, Manyetik Kapı Swicth
     */
    public function AssanAreaAnkara_InStore01()
    {
        $data = $this->assan_model->AssanAreas_model( '86107402881229880' );
        $ArrayDizi = array(
            'doorAlarm' => $this->xStatus( $data->status )
            //'doorAlarm' => ["0","0","1","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0"]
        );
        echo json_encode($ArrayDizi);
    } // end AssanAreaAnkara_InStore01()
    
    /**
     * Assan Bölgeler Ankara Depo içinde Bulunan Ürünler
     * Bu Cihazda Su Baskını, Pır Dedektör, Duman Dedektör
     */
    public function AssanAreaAnkara_InStore02()
    {
        $data = $this->assan_model->AssanAreas_model( '86107402994533775' );
        $ArrayDizi = array(
            'doorAlarm' => $this->xStatus( $data->status ) 
            //'doorAlarm' => ["0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","1","0","0","0","0","0","0"]
        );
        echo json_encode($ArrayDizi);
    } // end AssanAreaAnkara_InStore02()
    
    /**
     * Assan Bölgeler Mersin Depo içinde Bulunan Ürünler
     * Bu Cihazda Kapı ve Panik Butonu
     */
    public function AssanAreaMersin_InStore01()
    {
        $data = $this->assan_model->AssanAreas_model( '86107402881510180' );
        $ArrayDizi = array(
            'doorAlarm' => $this->xStatus( $data->status ) 
            //'doorAlarm' => ["0","0","1","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","1","0","0","0","0","0","0"]
        );
        echo json_encode($ArrayDizi);
    } // end AssanAreaMersin_InStore01()
    
    /**
     * Assan Bölgeler Mersin Depo içinde Bulunan Ürünler
     * Bu Cihazda Su Baskını 1x, Pır Dedektör 2x, Duman Dedektör 2x 
     */
    public function AssanAreaMersin_InStore02()
    {
        $data = $this->assan_model->AssanAreas_model( '86107402994305075' );
        $ArrayDizi = array(
            'doorAlarm' => $this->xStatus( $data->status ) 
            //'doorAlarm' => ["0","1","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","0","1","0","0","0","0","0","0"]
        );
        echo json_encode($ArrayDizi);
    } // end AssanAreaMersin_InStore02()

    /**
     * Assan Bölgeler Denizli Depo içinde Bulunan Ürünler
     * Bu Cihazda Kapı ve Panik Butonu
     */
    public function AssanAreaIzmir_InStore01()
    {
        $data = $this->assan_model->AssanAreas_model( '86107402881510180' );
        $ArrayDizi = array(
            'doorAlarm' => $this->xStatus( $data->status ) 
        );
        echo json_encode($ArrayDizi);
    } // end AssanAreaIzmir_InStore01()
    
    /**
     * Assan Bölgeler Denizli Depo içinde Bulunan Ürünler
     * Bu Cihazda Su Baskını 1x, Pır Dedektör 2x, Duman Dedektör 2x 
     */
    public function AssanAreaIzmir_InStore02()
    {
        $data = $this->assan_model->AssanAreas_model( '86107402994356375' );
        $ArrayDizi = array(
            'doorAlarm' => $this->xStatus( $data->status ) 
        );
        echo json_encode($ArrayDizi);
    } // end AssanAreaIzmir_InStore02()
    
    
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
    /**
     * Depo dibi Darbe Sensörleri
     */
    public function AssanPanelBrunt()
    {
        $data = $this->assan_model->AssanAreas_model( $this->input->get('imeiid'), $this->input->get('lastdataid') );
        if($this->db->affected_rows()) {
            $ArrayDizi = array(
                'Brunt'     => $data->sensordata,
                'xDataId'   => $data->id
            );
        } else {
            $ArrayDizi = array(
                'error' => 'Yeni veri yok'
            );
        }
        echo json_encode($ArrayDizi);
    } // end AssanPanelBrunt()
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    /**
     * 
     */
    public function AssanDoorePanele()
    {
        $data = $this->assan_model->AssanAreas_model( '86107402994305075' );
        $ArrayDizi = array(
            'Kapilar' => $this->xStatus( $data[0]->status ) 
        );
        echo json_encode($ArrayDizi);
    }
}
