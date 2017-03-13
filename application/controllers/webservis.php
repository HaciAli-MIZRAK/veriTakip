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

class webServis extends xData
{
    
    public function __construct()
    {
        parent::__construct();
        $Parametre = array();
        $this->load->library('AutoSensor', $Parametre);
        $this->load->model('cpanel_model');
        $this->load->model('xdata_model');
        ini_set('memory_limit', "256M");
    } // end __construct()
    
    public function index()
    {
    } // end index()
    
    public function EndLokasyon()
    {
        if ($this->session->userdata('userstatus') == 6) {
            if($this->input->get('API_KEY') == '714306f22ccf1c42c0f38b17fa1daae9cb594601') {
                $IMEIIdx = $this->cpanel_model->DeviceImeiId_model();
                for($i = 0;$i < count($IMEIIdx);$i++){
                    $data['ozellikler'][]['geometry'] = array(
                        'coordinates' => $this->MultiCoordinate($IMEIIdx[$i], '2'),
                        'cihazId'     => "IMEI". $IMEIIdx[$i],
                        'plaka'       => $this->cpanel_model->DeviceMetaList_model('', $IMEIIdx[$i])[4]->metavalue,
                    );
                }
                if (empty($IMEIIdx)) {
                    $data['ozellikler'] = "";
                    echo json_encode($data, JSON_NUMERIC_CHECK);
                }else {
                    echo json_encode($data, JSON_NUMERIC_CHECK);
                }
            } else {
                $data['API_KEY'] = "Api Geçersiz";
                echo json_encode($data, JSON_NUMERIC_CHECK);
            }
        } // end userstatus == 6
        
        if ($this->session->userdata('userstatus') == 5 || $this->session->userdata('userstatus') == 4) {
            if($this->input->get('API_KEY') == '714306f22ccf1c42c0f38b17fa1daae9cb594601') {
                $IMEIIdx = $this->cpanel_model->DeviceImeiId_model( $this->session->userdata('userid') );
                for($i = 0;$i < count($IMEIIdx);$i++){
                    $data['ozellikler'][]['geometry'] = array(
                        'coordinates' => $this->MultiCoordinate( $IMEIIdx[$i], 2 ),
                        'cihazId'     => "IMEI" . $IMEIIdx[$i],
                        'plaka'       => $this->cpanel_model->DeviceMetaList_model('', $IMEIIdx[$i])[4]->metavalue
                    );
                }
                if (empty($IMEIIdx)) {
                    $data['ozellikler'] = "";
                    echo json_encode($data, JSON_NUMERIC_CHECK);
                }else {
                    echo json_encode($data, JSON_NUMERIC_CHECK);
                }
            } else {
                $data['API_KEY'] = "Api Geçersiz";
                echo json_encode($data, JSON_NUMERIC_CHECK);
            }
        } // end userstatus == 5
    } // end EndLokasyon()
    
    public function MultiCoordinate( $IMEIId = 0, $Limit = 2 )
    {
        $data = $this->xdata_model->xGeneral_model($IMEIId, $Limit); 
        /* GSM Lokasyon verileri */
        $LBSData = $this->autosensor->AutoSensorControl( $data[0]->sensordata );
        if(isset($LBSData['Sensor13']))
        {
            $GSMLAT = $LBSData['Sensor13']['GSMLokasyon']['gsmlat'];
            $GSMLNG = $LBSData['Sensor13']['GSMLokasyon']['gsmlng']; 
        } else {
            $GSMLAT = 0;
            $GSMLNG = 0;
        }       
        for($i = 0;$i < count($data);$i++){
            $MultiCoordinat[] = array(
                //$this->xLatitude($data[$i]->latitude),
                //$this->xLongitude($data[$i]->longitude)
                $this->xLatitude($data[$i]->latitude) == 0 ? $GSMLAT : $this->xLatitude($data[$i]->latitude),
                $this->xLongitude($data[$i]->longitude) == 0 ? $GSMLNG : $this->xLongitude($data[$i]->longitude),
            );
        }
        return array_reverse($MultiCoordinat);
    } // end MultiCoordinat()
    
    public function xAktiveData()
    {
        if($this->input->get() == true) {
            $IMEIId = $this->input->get( 'imeiid' );
            $data = $this->xdata_model->xAktiveData_model( $IMEIId );
            $data2 = $this->xdata_model->xHardwarex_model( $IMEIId );
            /* GSM Lokasyon verileri */
            $LBSData = $this->autosensor->AutoSensorControl( $data[0]->sensordata );
            if(isset($LBSData['Sensor13']))
            {
                $GSMLAT = $LBSData['Sensor13']['GSMLokasyon']['gsmlat'];
                $GSMLNG = $LBSData['Sensor13']['GSMLokasyon']['gsmlng'];
            } else {
                $GSMLAT = 0;
                $GSMLNG = 0;
            }
            if(isset($LBSData['Sensor12']))
            {
                if(isset($LBSData['Sensor12']['Sensor12']))
                {
                    $Sensor12 = 'not';
                } else {
                    $xSensor12 = $LBSData['Sensor12'];
                    $Sensor12 = 'ok';
                }
            } else {
                $Sensor12 = 'not';
            }
            
            $datax['AktiveData'] = array(
                'coordinate' => array(
                    $this->xLatitude($data[0]->latitude) == 0 ? $GSMLAT : $this->xLatitude($data[0]->latitude),
                    $this->xLongitude($data[0]->longitude) == 0 ? $GSMLNG : $this->xLongitude($data[0]->longitude)
                ),
                'Ignition'  => $this->xStatus( $data[0]->status ),
                'Hardware'  => $this->xHardware(substr($data2[0]->accessory, 0, -1)),
                'Speed'     => $data[0]->speed,
                'LastId'    => $data[0]->id,
                'Distance'  => $data[0]->distance,
                'Sensor12'  => $Sensor12,
                'xSensor12' => !isset($xSensor12) ? '0' : $xSensor12,
                'Plaka'     => $this->cpanel_model->DeviceMetaList_model('', $IMEIId)[4]->metavalue,
                'imeiId'    => "IMEI" . $IMEIId
            );
            echo json_encode($datax, JSON_NUMERIC_CHECK);
        } else {
            $datax['AktiveData'] = "Henüz Seçim Yapılmamış";
            echo json_encode($datax, JSON_NUMERIC_CHECK);  
        }
    } // end xAktiveData()
    
    /**
     * 
     */
    public function xSensorData()
    {
        $IMEIId = $this->input->get( 'imeiid' );
        $SensorData = $this->xdata_model->xSensorData_model( $IMEIId, '1' );
        for ($i = 0;$i < count($SensorData);$i++) {
            $data['xSensorData'] = $this->autosensor->AutoSensorControl( $SensorData[$i]->sensordata ); 
        }
        echo json_encode($data, JSON_NUMERIC_CHECK);
        //echo json_encode($data);
    } // end xSensorData()
    
    public function xRawData()
    {
        if($_GET) {
            $IMEIId = $this->input->get( 'imeiid' );
            $xRawDataId = $this->input->get( 'xrawdataid' );
            $xRawData = $this->xdata_model->xRawData_model( $IMEIId, $xRawDataId, '1' );
            if($this->db->affected_rows()) {
                for ($i = 0;$i < count($xRawData);$i++) {
                    $data['xRawData'] = $xRawData[$i]->rawdata;
                    $data['xRawDataId'] = $xRawData[$i]->id;
                }
            } else {
                $data['hata'] = 'yeni veri yok';
            }
            echo json_encode($data, JSON_NUMERIC_CHECK);
        } // end if end $_GET
    } // end xRawData()
    
    public function xatcPhotoModal()
    {
        /* ftpde bulunan fotoğrfaları yüklemek için */
        $this->atcPhotoFTP();
        
        $IMEIId = $this->input->get( 'imeiid' );
        $photo = $this->cpanel_model->atcPhotoModal_model( $IMEIId );
        echo json_encode($photo);
    } // end xatcPhotoModal()
    
    /**
     * 
     */
    private function atcPhotoFTP()
    {
        //$hostName   = 'localhost'; // dinamik yapılacak hosting
        $hostName   = '94.138.220.146'; // dinamik yapılacak localhost
        $userName   = 'ekolfoto'; // dinamik yapılacak
        $passWord   = 'wGj31)k2'; // dinamik yapılacak
        $port       = 21; // dinamik yapılacak
        $FtpConnect = ftp_connect($hostName) or die('hata');
        if (ftp_login($FtpConnect,$userName,$passWord)) {
            $Contents = ftp_nlist($FtpConnect, '.');
            sort($Contents);
            foreach ($Contents as $PhotoFiles) {
                $photo = explode('_', $PhotoFiles);
                $photox = explode('.', $photo[2]);
                $data = $this->cpanel_model->atcPhotoFTP_model( $photo[0], $PhotoFiles, $photox[0] );
                if ($data == true) {
                    //echo "Başarılı";    
                } else {
                    //echo "başarısız";
                }
            }
        } else {
            //return 'hata mesajı gelecek';
        }
    } // end atcPhotoFTP()
    
    public function xDeviceControl()
    {
        if($_GET) {
            $data = $this->xdata_model->xDeviceControl_model( $this->input->get( 'imeiid' ) );
            if($data == true) {
                for($i = 0;$i < count($data);$i++){
                    $LastTime   = strtotime($data[$i]->serverdate);
                    $NowTime    = time();
                    $subTime    = ($NowTime - $LastTime);
                    $yard       = round(($subTime/(60*60*24*365)), 1);
                    $day        = ($subTime/(60*60*24))%365;
                    $hour       = ($subTime/(60*60))%24;
                    $minute     = ($subTime/60)%60;
                    $DeviceControl = array(
                        'DeviceControl' => "Cihazdan " . $day . ' Gün ' . $hour . ' Saat ' . $minute . ' Dakika dır Haber alınamıyor.',
                        'ButtonStatus' => 'buttondeActive'
                    );
                }
                if (DeviceControl( $day, $hour, $minute )) {
                    $jsonveri = array(
                        'DeviceControl' => 'Active',
                        'button' => 'buttonActive',
                        'connectTime' => $day . ' - ' . $hour . ':' . $minute
                    );
                } else {       
                    $jsonveri = $DeviceControl;            
                }
            } else {
                $jsonveri = array(
                    'Error' => 'Bu Cihaza Ait veri Bulunamadı.'
                );
            }
                echo json_encode($jsonveri);
        }
    } // end xDeviceControl()
    
    public function xModalReport0401()
    {
        if($_GET){
            $DateTimes = explode('|', $this->input->get('dateTimes'));

            $data = $this->xdata_model->xModalReport0401_model( $this->input->get( 'imeiid' ), date('Y-m-d', strtotime($DateTimes[0])), date('Y-m-d', strtotime($DateTimes[1])) );
            for ($i = 0;$i < count($data);$i++) {
                $datax['data'][] = array(
                    'data' => $this->autosensor->AutoSensorControl( $data[$i]->sensordata ),
                    'time' => date('d-m-Y H:i:s', strtotime($data[$i]->serverdate))
                );
            }
            echo json_encode($datax);
        }
    } // end xModalReport0401()
    
    public function xAddressCheckInfo()
    {
        if($_GET) {
            $IMEIId = $this->input->get( 'imeiid' );
            $data = $this->xdata_model->xAddressCheckInfo_model( $IMEIId );
            /**
             * GSM Lokasyondan gelen koordinat verileri xSensor Alanından Filtre
             * ediliyor ve atc formatına dönüştürülüyor.
             * $this->GSMxLatitude( $GSMLAT )
             * $this->GSMxLongitude( $GSMLNG )
             */
            //$LBSData = $this->autosensor->AutoSensorControl( $data[0]->sensordata );
            //$GSMLAT = $LBSData['Sensor13']['GSMLokasyon']['gsmlat'];
            //$GSMLNG = $LBSData['Sensor13']['GSMLokasyon']['gsmlng'];
            /* burada GSM den gelen koordinatı atc formatına çeviricez. */
            
            $AdresBulControl = $this->xdata_model->xAddressCheckInfoControl_model( $data[0]->latitude, $data[0]->longitude );
            
            if($AdresBulControl){
                $query['display_name'] = $AdresBulControl[0]->displayname;
                echo json_encode($query);
            } else {
                $curl_handle=curl_init();
                curl_setopt($curl_handle, CURLOPT_URL,'http://nominatim.openstreetmap.org/reverse?format=json&lat=' . $this->xLatitude( $data[0]->latitude ) . '&lon=' . $this->xLongitude( $data[0]->longitude ) );
                curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
                curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($curl_handle, CURLOPT_USERAGENT, 'Your application name');
                $query = curl_exec($curl_handle);
                curl_close($curl_handle);
                $Address = $this->xdata_model->AdresBul_model( $IMEIId, $data[0]->latitude, $data[0]->longitude, json_decode($query) );
                echo $query;
            }
        }
    } // end xAddressCheckInfo ()
    
    public function AtcAlarmInfo()
    {
        if($_GET) {
            $IMEIId = $this->input->get( 'imeiid' );
            $AlarmInfoData = $this->xdata_model->AtcAlarmInfo_model( $IMEIId );
            for ($i = 0;$i < count($AlarmInfoData);$i++) {
            $par = explode("|", AtcAlarms( hexdec( $AlarmInfoData[$i]->alarm ) ));
                    $data['AlarmInfoData'] =  $par[0] == 38 ? $par[1] :'-1'; 
            }
            echo json_encode($data, JSON_NUMERIC_CHECK);
        }
    } // end AtcAlarmInfo()
    
    public function AutoXmetreControl()
    {
        if($_GET){
            $DateTimes = explode('|', $this->input->get('xMetredateTimes'));
            $IMEIID = $this->input->get('imeiid');
            $this->session->set_userdata('devicelistimeiid', substr($IMEIID, -9));
            $Parametre = $this->xdata_model->xMetreGeneral_model( $this->session->userdata('devicelistimeiid'), $DateTimes[0], $DateTimes[1] );
            if(!empty($Parametre)){
                for ($i = 0;$i < count($Parametre);$i++){
                    $xMetreArray['xMetreInfo'][$i] = array(
                        'ImeiId'        => $Parametre[$i]->imeiid,
                        'Date'          => date('d-m-Y', strtotime($Parametre[$i]->serverdate)),
                        'Time'          => date('H:i:s', strtotime($Parametre[$i]->serverdate)),
                        'GSMQuality'    => hexdec($Parametre[$i]->gsmquality),
                        'dataStatus'    => $Parametre[$i]->datastatus == '00' ? 'OffLine Data' : 'OnLine Data',
                        'GPSLatitude'   => $this->xLatitude($Parametre[$i]->latitude),
                        'GPSLongitude'  => $this->xLongitude($Parametre[$i]->longitude),
                        'FazInfo'       => $Parametre[$i]->fazinfo == 0 ? 'PowerOff' : 'PowerOn',
                        'HavaTemp'      => $this->xMetreTempSensor($Parametre[$i]->havatemp),
                        'HavaNem'       => $this->xMetreNemSensor($Parametre[$i]->havanem),
                        'ToprakTemp'    => $this->xMetreTempSensor($Parametre[$i]->topraktemp),
                        'ToprakNem'     => $this->xMetreNemSensor($Parametre[$i]->topraknem),
                        'voltaj'        => (hexdec($Parametre[$i]->voltage) / 1000),
                        'Batery'        => (hexdec($Parametre[$i]->batery) / 1000),
                        'rwaxdata'      => $Parametre[$i]->rawxdata,
                        'imeiidx'       => $this->session->userdata('devicelistimeiid')
                    );
                }
                echo json_encode($xMetreArray);
            } else {
                $xMetreArray['xMetreInfo'] = 0;
                echo json_encode($xMetreArray);  
            }
        } else {
            echo "Bu alanı Kullanma Yetkiniz Yok";
        }
    }
    
    private function xMetreTempSensor( $SensorData = false )
    {
        $Sensor01 = substr($SensorData, 0, 1);
        if($Sensor01 >= '8') {
                return hexdec(substr($SensorData, 1, 1)) . '.' . hexdec(substr($SensorData, 2));
        } else {
                return hexdec(substr($SensorData, 0, 2)) . '.' . hexdec(substr($SensorData, 2, 2));
        }
    } // end xMetreTempSensor( $SensorData = false )
    
    private function xMetreNemSensor( $SensorData = false )
    {
        $Sonsor00 = substr($SensorData, 0, 2);
        $Sensor01 = substr($SensorData, 2, 2);
        
        return hexdec($Sonsor00) . '.' . hexdec($Sensor01);
    } // end xMetreNemSensor( $SensorData = false )
    
    ////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////
    
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
    }
    
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
    }
}

