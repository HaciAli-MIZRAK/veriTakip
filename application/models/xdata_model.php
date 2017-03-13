<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * 
 */
class xData_model extends CI_Model
{
    
    /**
     * 
     */
    public function __construct()
    {
        parent::__construct();
    } // end __construct()
    
    /**
     * 
     */
    public function index()
    {
    } // end index()
    
    /**
     * 
     * @param type $IMEIId
     * @param type $Limit
     * @return type
     */
    public function xGeneral_model( $IMEIId, $Limit )
    {
        $data = $this->db->where('imeiid', $IMEIId)
                         ->limit($Limit)
                         ->order_by("id", "desc")
                         ->get("parserldata")
                         ->result();
        return $data;
        
    } // end xGeneral_model( $IMEIId, $Limit = 1)
    
    /**
     * 
     * @param type $IMEIId
     * @return type
     */
    public function xAktiveData_model( $IMEIId = false )
    {
        $data = $this->db->select('id, imeiid, latitude, longitude, status, speed, distance, sensordata')
                         ->where('imeiid', $IMEIId)
                         ->limit(1)
                         ->order_by("id", "desc")
                         ->get("parserldata")
                         ->result();
            return $data; 
    } // end xStatus_model( $IMEIId )
    
    /**
     * 
     * @param type $IMEIId
     * @param type $Limit
     * @return type
     */
    public function xSensorData_model( $IMEIId = false, $Limit = 1 )
    {
        $data = $this->db->select('id, imeiid, sensordata')
                         ->where('imeiid', $IMEIId)
                         ->limit($Limit)
                         ->order_by("id", "desc")
                         ->get("parserldata")
                         ->result();
        return $data;
        
    } // end xStatus_model( $IMEIId )
    
    /**
     * 
     * @param type $IMEIId
     * @param type $xRawDataId
     * @param type $Limit
     * @return type
     */
    public function xRawData_model( $IMEIId = false, $xRawDataId = false, $Limit = 1 )
    {
        $data = $this->db->select('id, imeiid, rawdata')
                         ->where(array('imeiid' => $IMEIId, 'id >' => $xRawDataId))
                         ->limit($Limit)
                         ->order_by("id", "desc")
                         ->get("parserldata")
                         ->result();
        return $data;
    } // end xStatus_model( $IMEIId )
    
    /**
     * 
     * @param type $IMEIID
     * @param type $Limit
     * @return boolean
     */
    public function xDeviceControl_model( $IMEIID = false, $Limit = 1 )
    {
        $data = $this->db->select('id, imeiid, serverdate')
                         ->where(array('imeiid' => $IMEIID))
                         ->limit($Limit)
                         ->order_by("id", "desc")
                         ->get("parserldata")
                         ->result();
        if($data){
            return $data;
        } else {
            return false;
        }
    } // end xDeviceControl_model( $IMEIID = false, $Limit = 1 )
    
    /**
     * 
     * @param type $IMEIID
     * @return type
     */
    public function xHardwarex_model( $IMEIID = false )
    {
        if($IMEIID == true) {
            $data = $this->db->select('imeiid, accessory')
                             ->from('parsercdata')
                             ->where('imeiid', $IMEIID)
                             ->get()
                             ->result();
            return $data;
        }
    } // end FotografCheck_modal( $IMEIID = false )
    
    /**
     * 
     * @param type $IMEIID
     * @param type $FirstDate
     * @param type $LastDate
     * @return type
     */
    public function xModalReport0401_model( $IMEIID = false, $FirstDate = false, $LastDate = false )
    {
        if($IMEIID == true) {
            $data = $this->db->select('imeiid, sensordata, serverdate')
                             ->from('parserldata')
                             ->where('imeiid', $IMEIID)
                             ->where('serverdate >=', $FirstDate)
                             ->where('serverdate <=', $LastDate)
                             ->get()
                             ->result();
            return $data;
        }
    } // end xModalReport0401_model( $IMEIID = false, $FirstDate = false, $LastDate = false )
    
    /**
     * 
     * @param type $IMEIId
     * @param type $Latitude
     * @param type $Longitude
     * @param type $query
     */
    public function AdresBul_model( $IMEIId, $Latitude, $Longitude, $query = false )
    {
        $Address = array(
            'deviceimeiid'  => $IMEIId,
            '_latitude'     => $Latitude,
            '_longitude'    => $Longitude,
            'displayname'   => $query->display_name
        );
        
        $this->db->insert('address', $Address);
        
    } // end AdresBul_model( $query = false )
    
    /**
     * 
     * @param type $IMEIID
     * @param type $Limit
     * @return type
     */
    public function AtcAlarmInfo_model( $IMEIID = false, $Limit = '1' )
    {
        if($IMEIID == true) {
            $data = $this->db->select('imeiid, alarm')
                             ->from('parserldata')
                             ->where('imeiid', $IMEIID)
                             ->limit($Limit)
                             ->order_by("id", "desc")
                             ->get()
                             ->result();
            return $data;
        }
    } // end AtcAlarmInfo_model( $IMEIID = false, $Limit = '1' )
    
    /**
     * 
     * @param type $_latitude
     * @param type $_longitude
     * @param type $Limit
     * @return type
     */
    public function xAddressCheckInfoControl_model( $_latitude, $_longitude, $Limit = '1' )
    {
        $data = $this->db->where('_latitude', $_latitude)
                         ->where('_longitude', $_longitude)
                         ->get("address")
                         ->result();
        return $data;
    } // end xAddressCheckInfoControl_model( $_latitude, $_longitude, $Limit = '1' )
    
    /**
     * 
     * @param type $IMEIId
     * @return type
     */
    public function xAddressCheckInfo_model( $IMEIId = false )
    {
        $data = $this->db->select('id, imeiid, latitude, longitude, sensordata')
                         ->where('imeiid', $IMEIId)
                         ->limit(1)
                         ->order_by("id", "desc")
                         ->get("parserldata")
                         ->result();
        return $data; 
    } // end xAddressCheckInfo_model( $IMEIId = false )
    
    
    /**
     * 
     * @param type $FirstDate
     * @param type $LastDate
     * @return type
     */
    public function xMetreGeneral_model( $IMEIID = false, $FirstDate = false, $LastDate = false )
    {
        $ilk = $FirstDate . ' 00:00:10 ';
        $son = $LastDate . ' 23:59:59 ';
        $data = $this->db->where('imeiid', $IMEIID)
                         ->where("(serverdate BETWEEN '" . $ilk . "' AND '" . $son . "')")
                         ->order_by("id", "desc")
                         ->get('parserxdata')
                         ->result(); 
        return $data;
    } // end xMetreGeneral_model( $FirstDate = false, $LastDate = false )
    
    public function xMetreDeviceId_model( $DeviceModel = 'TP03')
    {
        $data = $this->db->where('devicemodel', $DeviceModel)
                         ->order_by("id", "desc")
                         ->get('parsercdata')
                         ->result(); 
        return $data;
    }
    
    public function Accessory_model( $DeviceId )
    {
        $query = $this->db->where('deviceid', $DeviceId)
                          ->order_by("id", "desc")
                          ->get('accessory')
                          ->result();
        return $query;
    }
    
    /**
     * 
     * @param type $IMEIId
     * @param type $Limit
     * @return type
     */
    public function AccessoryxSensor_model( $ImeiId )
    {
        $data = $this->db->select('id, imeiid, sensordata')
                         ->where(array('imeiid' => $ImeiId))
                         ->limit(1)
                         ->order_by("id", "desc")
                         ->get("parserldata")
                         ->result();
        return $data[0];
        
    } // end xStatus_model( $IMEIId )
    
    public function AccessoryxSensorData_model( $LastDataId, $AssanImeiId )
    {
        $data = $this->db->select('id, imeiid, sensordata')
                         ->where(array('imeiid' => $AssanImeiId, 'id >' => $LastDataId))
                         ->limit(1)
                         ->order_by("id", "desc")
                         ->get("parserldata")
                         ->result();
        return $data;
    } // end AccessoryxSensorData_model( $LastDataId, $AssanImeiId )
################################################################################
################################################################################
################################################################################

    public function AssanAreasIzmirDepoCikis_model( $ImeiId )
    {
        $data = $this->db->select('id, imeiid, status, alarm, sensordata')
                         ->where(array('imeiid' => $ImeiId))
                         ->limit(1)
                         ->order_by("id", "desc")
                         ->get("parserldata")
                         ->result();
        return $data[0];
    }
    
}
