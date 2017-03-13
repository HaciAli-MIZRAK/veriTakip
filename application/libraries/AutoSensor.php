<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of "cpanel_os_view.php" MnetPanel ajax data programming
 * This Admin Panel Homepage OS data json format
 * cPanel_OS_view Class
 * @author NorthStarz
 */
class AutoSensor
{
    
    public function __construct()
    {        
    } // end __construct()
    
    public function index()
    {        
    } // end index()
    
    public function AutoSensorControl( $Parametre = false )
    {
        if ($Parametre == true) {
            for ($i = 0;$i < strlen($Parametre);$i = $i + $d ) {
                $Sensor = substr($Parametre, $i, 2);
                // Alt bar da gösterilecek sensörler
                if ($Sensor == '00') {
                    $data['Sensor00'] = $this->MultiSicaklikSensoru00and04( substr($Parametre, $i) );
                    $d = $data['Sensor00']['d'];  
                } else 
                // Alt bar da gösterilecek sensörler
                if ($Sensor == '01') {
                    $data['Sensor01'] = array(
                       'TeknotelSensor' => hexdec( substr($Parametre, ($i + 2), 4) )
                    );
                    $d = 6;   
                } else
                // PGN alanı baş belası :)    
                if ($Sensor == '02') {
                    $data['Sensor02'] = array(
                        'CAN02PGN' => $this->CAN02PGN( substr($Parametre, $i ))
                    );
                    $d = 44;  
                } else
                // geçici olarak yapıldı    
                if($Sensor == '03') {
                    $data['Sensor03'] = array(
			'gecici' => substr($Parametre, $i)
                    );
                    $d = 10;
                } else
                // Alt bar da gösterilecek sensörler
                if ($Sensor == '04') {
                    $data['Sensor04'] = $this->MultiSicaklikSensoru00and04( substr($Parametre, $i) );
                    $d = $data['Sensor04']['d'];
                } else 
                // Takip Panelinde gösterilecek sensörler
                if ($Sensor == '05') {
                    $data['Sensor05'] = array(
                       'IdlingTime' => hexdec( substr($Parametre, ($i + 2), 6) )
                    );
                    $d = 8;  
                } else
                // geçici olarak yapıldı    
                if($Sensor == '07') {
                    $data['Sensor07'] = array(
			'gecici' => substr($Parametre, $i)
                    );
                    $d = 12;
                } else
                // geçici olarak yapıldı    
                if($Sensor == '08') {
                    $data['Sensor08'] = array(
			'extraAlarm' => substr($Parametre, $i)
                    );
                    $d = 14;
                } else
                // Alt bar da gösterilecek sensörler
                if ($Sensor == '09') {
                    $data['Sensor09'] = array(
                       'AnalogInput' => (hexdec( substr($Parametre, ($i + 2), 4) ) * 0.80586)
                    );
                    $d = 6;  
                } else 
                // Üst Bar da gösterilecek sensörler
                if ($Sensor == '0E') {
                    $data['Sensor0E'] = array(
                       'SatelliteCount' => hexdec( substr($Parametre, ($i + 2), 2) )
                    );
                    $d = 4;  
                } else 
                // Alt bar da gösterilecek sensörler
                if ($Sensor == '0F') {
                    $data['Sensor0F'] = array(
                       'HeightValue' => hexdec( substr($Parametre, ($i + 2), 4) )
                    );
                    $d = 6;   
                } else
                // geçici olarak yapılıyor
                if($Sensor == '11') {
                    $data['Sensor11'] = array(
			'G-Sensor11' => substr($Parametre, $i)
                    );
                    $d = 8;
                } else    
                // yeri henüz belli değil
                if ($Sensor == '12') {
                    $data['Sensor12'] = $this->MultiUsartTransparan12( substr($Parametre, $i) );
                    $d = $data['Sensor12']['d'];
                } else 
                // webservisde endLokasyon() function da kullanılacak.
                if ($Sensor == '13') {
                    $data['Sensor13'] = $this->GSMLokasyon13( substr($Parametre, $i) );
                    $d = 34;  
                } else 
                // Takip Panelinde gösterilecek sensörler
                if ($Sensor == '14') {
                    $data['Sensor14'] = array(
                       'MotorHour' => hexdec( substr($Parametre, ($i + 2), 8) )
                    );
                    $d = 10;  
                } else 
                // Alt bar da gösterilecek sensörler
                if ($Sensor == '17') {
                    $data['Sensor17'] = $this->FuelSensor17( substr($Parametre, $i) );
                    $d = $data['Sensor17']['d'];  
                } else 
                // Üst Bar da gösterilecek sensörler
                if ($Sensor == '19') {
                    $data['Sensor19'] = array(
                       'BateryPercentage' => hexdec( substr($Parametre, ($i + 2), 2) )
                    );
                    $d = 4;  
                } else 
                // Alt bar da gösterilecek sensörler
                if ($Sensor == '22') {
                    $data['Sensor22'] = $this->FuelSensor22( substr($Parametre, $i) );
                    $d = $data['Sensor22']['d'];  
                } else 
                // Alt bar da gösterilecek sensörler
                if ($Sensor == '23') {
                    $data['Sensor23'] = $this->Humidity23( substr($Parametre, $i) );
                    $d = 10;  
                } else 
                // Alt bar da gösterilecek sensörler
                if ($Sensor == '24') {
                    $data['Sensor24'] = array(
                       'HeightValue2' => (hexdec( substr($Parametre, ($i + 2), 4) ) / 10)
                    );
                    $d = 6;  
                } else 
                // Alt bar da gösterilecek sensörler
                if ($Sensor == '25') {
                    $data['Sensor25'] = array(
                       'DCSupplyVoltage' => (hexdec( substr($Parametre, ($i + 2), 4) ) * 12.27)
                    );
                    $d = 6;  
                } else 
                // Alt bar da gösterilecek sensörler
                if ($Sensor == '26') {
                    $data['Sensor26'] = array(
                       'DepoPercentage' => hexdec( substr($Parametre, ($i + 2), 2) )
                    );
                    $d = 4;  
                } else 
                // Alt bar da gösterilecek sensörler
                if ($Sensor == '30') {
                    $data['Sensor30'] = $this->UltrasonicLevelSensor30( substr($Parametre, $i) );
                    $d = $data['Sensor30']['d'];  
                } else {
                    return "Bilinmeyen Sensör Tipi: " . $Parametre;
                    //$d = 1;
                }
            } // end for() 
            return $data;
        } else {
            return $data['xSensorError'] = 0;
        } // end Parametre if
    } // end AutoSensorControl()
    
    /* CAN 02 Alanı işleniyor */
    public function CAN02PGN( $SensorData = false )
    {
        if($SensorData == true) {
            if(substr($SensorData, 0, 2) == '02' ) {
                if(substr($SensorData, 2, 2) == '00') {
                    return $CAN02['CAN02'] = 'CAN Yok'; 
                } else {
                    $par = str_split(substr($SensorData, 28, 16), 2);
                    $d1 = $par[0];
                    $d2 = $par[1];
                    $d3 = decbin(hexdec($d1.$d2) >> 3); // PGN ID: 0x42E
                    return $CANSpeed = array(
                        'CANHeader' => substr($SensorData, 2, 2),
                        'CANPGNId'  => substr($SensorData, 4, 4),
                        'CAN02654'  => $this->CAN02PGNParser( substr($SensorData, 8, 16) ),
                        'CAN0242E'  => (bindec($d3) / 50),
                        'd'         => '44'
                    );
                }
            }
        }
    }
    
    public function MultiSicaklikSensoru00and04( $SensorData = false )
    {
        if ($SensorData == true) {
            if(substr($SensorData, 0, 2) == '00' ) {
                $data01_1 = substr($SensorData, 2, 4);
                return $data['SensorDeger'] = array(
                    'Sensor1' => $this->SicaklikSensoru( $data01_1 ),
                    'd' => 6
                );
            } // end indeksi 00 olan sıcaklık sensör verisi
            
            if(substr($SensorData, 0, 2) == '04' ) {
                $Data00 = substr($SensorData, 2, 2);
                switch($Data00){
                    case '01' :
                        $data01_1 = substr($SensorData, 4, 4);
                        return $data['SensorDeger'] = array(
                            'Sensor1' => $this->SicaklikSensoru( $data01_1 ),
                            'd' => 8
                        );
                    break;
                    case '02' :
                        $data02_1 = substr($SensorData, 4, 4);
                        $data02_2 = substr($SensorData, 8, 4);
                        return $data['SensorDeger'] = array(
                            'Sensor1' => $this->SicaklikSensoru( $data02_1 ),
                            'Sensor2' => $this->SicaklikSensoru( $data02_2 ),
                            'd' => 12
                        );
                    break;
                    case '03' :
                        $data03_1 = substr($SensorData, 4, 4);
                        $data03_2 = substr($SensorData, 8, 4);
                        $data03_3 = substr($SensorData, 12, 4);
                        return $data['SensorDeger'] = array(
                            'Sensor1' => $this->SicaklikSensoru( $data03_1 ),
                            'Sensor2' => $this->SicaklikSensoru( $data03_2 ),
                            'Sensor3' => $this->SicaklikSensoru( $data03_3 ),
                            'd' => 16
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
    
    public function MultiUsartTransparan12( $Parametre = false )
    {
        if (substr($Parametre, 0, 2) == '12') {
            if (hexdec( substr($Parametre, 4, 4) ) == '0000') {
                return $data['MUTP12'] = array('Sensor12' => 0, 'd' => (hexdec( substr($Parametre, 4, 4) ) + 8));
            } else {
                $arrayCount = $this->HexToAscii( substr($Parametre, 8, hexdec( substr($Parametre, 4, 4) ) ) );
                for ($i = 0;$i <= count($arrayCount)-1;$i++) {
                    $par = explode(";", $arrayCount[$i]);
                    $arrayData[] = array(
                        'label' => implode(":", str_split($par[0], 2)),
                        'value' => substr($par[1], 1) == false ? 0 : substr($par[1], 1)
                    );
                    $arrayMac[] = implode(":", str_split($par[0], 2));
                    $arrayDBM[] = $par[1] == null ? 0 : $par[1];
                }
                return $data['MUTP12'] = array(
                    'Usart'     => hexdec( substr($Parametre, 2, 2) ),
                    'dataSize'  => hexdec( substr($Parametre, 4, 4) ),
                    'MUTPdata'  => $this->HexToAscii( substr($Parametre, 8, hexdec( substr($Parametre, 4, 4) ) ) ) == false ? 0 : $this->HexToAscii( substr($Parametre, 8, hexdec( substr($Parametre, 4, 4) ) ) ),
                    'MacAdress' => $arrayMac,
                    'data'      => $arrayData,
                    'count'     => count($arrayCount),
                    'dbmSignal' => $arrayDBM,
                    'd'         => (hexdec( substr($Parametre, 4, 4) ) + 8)
                );
            }
        }
    }
    
    /**
     * GSMLokasyon( $Parametre = false )
     * Cihazdan gelen GSM Lokasyon verilerini işliyoruz.
     * @param type $Parametre
     * @return type
     */
    public function GSMLokasyon13( $Parametre = false )
    {
        // GSM Lokasyon index 13
        if ($Parametre == true) {
            $GSMLokasyon0   = substr($Parametre, 2, 32);
            $GSMDate        = substr($GSMLokasyon0, 0, 4);
            $GSMMonth       = substr($GSMLokasyon0, 4, 2);
            $GSMDay         = substr($GSMLokasyon0, 6, 2);
            $GSMHour        = substr($GSMLokasyon0, 8, 6);
            $GSMLat         = substr_replace(substr($GSMLokasyon0, 14, 9), '.', 3,0);
            $GSMLng         = substr_replace(substr($GSMLokasyon0, 23, 9), '.', 3,0);
            $ArrayData['GSMLokasyon'] = array(
                'gsmdate'   => $GSMDate,
                'gsmmonth'  => $GSMMonth,
                'gsmday'    => $GSMDay,
                'gsmhour'   => $GSMHour,
                'gsmlat'    => $GSMLat,
                'gsmlng'    => $GSMLng
            );
            return $ArrayData;
        }
    } // end GSMLokasyon( $Parametre = false )
    
    /**
     * FuelSensor17( $Parametre = false )
     * @param type $Parametre
     * @return type
     */
    public function FuelSensor17( $Parametre = false )
    {
        if (substr($Parametre, 0, 2) == '17') {
            $FuelSensor0 = substr($Parametre, 2, 2);
            switch($FuelSensor0) {
                case '01' :
                    return $data['FuelSensor17'] = array(
                        'Sensor1'       => hexdec( substr($Parametre, 4, 2) ),
                        'SensorValue1'  => hexdec( substr($Parametre, 6, 2) ),
                        'd' => 8
                    );
                break;
                case '02' :
                    return $data['FuelSensor17'] = array(
                        'Sensor1'       => hexdec( substr($Parametre, 4, 2) ),
                        'SensorValue1'  => hexdec( substr($Parametre, 6, 2) ),
                        'Sensor2'       => hexdec( substr($Parametre, 8, 2) ),
                        'SensorValue2'  => hexdec( substr($Parametre, 10, 2) ),
                        'd' => 12
                    );
                break;
            }
        }
    } // end FuelSensor17( $Parametre = false )
    
    /**
     * FuelSensor22( $Parametre = false )
     * @param type $Parametre
     * @return type
     */
    public function FuelSensor22( $Parametre = false )
    {
        if (substr($Parametre, 0, 2) == '22') {
            $FuelSensor0 = hexdec( substr($Parametre, 2, 4) );
            $FuelSensor1 = substr($Parametre, 6, $FuelSensor0);
            return $data['FuelSensor22'] = array(
                'Sensor'   => str_split($FuelSensor1, 54),
                'd'        => ($FuelSensor0 + 6)
            );
        }
    } // end FuelSensor22( $Parametre = false )
    
    /**
     * Humidity( $Parametre = false )
     * @param type $Parametre
     * @return type
     */
    public function Humidity23( $Parametre = false )
    {
        if (substr($Parametre, 0, 2) == '23') {
            return $data['Humidity'] = array(
                'Humidity'  => $this->SicaklikSensoru( substr($Parametre, 2, 4) ),
                'Temp'      => (-46.85 + (175.72*( hexdec( substr($Parametre, 6, 4) ) / 65536)))
            );
        }
    } // end Humidity( $Parametre = false )
    
    public function UltrasonicLevelSensor30( $Parametre = false )
    {
        if (substr($Parametre, 0, 2) == '30') {
            $UltraSonic = hexdec( substr($Parametre, 2, 4) );
            $UltaSonicData = substr($Parametre, 6, $UltraSonic);
            return $data['UltraSonic30'] = array(
                'Usart'     => hexdec( substr($UltaSonicData, 0, 1) ),
                'Status'    => hexdec( substr($UltaSonicData, 1, 1) ),
                'dataSize'  => hexdec( substr($UltaSonicData, 2, 2) ),
                'UltraData' => substr($UltaSonicData, 4, hexdec( substr($UltaSonicData, 2, 2) )),
                'd'        => ($UltraSonic + 6)
            );
        }
    } // end UltrasonicLevelSensor30( $Parametre = false )
    
    /**
     * HexToAscii( $hexstr = false )
     * @param type $hexstr
     * @return type
     */
    public function HexToAscii( $hexadecimal = false )
    {
        $hexstr = str_replace(' ', '', $hexadecimal);
        $hexstr = str_replace('\x', '', $hexadecimal);
        $retstr = pack('H*', $hexadecimal);
        $par = explode("\n", rtrim($retstr));
            for ($i = 0;$i < count($par);$i++){
                $array[] = substr(trim($par[$i]), 2);
        }
        return $array;
    } // end HexToAscii( $hexadecimal = false )
    
    public function CAN02PGNParser( $parametre = false )
    {
        if (PHP_OS == 'Linux') { $php_int_size = PHP_INT_SIZE * 8; } else { $php_int_size = PHP_INT_SIZE * 16; }
        $binary = $php_int_size;
        $CAN02_1 = hexdec($parametre);
        $CAN02_2 = decbin($CAN02_1);
        $CAN02_3 = strlen($CAN02_2);
        $CAN02_4 = ($binary - $CAN02_3);
        $Zero = '';
        for ($i = 0;$i < $CAN02_4;$i++)
        {
                $Zero .= '0';
        }
        $deger = str_split($Zero.$CAN02_2, 1);
                return $deger;
    }
}
