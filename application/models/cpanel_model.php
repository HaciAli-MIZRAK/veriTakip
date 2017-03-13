<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * 
 */
class cPanel_model extends CI_Model {
    
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
     * @param type $par
     */
    public function addDevicePlus_model( $par )
    {
        if (array_key_exists("accessory", $par)) {
            $this->db->insert('device', array('deviceimeiid' => trim($par['deviceimeiid']), 'addingdevice' => $this->session->userdata('userid'), 'devicestatus' => '0', 'accessory' => trim($par['accessory']), 'deviceaddingdate' => date('Y-m-d H:i:s')));
            if ($this->db->affected_rows()) {
                $inserId = $this->db->insert_id();
                $a = 1;
                foreach ($par as $metakey => $metavalue){
                    $this->db->insert('devicemeta', array('deviceid' => $inserId, 'deviceimeiid' => trim($par['deviceimeiid']), 'metakey' => $metakey, 'metavalue' => trim($metavalue), 'orderby' => $a++));
                }
            }
        } else {
            $this->db->insert('device', array('deviceimeiid' => trim($par['deviceimeiid']), 'addingdevice' => $this->session->userdata('userid'), 'devicestatus' => '0', 'accessory' => '', 'deviceaddingdate' => date('Y-m-d H:i:s')));
            if ($this->db->affected_rows()) {
                $inserId = $this->db->insert_id();
                $a = 1;
                foreach ($par as $metakey => $metavalue){
                    $this->db->insert('devicemeta', array('deviceid' => $inserId, 'deviceimeiid' => trim($par['deviceimeiid']), 'metakey' => $metakey, 'metavalue' => trim($metavalue), 'orderby' => $a++));
                }
            }
        }
    } // end addDevicePlus_model( $par )
    
    /**
     * 
     * @param type $ImeiId
     * @return type
     */
    public function DeviceControl_model( $ImeiId = false )
    {
        $query = $this->db->get_where('device', array('deviceimeiid' => $ImeiId));
        return $query->result();
    } // end DeviceControl_model( $ImeiId = false )
    
    /**
     * 
     * @param type $userId
     * @return type
     */
    public function DeviceList_model( $userId = false )
    {
        $this->db->select('*');
        $this->db->from('device');
        if($userId) { $this->db->where('addingdevice', $userId); }
        $this->db->order_by("deviceid", "desc");
        $this->db->join('users', 'users.userid = device.addingdevice');
        $query = $this->db->get();
        return $query->result();
    } // end DeviceList_model( $userId = false )
    
    /**
     * DeviceMetaList_model( $deviceId = false, $deviceImeiId = false )
     * @param type $deviceId
     * @param type $deviceImeiId
     * @return type
     * NOT: Bu kısım geliştirilecek.
     */
    public function DeviceMetaList_model( $deviceId = false, $deviceImeiId = false )
    {
        if ($deviceId) {
            $this->db->order_by('orderby', 'asc');
           $query = $this->db->get_where('devicemeta', array('deviceid' => $deviceId)); 
        }
        if ($deviceImeiId) {
            $this->db->order_by('orderby', 'asc');
           $query = $this->db->get_where('devicemeta', array('deviceimeiid' => $deviceImeiId));
        }
        return $query->result();
    } // end DeviceMetaList_model( $deviceId = false, $deviceImeiId = false )
    
    /**
     * 
     * @param type $userId
     * @return type
     */
    public function DeviceImeiId_model( $userId = false )
    {
        $this->db->select('deviceimeiid, addingdevice, devicestatus');
        $this->db->from('device');
        if($userId == true) { $this->db->where('addingdevice', $userId); }
        $this->db->where('devicestatus', '1');
        $query = $this->db->get();
        if ($query->result()) {
            foreach($query->result() as $row){
                $data[] = $row->deviceimeiid;
            }
            return $data;
        }
    } // end DeviceImeiId_model( $userId = false )
    
    /**
     * 
     * @param type $Accessory
     * @return type
     */
    public function AccessoryDeviceImeiId_model( $Accessory )
    {
        $this->db->select('deviceimeiid');
        $this->db->from('device');
        //if($userId == true) { $this->db->where('addingdevice', $userId); }
        $this->db->where('devicestatus', '1');
        $this->db->where('accessory', $Accessory);
        $query = $this->db->get();
        if ($query->result()) {
            foreach($query->result() as $row){
                $data[] = $row->deviceimeiid;
            }
            return $data;
        }
    } // end AccessoryDeviceImeiId_model( $Accessory )
    
    /**
     * 
     * @param type $DeviceImeiId
     * @param type $AdminStatus
     * @return type
     */
    public function DeviceListStatus_model( $DeviceImeiId = false, $AdminStatus = false )
    {
        if ($DeviceImeiId == true || $AdminStatus == true) {
            $this->db->where('deviceimeiid', $DeviceImeiId);
            $query = $this->db->update('device', array('adminstatus' => $AdminStatus, 'devicestatus' => $AdminStatus));
            if ($query) {
                $data[] = array(
                    'status' => $AdminStatus,
                    'deviceimeiid' => $DeviceImeiId
                );
                return $data;
            }
        }
    } // end DeviceListStatus_model( $DeviceImeiId = false, $AdminStatus = false )
    
    /**
     * 
     * @param type $photoIMEI
     * @param type $photo
     * @param type $photoDate
     * @return boolean
     */
    public function atcPhotoFTP_model( $photoIMEI, $photo = false, $photoDate )
    {
        // bu alanda atcphoto tablosunda ekleyeceğimiz photo var mı yok mu bakıyoruz?
        $query = $this->db->get_where('atcphoto', array('photodate' => $photoDate));
        if ($query->row()) {} else {
            if (strlen($photoIMEI) == 17) {
                $linuxDate = strtotime(substr($photoDate, 0, 2) . '.' . substr($photoDate, 2, 2) . '.20' . substr($photoDate, 4, 2) . ' ' . substr($photoDate, 6, 2) . ':' . substr($photoDate, 8, 2) . ':' . substr($photoDate, 10, 2));
                $linuxToDate = date('Y-m-d H:i:s', $linuxDate + 10800);
                $this->db->insert('atcphoto', array('imeiid' => $photoIMEI, 'photoname' => $photo, 'photodate' => $photoDate, 'linuxdate' => $linuxToDate)); 
                return true;
            } else {
                return false;
            }
        }
    } // end atcPhotoFTP_model( $photoIMEI, $photo = false, $photoDate )
    
    /**
     * 
     * @param type $photoIMEI
     * @return type
     */
    public function atcPhotoModal_model( $photoIMEI )
    {
        $this->db->order_by("id", "desc");
        $query = $this->db->get_where('atcphoto', array('imeiid' => $photoIMEI));
        return $query->result();
    } // end atcPhotoModal_model( $photoIMEI )
    
    /**
     * 
     * @param type $IMEIID
     * @return type
     */
    public function SuddenBlockageEngine_model( $IMEIID = false )
    {
        if($IMEIID == true) {
            $data = $this->db->select('id, imeiid, socketorder')
                             ->from('parsercdata')
                             ->where('imeiid', $IMEIID)
                             ->get()
                             ->result();
            return $data[0];
        }
    } // end SuddenBlockageEngine_model( $IMEIID = false )
    
    /**
     * 
     * @param type $IMEIID
     * @return type
     */
    public function SmartClass_model( $IMEIID = false )
    {
        if($IMEIID == true) {
            $data = $this->db->select('id, imeiid, socketorder')
                             ->from('parsercdata')
                             ->where('imeiid', $IMEIID)
                             ->get()
                             ->result();
            return $data[0];
        }
    } // end SmartClass_model( $IMEIID = false )
    
    /**
     * 
     * @param type $IMEIID
     * @return type
     */
    public function FotografCheck_modal( $IMEIID = false )
    {
        if($IMEIID == true) {
            $query = $this->db->select('id, imeiid, socketorder')
                              ->from('parsercdata')
                              ->where('imeiid', $IMEIID)
                              ->get()
                              ->result();
            return $query;
        }
    } // end FotografCheck_modal( $IMEIID = false )
    
    /**
     * 
     * @param type $array
     * @param type $userId
     * @return boolean
     */
    public function xAtcCommand_model( $array = false, $userId = false )
    {
        if($array == true) {
            $data = $this->db->insert('devicecmd', array('userid' => $userId, 'deviceimeiid' => $array['ImeiId'], 'atccommand' => $array['AtcCommand'], 'atcapproval' => '1', 'atcsocketorder' => $array['SocketOrder']));
            if($data) { return true; } else { return false; }
        }
    } // end xAtcCommand_model( $array = false, $userId = false )
    
    /**
     * 
     * @param type $IMEIID
     * @return type
     */
    public function xAtcDeviceCommand_model( $IMEIID = false )
    {
        if($IMEIID == true) {
            $this->db->select('id, imeiid, socketorder');
            $this->db->from('parsercdata');
            if(strlen($IMEIID) == 9){
                $this->db->where('imeiid', '86307101' . $IMEIID);
            } else {
                $this->db->where('imeiid', $IMEIID);
            }
            $query = $this->db->get();
            return $query->result();
        }
    } // end xAtcDeviceCommand_model( $IMEIID = false )
    
    /**
     * 
     * @param type $DeviceClearId
     */
    public function DeviceClearSystem_model( $DeviceClearId = false )
    {
        $this->db->where('deviceimeiid', $DeviceClearId);
        $this->db->delete('device');
    } // end DeviceClearSystem_model( $DeviceClearId = false )
    
    /**
     * 
     * @param type $Accessory
     */
    public function AccessorySave( $Accessory )
    {
        foreach ($Accessory as $metakey => $metavalue) {
            //$this->db->insert('accessory', array('userid' => 1, 'deviceid' => $Accessory['_imeiid'], 'metakey' => $metakey, 'metavalue' => $metavalue));
            // post ile gelen metavalue değerlerinin var olup olmadığını kontrol ediyoruz.
            $query = $this->db->get_where('accessory', array('deviceid' => $Accessory['_imeiid'], 'metakey' => $metakey)); 
            //return $query->row();
            // burada ise kontrol ettiğimiz değerler varsa güncelliyor yok ise yenisini yazıdırıyoruz.
            if ($query->row()) {
                // güncelleme katmanı
                $this->db->where('deviceid', $Accessory['_imeiid']);
                $this->db->where('metakey', $metakey);
                $this->db->update('accessory', array('userid' => 1, 'deviceid' => $Accessory['_imeiid'], 'metakey' => $metakey, 'metavalue' => $metavalue));
            } else {
                // yeni oluşturma katmanı
                $this->db->insert('accessory', array('userid' => 1, 'deviceid' => $Accessory['_imeiid'], 'metakey' => $metakey, 'metavalue' => $metavalue));
            }
        }
    } // end AccessorySave( $Accessory )
}
