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

class DogaKoleji_model extends CI_Model
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
    public function DogaKolejiArea_model( $ImeiId )
    {
        //, 'id >' => $LatsDataId
        //$LatsDataId = false
        $data = $this->db->select('id, imeiid, status, alarm, sensordata, serverdate')
                         ->where(array('imeiid' => $ImeiId))
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
        
    } // end DogaKolejiArea_model( $ImeiId, $LatsDataId = false )
}
