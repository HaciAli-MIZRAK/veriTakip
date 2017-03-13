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

class DogaKoleji extends xData
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('dogakoleji_model');
    } // end __construct()
    
    public function index()
    {
        
    } // end index()
    
    /**
     * Doğa Koleji Akıllı Sınıf Aydınlatma, Perdeler, Klimalar ve Sulama Sistemi
     * için kullanılacak ortak FUNCTION alanı
     */
    public function DogaKolejiSmartClassLighting()
    {
        $data = $this->dogakoleji_model->DogaKolejiArea_model( '86107402998424575' );
        if($this->db->affected_rows()) {
            $ArrayDizi = array(
                'SmartClass' => $this->xStatus( $data->status ),
            );
        } else {
            $ArrayDizi = array(
                'error' => 'Yeni veri yok'
            );
        }
        echo json_encode($ArrayDizi);
    } // end DogaKolejiSmartClass()
    
    public function DogaKolejiSmartClassCurtain()
    {
        $data = $this->dogakoleji_model->DogaKolejiArea_model( '86107402998422975' );
        if($this->db->affected_rows()) {
            $ArrayDizi = array(
                'SmartClass' => $this->xStatus( $data->status ),
            );
        } else {
            $ArrayDizi = array(
                'error' => 'Yeni veri yok'
            );
        }
        echo json_encode($ArrayDizi);
    } // end DogaKolejiSmartClassCurtain()
    
    public function DogaKolejiSmartClassAirConditioning()
    {
        $data = $this->dogakoleji_model->DogaKolejiArea_model( '86107402992648575' );
        if($this->db->affected_rows()) {
            $ArrayDizi = array(
                'SmartClass' => $this->xStatus( $data->status ),
            );
        } else {
            $ArrayDizi = array(
                'error' => 'Yeni veri yok'
            );
        }
        echo json_encode($ArrayDizi);
    } // end DogaKolejiSmartClassAirConditioning()
}
