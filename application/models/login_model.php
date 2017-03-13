<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of "cpanel_os_view.php" MnetPanel ajax data programming
 * This Admin Panel Homepage OS data json format
 * cPanel_OS_view Class
 * @author NorthStarz
 */
class Login_Model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function index()
    {
        
    }
    
    public function login_modelx( $par )
    {

        $data = $this->db->get_where('mizraklar_web_users', array('useremail' => $par['useremail'], 'userpass' => $this->UserPassCreate($par['password'])));

        return $data->row();
    }
    
    private function UserPassCreate( $par )
    {
        $par = md5($par,"www.marmaranet.net");
        $par = md5($par,"www.resimkalemi.net");
        $par = md5($par,"www.sehirehberi.org");
        $par = base64_encode($par);
        $par = md5($par);
        return $par;
    }
    
}
