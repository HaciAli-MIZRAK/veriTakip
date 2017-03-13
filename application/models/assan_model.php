<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of assan_model
 *
 * @author php developer
 */
class Assan_model extends CI_Model
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
     * @param type $ImeiId
     * @param type $LatsDataId
     * @return strıng
     */
    public function AssanAreas_model( $ImeiId, $LatsDataId = false )
    {
        $data = $this->db->select('id, imeiid, status, alarm, sensordata, serverdate')
                         ->where(array('imeiid' => $ImeiId, 'id >' => $LatsDataId))
                         ->limit(1)
                         ->order_by("id", "desc")
                         ->get("parserldata")
                         ->result();
        if($data)
        {
            return $data[0];  
        } else {
            return '-1'; 
        }
    } // end AssanAreas_model( $ImeiId, $LatsDataId = false )
}
