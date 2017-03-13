<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * 
 */

class Otomat_model extends CI_Model
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
    
    public function TotalMoney_model()
    {
        $data = $this->db->select('*')
                         ->from('parsergmdata')
                         ->where('packetid', '0')
                         ->limit(1)
                         ->order_by("id", "desc")
                         ->get()
                         ->result();
        if ($data)
        {
            return $data[0];  
        } else {
            return false;
        }
        
    }
################################################################################
################################################################################
################################################################################
    
    public function ProductShelf_model( $DataId, $fisrt = false, $last = false )
    {
        $data = $this->db->select('id, gmimeiid, packetid, otomatdata')
                         ->from('parsergmdata')
                         ->where(array('packetid >' => 2, 'id >' => $DataId))
                         ->order_by("id", "desc")
                         ->limit(27)
                         ->get()
                         ->result();
        return $data;
    } // end ProductShelf_model( $fisrt = false, $Last = false )
    
    public function ProductShelfxSensorData_model( $IMEIId, $Limit = 1 )
    {
        $data = $this->db->select('id, imeiid, sensordata')
                         ->where('imeiid', $IMEIId)
                         ->limit($Limit)
                         ->order_by("id", "desc")
                         ->get("parserldata")
                         ->result();
        return $data;
    }
    
}
