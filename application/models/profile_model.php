<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 * 
 */
class Profile_Model extends CI_Model
{
    
    /**
     * 
     */
    public function __construct()
    {
        
        parent::__construct();
        
    }
    
    /**
     * 
     */
    public function index()
    {
        
    }
    
    /**
     * @profile_modelx()
     * @param type $userID
     * @param type $par
     * 
     * methodlar geliştirilecek
     */
    public function profile_modelx( $userID, $par )
    {
        
        foreach ($par as $metavalue => $metakey)
        {

            // post ile gelen metavalue değerlerinin var olup olmadığını kontrol ediyoruz.
            $query = $this->db->get_where('usermeta', array('userid' => $userID, 'metakey' => $metavalue)); 
            //return $query->row();
            // burada ise kontrol ettiğimiz değerler varsa güncelliyor yok ise yenisini yazıdırıyoruz.
            if ($query->row()) {
                // güncelleme katmanı
                $this->db->where('userid', $userID);
                $this->db->where('metakey', $metavalue);
                $this->db->update('usermeta', array('userid' => $userID, 'metavalue' => $metakey));
            } else {
                // yeni oluşturma katmanı
                $this->db->insert('usermeta', array('userid' => $userID, 'metavalue' => $metakey, 'metakey' => $metavalue));
            }

        }
        
    } // end profile_modelx( $userID, $par ) 
    
    /**
     * @profile_modeli( $userID )
     * @param type $userID
     * @return type
     * 
     * methodlar geliştirilecek
     */
    public function profile_modeli( $userID ) {
        
        $query = $this->db->get_where('usermeta', array('userid' => $userID));
        return $query->result_array();
        
    } // end profile_modeli( $userID )

}
