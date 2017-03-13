<?php

/* xMetre için Geçici Alan */

function xMetregeneral( $xMetre = false, $Part = 0 )
{
    if ($xMetre == true) {
        $xMetrePar = explode(';', $xMetre);
        return $xMetrePar[$Part];
    }
}

function DateParser( $xDate = false, $DateStatus = 0, $HourStatus = 0 )
{
    if($xDate == true) {
        $Date = substr($xDate, 0, 6);
        $Hour = substr($xDate, 6, 6);
        if($DateStatus == 'Date') {
            $Day    = substr($Date, 0, 2);
            $Month  = substr($Date, 2, 2);
            $Year   = substr($Date, 4, 2);
            $DATE = $Day . ' / ' . $Month . ' / ' . $Year;
        }
        if($HourStatus == 'Hour') {
            $Hourx      = substr($Hour, 0, 2);
            $Minute     = substr($Hour, 2, 2);
            $Second     = substr($Hour, 4, 2);
            $HOUR = $Hourx . ':' . $Minute . ':' . $Second;
        }
        return $DATE . ' - ' . $HOUR;
    }
} // end DateParser( $xDate = false, $DateStatus = 0, $HourStatus = 0 )

function DeviceControl( $Day = false, $Hour = false, $Minute = false )
{
    if($Day == 0) {
        if($Hour == 0) {
            if($Minute == 0) { return 1; } else
            if($Minute == 1) { return 1; } else
            if($Minute == 2) { return 1; } else
            if($Minute == 3) { return 1; } else
            if($Minute == 4) { return 1; } else
            if($Minute == 5) { return 1; } else
            if($Minute == 6) { return 1; } else
            if($Minute == 7) { return 1; } else
            if($Minute == 8) { return 1; } else
            if($Minute == 9) { return 1; } else
            if($Minute == 10) { return 1; } else
            if($Minute == 11) { return 1; } else { return 0; }
        }
    }
} // end DeviceControl( $Day = false, $Hour = false, $Minute = false )

/* Bu Dosyamızda Atc Tarafından Gönderilen Alarm Durumlarını Parse
 * edeceğiz. Burada Bilinen 85 Alarm Bulunmaktadır.
 * Şimdi Bir Function & Method Oluşturalım.
 * 02 Mart 2015 Hacı Ali MIZRAK Tarafından Tarihinde Başlanmıştır.
*/

/* Bu Dosya ATC Alarmlarının genel Sayısal ve Yazısal Uyarılarını
 * İçermektedir Bu Dosya İçinde Yapılan İşlemler Sadece Bunlardır.
 * Bazı Alarmların Mesaj paketine Eklediği Alarm İçeriği Bu Dosyada
 * Bulunmamaktadır.
*/ 

// ATC Alarm function & Method Buradan Başlamıştır.
function AtcAlarms ( $value = NULL) {

	Switch ( $value ) {
	
	// 
		case '1' :
		
			$AlarmNumber = '1';
			$AlarmText = 'Noktaya giriş/çıkış yapıldı';
			
			return $AlarmNumber . '|' . $AlarmText;
			
		break;
	// 
		case '2' :
		
			$AlarmNumber = '2';
			$AlarmText = 'RFID kart okundu';
			
			return $AlarmNumber . '|' . $AlarmText;
			
		break;
	// 
		case '3' :
		
			$AlarmNumber = '3';
			$AlarmText = 'Maksimum hız limiti aşıldı';
			
			return $AlarmNumber . '|' . $AlarmText;
			
		break;
	// 
		case '4' :
		
			$AlarmNumber = '4';
			$AlarmText = 'Maksimum bekleme süresi aşıldı.';
			
			return $AlarmNumber . '|' . $AlarmText;
			
		break;
	// 
		case '5' :
		
			$AlarmNumber = '5';
			$AlarmText = 'Hızlanma ivme limiti aşıldı.';
			
			return $AlarmNumber . '|' . $AlarmText;
			
		break;
	// 
		case '6' :
		
			$AlarmNumber = '6';
			$AlarmText = 'Yavaşlama ivme limiti aşıldı.';
			
			return $AlarmNumber . '|' . $AlarmText;
			
		break;
	// 
		case '7' :
		
			$AlarmNumber = '7';
			$AlarmText = 'Akü bağlantısı kesildi.';
			
			return $AlarmNumber . '|' . $AlarmText;
			
		break;
	// 
		case '8' :
		
			$AlarmNumber = '8';
			$AlarmText = 'Giriş2 alarm tipi 1 oluştu.';
			
			return $AlarmNumber . '|' . $AlarmText;
			
		break;
	// 
		case '9' :
		
			$AlarmNumber = '9';
			$AlarmText = 'Giriş2 alarm tipi 2 oluştu.';
			
			return $AlarmNumber . '|' . $AlarmText;
			
		break;
	// 
		case '10' :
		
			$AlarmNumber = '10';
			$AlarmText = 'Giriş1 alarm tipi 1 oluştu.';
			
			return $AlarmNumber . '|' . $AlarmText;
			
		break;
	// 
		case '11' :
		
			$AlarmNumber = '11';
			$AlarmText = 'Giriş1 alarm tipi 2 oluştu.';
			
			return $AlarmNumber . '|' . $AlarmText;
			
		break;
	// 
		case '12' :
		
			$AlarmNumber = '12';
			$AlarmText = 'Kontak açıldı.';
			
			return $AlarmNumber . '|' . $AlarmText;
			
		break;
	// 
		case '13' :
		
			$AlarmNumber = '13';
			$AlarmText = 'Kontak kapatıldı.';
			
			return $AlarmNumber . '|' . $AlarmText;
			
		break;
	// 
		case '14' :
		
			$AlarmNumber = '14';
			$AlarmText = 'Yurtdışına çıkıldı.';
			
			return $AlarmNumber . '|' . $AlarmText;
			
		break;
	// 
		case '15' :
		
			$AlarmNumber = '15';
			$AlarmText = 'Yurtiçine girildi.';
			
			return $AlarmNumber . '|' . $AlarmText;
			
		break;
	// 
		case '16' :
		
			$AlarmNumber = '16';
			$AlarmText = 'Sensör 1 max. sıcaklık aşıldı.';
			
			return $AlarmNumber . '|' . $AlarmText;
			
		break;
	// 
		case '17' :
		
			$AlarmNumber = '17';
			$AlarmText = 'Sensör 1 min. Sıcaklık aşıldı.';
			
			return $AlarmNumber . '|' . $AlarmText;
			
		break;
	// 
		case '18' :
		
			$AlarmNumber = '18';
			$AlarmText = 'Giriş3 alarm tipi 1 oluştu.';
			
			return $AlarmNumber . '|' . $AlarmText;
			
		break;
	// 
		case '19' :
		
			$AlarmNumber = '19';
			$AlarmText = 'Giriş3 alarm tipi 2 oluştu.';
			
			return $AlarmNumber . '|' . $AlarmText;
			
		break;
	// 
		case '20' :
		
			$AlarmNumber = '20';
			$AlarmText = 'Yakıt seviyesi alarmı oluştu.';
			
			return $AlarmNumber . '|' . $AlarmText;
			
		break;
	// 
		case '21' :
		
			$AlarmNumber = '21';
			$AlarmText = 'GPS alınamıyor alarmı oluştu.';
			
			return $AlarmNumber . '|' . $AlarmText;
			
		break;
	// 
		case '22' :
		
			$AlarmNumber = '22';
			$AlarmText = 'Rölanti süresi aşıldı.';
			
			return $AlarmNumber . '|' . $AlarmText;
			
		break;
	// 
		case '23' :
		
			$AlarmNumber = '23';
			$AlarmText = 'RequestID alarmı oluştu.';
			
			return $AlarmNumber . '|' . $AlarmText;
			
		break;
	// 
		case '24' :
		
			$AlarmNumber = '24';
			$AlarmText = 'Taksimetre alarmı oluştu.';
			
			return $AlarmNumber . '|' . $AlarmText;
			
		break;
	// 
		case '25' :
		
			$AlarmNumber = '25';
			$AlarmText = 'Darbe girişi1 için limit aşıldı.';
			
			return $AlarmNumber . '|' . $AlarmText;
			
		break;
	// 
		case '26' :
		
			$AlarmNumber = '26';
			$AlarmText = 'Darbe girişi2 için limit aşıldı.';
			
			return $AlarmNumber . '|' . $AlarmText;
			
		break;
	// 
		case '27' :
		
			$AlarmNumber = '27';
			$AlarmText = 'Darbe girişi3 için limit aşıldı.';
			
			return $AlarmNumber . '|' . $AlarmText;
			
		break;
	// 
		case '28' :
		
			$AlarmNumber = '28';
			$AlarmText = 'Düşük hız limit alarmı.';
			
			return $AlarmNumber . '|' . $AlarmText;
			
		break;
	// 
		case '29' :
		
			$AlarmNumber = '29';
			$AlarmText = 'Sensör 2 max. sıcaklık aşıldı.';
			
			return $AlarmNumber . '|' . $AlarmText;
			
		break;
	// 
		case '30' :
		
			$AlarmNumber = '30';
			$AlarmText = 'Sensör 2 min. Sıcaklık aşıldı.';
			
			return $AlarmNumber . '|' . $AlarmText;
			
		break;
	// 
		case '31' :
		
			$AlarmNumber = '31';
			$AlarmText = 'Sensör 3 max. sıcaklık aşıldı.';
			
			return $AlarmNumber . '|' . $AlarmText;
			
		break;
	// 
		case '32' :
		
			$AlarmNumber = '32';
			$AlarmText = 'Sensör 3 min. Sıcaklık aşıldı.';
			
			return $AlarmNumber . '|' . $AlarmText;
			
		break;
	// 
		case '33' :
		
			$AlarmNumber = '33';
			$AlarmText = 'Açı alarmı oluştu.';
			
			return $AlarmNumber . '|' . $AlarmText;
			
		break;
	// 
		case '34' :
		
			$AlarmNumber = '34';
			$AlarmText = 'Transparan mod alarmı oluştu.';
			
			return $AlarmNumber . '|' . $AlarmText;
			
		break;
	// 
		case '35' :
		
			$AlarmNumber = '35';
			$AlarmText = 'Düşük hız bitti alarmı oluştu.';
			
			return $AlarmNumber . '|' . $AlarmText;
			
		break;
	// 
		case '36' :
		
			$AlarmNumber = '36';
			$AlarmText = 'Yüksek hız bitti alarmı oluştu.';
			
			return $AlarmNumber . '|' . $AlarmText;
			
		break;
	// 
		case '37' :
		
			$AlarmNumber = '37';
			$AlarmText = 'Rolanti Bitti Alarmı oluştu.';
			
			return $AlarmNumber . '|' . $AlarmText;
			
		break;
	// 
		case '38' :
		
			$AlarmNumber = '38';
			$AlarmText = 'Acil Durum Alarmı oluştu.';
			
			return $AlarmNumber . '|' . $AlarmText;
			
		break;
	// 
		case '39' :
		
			$AlarmNumber = '39';
			$AlarmText = 'IO Expander Alarm';
			
			return $AlarmNumber . '|' . $AlarmText;
			
		break;
	// 
		case '40' :
		
			$AlarmNumber = '40';
			$AlarmText = 'G sensör x yön alarmı';
			
			return $AlarmNumber . '|' . $AlarmText;
			
		break;
	// 
		case '41' :
		
			$AlarmNumber = '41';
			$AlarmText = 'G sensör y yön alarmı';
			
			return $AlarmNumber . '|' . $AlarmText;
			
		break;
	// 
		case '42' :
		
			$AlarmNumber = '42';
			$AlarmText = 'G sensör z yön alarmı';
			
			return $AlarmNumber . '|' . $AlarmText;
			
		break;
	// 
		case '43' :
		
			$AlarmNumber = '43';
			$AlarmText = 'Ters Dönme Alarmı';
			
			return $AlarmNumber . '|' . $AlarmText;
			
		break;
	// 
		case '44' :
		
			$AlarmNumber = '44';
			$AlarmText = 'Yan Dönme Alarmı';
			
			return $AlarmNumber . '|' . $AlarmText;
			
		break;
	// 
		case '45' :
		
			$AlarmNumber = '45';
			$AlarmText = 'Özel Alan (Rezerve)';
			
			return $AlarmNumber . '|' . $AlarmText;
			
		break;
	// 
		case '46' :
		
			$AlarmNumber = '46';
			$AlarmText = 'Hassas Durak Alarmı';
			
			return $AlarmNumber . '|' . $AlarmText;
			
		break;
	// 
		case '47' :
		
			$AlarmNumber = '47';
			$AlarmText = 'Genel Darbe Giris Alarmı';
			
			return $AlarmNumber . '|' . $AlarmText;
			
		break;
	// 
		case '48' :
		
			$AlarmNumber = '48';
			$AlarmText = 'Genel Giris Alarmı';
			
			return $AlarmNumber . '|' . $AlarmText;
			
		break;
	// 
		case '49' :
		
			$AlarmNumber = '49';
			$AlarmText = 'Mobileye Alarm';
			
			return $AlarmNumber . '|' . $AlarmText;
			
		break;
	// 
		case '50' :
		
			$AlarmNumber = '50';
			$AlarmText = 'Bu Alan Boş (Gizli İçerik)';
			
			return $AlarmNumber . '|' . $AlarmText;
			
		break;
	// 
		case '51' :
		
			$AlarmNumber = '51';
			$AlarmText = 'M50S Darbe/Kaza/İvme Alarmı';
			
			return $AlarmNumber . '|' . $AlarmText;
			
		break;
	// 
		case '52' :
		
			$AlarmNumber = '52';
			$AlarmText = 'Özel Alan (Rezerve)';
			
			return $AlarmNumber . '|' . $AlarmText;
			
		break;
	// 
		case '53' :
		
			$AlarmNumber = '53';
			$AlarmText = 'Özel Alan (Rezerve)';
			
			return $AlarmNumber . '|' . $AlarmText;
			
		break;
	// 
		case '54' :
		
			$AlarmNumber = '54';
			$AlarmText = 'Özel Alan (Rezerve)';
			
			return $AlarmNumber . '|' . $AlarmText;
			
		break;
	// 
		case '55' :
		
			$AlarmNumber = '55';
			$AlarmText = 'G sensor Kasis Alarmı';
			
			return $AlarmNumber . '|' . $AlarmText;
			
		break;
	// 
		case '56' :
		
			$AlarmNumber = '56';
			$AlarmText = 'G sensor Savrulma Alarmı';
			
			return $AlarmNumber . '|' . $AlarmText;
			
		break;
	// 
		case '57' :
		
			$AlarmNumber = '57';
			$AlarmText = 'G sensor Hizlanma Ivme Alarmı';
			
			return $AlarmNumber . '|' . $AlarmText;
			
		break;
	// 
		case '58' :
		
			$AlarmNumber = '58';
			$AlarmText = 'G sensor Yavaş. Ivme Alarmı';
			
			return $AlarmNumber . '|' . $AlarmText;
			
		break;
	// 
		case '59' :
		
			$AlarmNumber = '59';
			$AlarmText = 'Düşük batarya alarmı';
			
			return $AlarmNumber . '|' . $AlarmText;
			
		break;
	// 
		case '60' :
		
			$AlarmNumber = '60';
			$AlarmText = 'Dolu batarya alarmı';
			
			return $AlarmNumber . '|' . $AlarmText;
			
		break;
	// 
		case '61' :
		
			$AlarmNumber = '61';
			$AlarmText = 'Araç çekilme alarmı';
			
			return $AlarmNumber . '|' . $AlarmText;
			
		break;
	// 
		case '62' :
		
			$AlarmNumber = '62';
			$AlarmText = 'Cihaz kapatıldı';
			
			return $AlarmNumber . '|' . $AlarmText;
			
		break;
	// 
		case '63' :
		
			$AlarmNumber = '63';
			$AlarmText = 'Cihaz harekete başladı';
			
			return $AlarmNumber . '|' . $AlarmText;
			
		break;
	// 
		case '64' :
		
			$AlarmNumber = '64';
			$AlarmText = 'Cihaz hareketi bitti.';
			
			return $AlarmNumber . '|' . $AlarmText;
			
		break;
	// 
		case '65' :
		
			$AlarmNumber = '65';
			$AlarmText = 'Geçerli RFID Kart';
			
			return $AlarmNumber . '|' . $AlarmText;
			
		break;
	// 
		case '66' :
		
			$AlarmNumber = '66';
			$AlarmText = 'Geçersiz RFID Kart';
			
			return $AlarmNumber . '|' . $AlarmText;
			
		break;
	// 
		case '67' :
		
			$AlarmNumber = '67';
			$AlarmText = 'SIM kapağı açıldı';
			
			return $AlarmNumber . '|' . $AlarmText;
			
		break;
	// 
		case '68' :
		
			$AlarmNumber = '68';
			$AlarmText = 'Düşük nem oranı';
			
			return $AlarmNumber . '|' . $AlarmText;
			
		break;
	// 
		case '69' :
		
			$AlarmNumber = '69';
			$AlarmText = 'Yüksek nem oranı';
			
			return $AlarmNumber . '|' . $AlarmText;
			
		break;
	// 
		case '70' :
		
			$AlarmNumber = '70';
			$AlarmText = 'Düşük sıcaklık(Nem sensörü dahili verisi)';
			
			return $AlarmNumber . '|' . $AlarmText;
			
		break;
	// 
		case '71' :
		
			$AlarmNumber = '71';
			$AlarmText = 'Yüksek sıcaklık(Nem sensörü dahili verisi)';
			
			return $AlarmNumber . '|' . $AlarmText;
			
		break;
	// 
		case '72' :
		
			$AlarmNumber = '72';
			$AlarmText = 'Geçerli iButton ID';
			
			return $AlarmNumber . '|' . $AlarmText;
			
		break;
	// 
		case '73' :
		
			$AlarmNumber = '73';
			$AlarmText = 'Geçersiz iButton ID';
			
			return $AlarmNumber . '|' . $AlarmText;
			
		break;
	// 
		case '74' :
		
			$AlarmNumber = '74';
			$AlarmText = 'Jamming Alarm';
			
			return $AlarmNumber . '|' . $AlarmText;
			
		break;
	// 
		case '75' :
		
			$AlarmNumber = '75';
			$AlarmText = 'Akü bağlantısı takıldı.';
			
			return $AlarmNumber . '|' . $AlarmText;
			
		break;
	// 
		case '76' :
		
			$AlarmNumber = '76';
			$AlarmText = 'Serbest Düşüş Alarmı';
			
			return $AlarmNumber . '|' . $AlarmText;
			
		break;
	// 
		case '77' :
		
			$AlarmNumber = '77';
			$AlarmText = 'Sistem yeniden başlatıldı.';
			
			return $AlarmNumber . '|' . $AlarmText;
			
		break;
	// Protokolde Kayıtlı Olan Alarm Listesi Buraya Kadar İlaveler olduğunda
	// İşlenmeye Devam Edecektir.
		case '85' :
		
			$AlarmNumber = '85';
			$AlarmText = 'Cihaz Dikey Alarmı.';
			
			return $AlarmNumber . '|' . $AlarmText;
			
		break;
		default :
			
			$AlarmNumber = '0';
			$AlarmText = 'Alarm Yok';
			
			return $AlarmNumber . '|' . $AlarmText;
			
		break;
	/*/ 
		case '' :
		
			$AlarmNumber = '';
			$AlarmText = '';
			
			return $AlarmNumber . '|' . $AlarmText;
			
		break;
	// 
		case '' :
		
			$AlarmNumber = '';
			$AlarmText = '';
			
			return $AlarmNumber . '|' . $AlarmText;
			
		break;
	*/	
	
	} // End Switch

} // End Method Function
