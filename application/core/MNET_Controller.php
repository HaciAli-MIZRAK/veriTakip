<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of "cpanel_os_view.php" MnetPanel ajax data programming
 * This Admin Panel Homepage OS data json format
 * cPanel_OS_view Class
 * @author NorthStarz
 */

class MNET_Controller extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
    }
} // end Class MNET_Controller

class Public_Controller extends MNET_Controller
{
    
    public function __construct()
    {
        parent::__construct();
    }
    
} // end Class Public_Controller

class Admin_Controller extends MNET_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->LoginControl();
    }

    public function LoginControl(){
        
        if($this->session->userdata('login') == false) {
            redirect(base_url('pages/login'));
        }
        
    }
    
} // end Class Admin_Controller

class xData extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
    } // end __construct()
    
    public function index()
    {  
    } // end index()
    
    /**
     * 
     * @param type $Latitude
     * @return type
     */
    public function xLatitude( $Latitude = '40474003' )
    {
        $Lat0 = substr($Latitude, 0, 2);
        $Lat1 = substr($Latitude, -6);
        $Lat2 = floatval($Lat1);
        $Lat3 = (number_format($Lat2, 13, "", ".") / 60); // duruma göre burada bulunan "", "." alanını silebiliriz
        $Lat4 = str_replace(".", "", $Lat3);
        return $Lat0 . '.' . $Lat4;
        

    } // end xLatitude()
    
    /**
     * 
     * @param type $Latitude
     * @return type
     */
    public function GSMxLatitude( $Latitude = '40474003' )
    {
        $Par = explode(".", substr($Latitude, 1));
        $Lat = ($Par[1] * 60);
        return $Par[0] . $Lat;
    } // end GSMxLatitude( $Latitude = '40474003' )
    
    /**
     * 
     * @param type $Longitude
     * @return type
     */
    public function xLongitude( $Longitude = '029253275' )
    {
        $Lng0 = substr($Longitude, 0, 3);
        $Lng1 = substr($Longitude, -6);
        $Lng2 = floatval($Lng1);
        $Lng3 = (number_format($Lng2, 13, "", ".") / 60); // duruma göre burada bulunan "", "." alanını silebiliriz
        $Lng4 = str_replace(".", "", $Lng3);
        return $Lng0 . '.' . $Lng4;
    } // end xLongitude()
    
    public function GSMxLongitude( $Longitude = '029253275' )
    {
        $Par = explode(".", $Longitude);
        $Lat = ($Par[1] * 60);
        return $Par[0] . $Lat;
    } // end GSMxLatitude( $Latitude = '40474003' )
    
    /**
     * 
     * @param type $Status
     * @return type
     */
    public function xStatus( $Status = '00000801' )
    {
        if (PHP_OS == 'Linux') { $php_int_size = PHP_INT_SIZE * 4; } else { $php_int_size = PHP_INT_SIZE * 8; }
        $Status0 = $php_int_size; // Bu kısım evde 8 ile çarpılıyor linux sunucuda 4 ile çarpılıyor.
        $Status1 = hexdec($Status);
        $Status2 = decbin($Status1);
        $Status3 = strlen($Status2);
        $Status4 = ($Status0 - $Status3);
        $Status5 = NULL;
        for ($i = 0;$i < $Status4;$i++) {
            $Status5 .= '0';
        }
        $Status6 = $Status5 . $Status2;
        $Status7 = strrev($Status6);
        for ($j = 0;$j < $Status0;$j++) {
            $Status8[] = $Status7[$j] ? '1' : '0';
        }
       return $Status8; 
    } // end xStatus()
    
    /**
     * 
     * @param type $Hardware
     * @return type
     */
    public function xHardware( $Hardware = '00111111' )
    {
        if (PHP_OS == 'Linux') { $php_int_size = PHP_INT_SIZE * 4; } else { $php_int_size = PHP_INT_SIZE * 8; }
        $Hardware0 = $php_int_size; // Bu kısım evde 8 ile çarpılıyor linux sunucuda 4 ile çarpılıyor.
        $Hardware1 = hexdec($Hardware);
        $Hardware2 = decbin($Hardware1);
        $Hardware3 = strlen($Hardware2);
        $Hardware4 = ($Hardware0 - $Hardware3);
        $Hardware5 = NULL;
        for ($i = 0;$i < $Hardware4;$i++) {
            $Hardware5 .= '0';
        }
        $Hardware6 = $Hardware5 . $Hardware2;
        $Hardware7 = strrev($Hardware6);
        for ($j = 0;$j < $Hardware0;$j++) {
            $Hardware8[] = $Hardware7[$j] ? '1' : '0';
        }
       return $Hardware8; 
    } // end xHardware()

    /**
     * SicaklikSensoru00( $SensorData = false )
     * @param type $SensorData
     * @return string
     */
    public function SicaklikSensoru( $SensorData = false )
    {
        if ($SensorData == true) {
            if ($SensorData == 'FFFF') {
                $data['sensorsorun'] = "Sensör arızalı veya takılı değil. Lütfen kontrol edin.";
            } else {
                // Sıcaklık Değeri Artı değer mi? Eksi Değer mi? Buluyoruz.
                if (PHP_OS == 'Linux') { $php_int_size = PHP_INT_SIZE * 2; } else { $php_int_size = PHP_INT_SIZE * 4; }
                $binary   = $php_int_size; // sistem binary değeri alıyoruz.
                $Sensor01 = hexdec($SensorData); // hex to dec yaptık
                $Sensor02 = decbin($Sensor01); // dec to bin yaptık
                $Sensor03 = strlen($Sensor02); // burada değerin kaç hane olduğunu buluyoruz
                $Sensor04 = ($binary - $Sensor03); // sistem bit sayısı ile bizim ürettiğimiz arasındaki farka bakıyoruz
                $Zero = null;
                $Sensor05 = null;
                for ($x = 0;$x < $Sensor04;$x++){
                    $Zero .= '0';
                }
                $Sensor05 .= $Zero;
                $Sensor05 .= $Sensor02;
                $Sensor06 = strrev($Sensor05);
                for ($i = 0;$i < $binary;$i++) {
                    $Deger = $Sensor06[$i];
                }
                // Sıcaklık Değeri Artı değer mi? Eksi Değer mi? Buluyoruz.
                // Sıcaklık değeri Artı ise değeri yazıyoruz
                if ($Deger == '0') {
                    $Deger0 = hexdec(substr($SensorData, 2, 2)); // sensör veride ikinci kısım
                    $Deger1 = decbin($Deger0 >> 3); // sensör veride ikinci kısımı binary yapıyor 3 bit >> öteliyoruz.
                    $Deger2 = bindec($Deger1); // burada binary değeri decimal değere çeviriyoruz.
                    $Deger3 = ($Deger2 * 0.03125); // çıkan değeri bu sayı ile çarpıyoruz.
                    $Deger4 = hexdec(substr($SensorData, 0, 2)); // sensör verisi ilk değeri alıyoruz
                    $Deger5 = ($Deger4 + $Deger3); // burada ikisinide topluyoruz.
                    $data['SensorDeger'] = round($Deger5, 1); // sensör sıcaklık sonucu + değer burada ekrana yazılıyor.
                } 
                // Sıcaklık değeri Eksi ise ekrana yazıyoruz.
                if ($Deger == '1') {
                    $Sensor00 = hexdec($SensorData);
                    $Sensor01 = decbin($Sensor00);
                    $Sensor02 = strlen($Sensor01);
                    $Sensor03 = ($binary - $Sensor02);
                    $Sensor04 = null;
                    $Zero = null;
                    $one = null;
                    for ($x = 0;$x < $Sensor03;$x++) {
                        $Zero .= '0';
                    }
                    $Sensor04 .= $Zero;
                    $Sensor04 .= $Sensor01;
                    $Sensor05 = $Sensor04;
                    for ($i = 0;$i < $binary;$i++) {
                        if ($Sensor05[$i] == "0") {
                            $one .= 1;
                        } else {
                            $one .= 0;
                        }
                    }
                    $d = (bindec($one) + 1);
                    $e = dechex($d);
                    $f = strlen($e);
                    if($f == 3) {
                        $e = '0' . $e;
                    }
                    $Deger0 = hexdec(substr($e, 2, 2));
                    $Deger1 = decbin($Deger0 >> 3);
                    $Deger2 = bindec($Deger1);
                    $Deger3 = ($Deger2 * 0.03125);
                    $Deger4 = hexdec(substr($e, 0, 2));
                    $Deger5 = ($Deger4 + $Deger3);
                    $data['SensorDeger'] = '-' . round($Deger5, 1);
                }
            } // end sensör sorun if
            return $data;
        } else {
            //return $data['SensorError'] = "undefined";
        }
    } // end SicaklikSensoru00( $SensorData = false )
    
    public function MultiSicaklikSensoru00and04( $SensorData = false )
    {
        if ($SensorData == true) {
            if(substr($SensorData, 0, 2) == '00' ) {
                $data01_1 = substr($SensorData, 2, 4);
                return $data['SensorDeger'] = array(
                    'Sensor1' => $this->SicaklikSensoru( $data01_1 )
                );
            } // end indeksi 00 olan sıcaklık sensör verisi
            
            if(substr($SensorData, 0, 2) == '04' ) {
                $Data00 = substr($SensorData, 2, 2);
                switch($Data00){
                    case '01' :
                        $data01_1 = substr($SensorData, 4, 4);
                        return $data['SensorDeger'] = array(
                            'Sensor1' => $this->SicaklikSensoru( $data01_1 )
                        );
                    break;
                    case '02' :
                        $data02_1 = substr($SensorData, 4, 4);
                        $data02_2 = substr($SensorData, 8, 4);
                        return $data['SensorDeger'] = array(
                            'Sensor1' => $this->SicaklikSensoru( $data02_1 ),
                            'Sensor2' => $this->SicaklikSensoru( $data02_2 )
                        );
                    break;
                    case '03' :
                        $data03_1 = substr($SensorData, 4, 4);
                        $data03_2 = substr($SensorData, 8, 4);
                        $data03_3 = substr($SensorData, 12, 4);
                        return $data['SensorDeger'] = array(
                            'Sensor1' => $this->SicaklikSensoru( $data03_1 ),
                            'Sensor2' => $this->SicaklikSensoru( $data03_2 ),
                            'Sensor3' => $this->SicaklikSensoru( $data03_3 )
                        );
                    break;
                }
            } else {
                return $data = array('SensorError' => 0);
            } // end indeksi 04 olan çoklu sıcaklık sensör verisi
        } else {
            return $data = array('SensorError' => 0);
        }
    }
           

            
}

/* End of file MNET_Controller.php */
/* Location: ./application/core/MNET_Controller.php */
