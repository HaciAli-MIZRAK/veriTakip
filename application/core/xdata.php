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

//class xData extends Admin_Controller
//{
//    
//    public function __construct()
//    {
//        parent::__construct();
//    } // end __construct()
//    
//    public function index()
//    {  
//    } // end index()
//    
//    public function xwebService()
//    {
//    } // end xwebService()
//    
//    /**
//     * 
//     * @param type $Latitude
//     * @return type
//     */
//    private function xLatitude( $Latitude = '40474003' )
//    {
//        $Lat0 = substr($Latitude, 0, 2);
//        $Lat1 = substr($Latitude, -6);
//        $Lat2 = floatval($Lat1);
//        $Lat3 = (number_format($Lat2, 13, "", ".") / 60); // duruma göre burada bulunan "", "." alanını silebiliriz
//        $Lat4 = str_replace(".", "", $Lat3);
//        return $Lat0 . '.' . $Lat4;
//        
//
//    } // end xLatitude()
//    
//    /**
//     * 
//     * @param type $Longitude
//     * @return type
//     */
//    private function xLongitude( $Longitude = '029253275' )
//    {
//        $Lng0 = substr($Longitude, 0, 3);
//        $Lng1 = substr($Longitude, -6);
//        $Lng2 = floatval($Lng1);
//        $Lng3 = (number_format($Lng2, 13, "", ".") / 60); // duruma göre burada bulunan "", "." alanını silebiliriz
//        $Lng4 = str_replace(".", "", $Lng3);
//        return $Lng0 . '.' . $Lng4;
//    } // end xLongitude()
//    
//    /**
//     * 
//     * @param type $Status
//     * @return type
//     */
//    private function xStatus( $Status = '00000801' )
//    {
//        $Status0 = PHP_INT_SIZE * 8;
//        $Status1 = hexdec($Status);
//        $Status2 = decbin($Status1);
//        $Status3 = strlen($Status2);
//        $Status4 = ($Status0 - $Status3);
//        $Status5 = NULL;
//        for ($i = 0;$i < $Status4;$i++) {
//            $Status5 .= '0';
//        }
//        $Status6 = $Status5 . $Status2;
//        $Status7 = strrev($Status6);
//        for ($j = 0;$j < $Status0;$j++) {
//            $Status8[] = $Status7[$j] ? '1' : '0';
//        }
//       return $Status8; 
//    } // end xStatus()
//    
//    /**
//     * 
//     * @param type $Hardware
//     * @return type
//     */
//    private function xHardware( $Hardware = '00111111' )
//    {
//        $Hardware0 = PHP_INT_SIZE * 8;
//        $Hardware1 = hexdec($Hardware);
//        $Hardware2 = decbin($Hardware1);
//        $Hardware3 = strlen($Hardware2);
//        $Hardware4 = ($Hardware0 - $Hardware3);
//        $Hardware5 = NULL;
//        for ($i = 0;$i < $Hardware4;$i++) {
//            $Hardware5 .= '0';
//        }
//        $Hardware6 = $Hardware5 . $Hardware2;
//        $Hardware7 = strrev($Hardware6);
//        for ($j = 0;$j < $Hardware0;$j++) {
//            $Hardware8[] = $Hardware7[$j] ? '1' : '0';
//        }
//       return $Hardware8; 
//    } // end xHardware()
//    
//    /**
//     * 
//     * @param type $SensorData
//     * @return type
//     */
//    private function xSensorData( $SensorData = '0E0F' )
//    {
//        $SensorData0 = substr($SensorData, 0, 2);
//        // Sıcaklık Sensörü
//        if ($SensorData0 == '00') {
//            echo "Sıcaklık Sensörü";
//        }
//        // Teknotel Yakıt Sensörü
//        if ($SensorData0 == '01') {
//            echo "Teknotel Yakıt Sensörü";
//        }
//        // CAN Hat Bilgileri
//        if ($SensorData0 == '02') {
//            echo "CAN Hat Bilgileri";
//        }
//        // Darbe Sayacı
//        if ($SensorData0 == '03') {
//            echo "g-sensor alanı";
//        }
//        // Çoklu Sıcaklık Sensörü
//        if ($SensorData0 == '04') {
//            echo "Çoklu Sıcaklık Sensörü";
//        }  
//        // Rölanti Süresi
//        if ($SensorData0 == '05') {
//            echo "Rölanti Süresi";
//        }
//        // OBD Bilgileri
//        if ($SensorData0 == '06') {
//            echo "OBD Bilgileri";
//        }
//        // Toplam Üretilen Darbe Sayısı
//        if ($SensorData0 == '07') {
//            echo "Toplam Üretilen Darbe Sayısı";
//        }
//        // Ekstra Alarm Bilgisi
//        if ($SensorData0 == '08') {
//            echo "Ekstra Alarm Bilgisi";
//        }
//        // Analog Giriş
//        if ($SensorData0 == '09') {
//            echo "Analog Giriş";
//        }
//        // IO Expander
//        if ($SensorData0 == '10') {
//            echo "IO Expander";
//        }
//        // G-Sensor index 11
//        if ($SensorData0 == '11') {
//            echo "g-sensor alanı";
//        }
//        // Çoklu Usart Transparan Mod Verileri 12
//        if ($SensorData0 == '12') {
//            echo "Çoklu Usart Transparan Mod Verileri";
//        }
//        // GSM Lokasyon index 13
//        if ($SensorData0 == '13') {
//            $GSMLokasyon0   = substr($SensorData, 2, 32);
//            $GSMDate        = substr($GSMLokasyon0, 0, 4);
//            $GSMMonth       = substr($GSMLokasyon0, 4, 2);
//            $GSMDay         = substr($GSMLokasyon0, 6, 2);
//            $GSMHour        = substr($GSMLokasyon0, 8, 6);
//            $GSMLat         = substr_replace(substr($GSMLokasyon0, 14, 9), '.', 3,0);
//            $GSMLng         = substr_replace(substr($GSMLokasyon0, 23, 9), '.', 3,0);
//            $ArrayData['GSMLokasyon'] = array(
//                'gsmdate'   => $GSMDate,
//                'gsmmonth'  => $GSMMonth,
//                'gsmday'    => $GSMDay,
//                'gsmhour'   => $GSMHour,
//                'gsmlat'    => $GSMLat,
//                'gsmlng'    => $GSMLng
//            );
//            return $ArrayData;
//        }
//        // Motor saati verileri 14
//        if ($SensorData0 == '14') {
//            echo "Motor saati verileri";
//        }
//        // Çoklu Analog Giriş Verileri 15
//        if ($SensorData0 == '15') {
//            echo "Çoklu Analog Giriş Verileri";
//        }
//        // RF Mesajları
//        if ($SensorData0 == '16') {
//            echo "RF Mesajları";
//        }
//        // Yakit Sensoru Verileri
//        if ($SensorData0 == '17') {
//            echo "Yakit Sensoru Verileri";
//        }
//        // Giriş Saati
//        if ($SensorData0 == '18') {
//            echo "Giriş Saati";
//        }
//        // Analog Pil Seviyesi 19
//        if ($SensorData0 == '19') {
//            $BateryStatus0 = substr($SensorData, 2, 2);
//            $BateryStatus1 = hexdec($BateryStatus0);
//            return $BateryStatus1;
//        }
//        // Yeni Yakıt Sensörü
//        if ($SensorData0 == '22') {
//            echo "Yeni Yakıt Sensörü";
//        }
//        // Yükseklik Sensörü
//        if ($SensorData0 == '23') {
//            echo "Yükseklik Sensörü";
//        }
//        // Kahve Makinası ARZUM
//        if ($SensorData0 == '28') {
//            echo "Kahve Makinası ARZUM";
//        }
//        ##### Hex index değerleri ######
//        // Numaratör
//        if ($SensorData0 == '0A') {
//            echo "Numaratör";
//        }
//        // Transparan Mod Verileri
//        if ($SensorData0 == '0C') {
//            echo "Transparan Mod Verileri";
//        }
//        // Gelişmiş CAN Verileri
//        if ($SensorData0 == '0D') {
//            echo "Gelişmiş CAN Verileri";
//        }
//        // Uydu Sayısı
//        if ($SensorData0 == '0E') {
//            $SataliteCount0 = substr($SensorData, 2, 2);
//            $SataliteCount1 = hexdec($SataliteCount0);
//            return $SataliteCount1;
//        }
//        // Yükseklik Değeri
//        if ($SensorData0 == '0F') {
//            echo "Yükseklik Değeri";
//        }
//    } // end xSensorData()
//}
//
