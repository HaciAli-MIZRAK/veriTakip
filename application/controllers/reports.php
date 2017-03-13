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

class Reports extends xData {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('xdata_model');
    } // end __construct()
    
    public function index()
    {
        $reports = array(
            $this->SpeedReports()
        );
        echo json_encode($reports);
     } // end index()
    
    public function ActiveReports()
    {
    } // end ActiveReports()
    
    public function SpeedReports()
    {
        $par = explode("_", $this->input->get('ProductReports'));
        $data = $this->xdata_model->xGeneral_model($par[1], '180'); 
        for ($i = 0;$i < count($data);$i++) {
            $ActiveReports[] = array(
                'Date' => $data[$i]->serverdate,
                'Hiz' => $data[$i]->speed
            );
        }
        array_reverse($ActiveReports);
        echo json_encode($ActiveReports);
    } // end SpeedReports()
    
    public function TempReports()
    {
        $par = explode("_", $this->input->get('ProductReports'));
        $data = $this->xdata_model->xGeneral_model($par[1], '180'); 
        for ($i = 0;$i < count($data);$i++) {
            $ActiveReports[] = array(
                'Date' => $data[$i]->serverdate,
                'isi' => $this->MultiSicaklikSensoru00and04( $data[$i]->sensordata )
            );
        }
        array_reverse($ActiveReports);
        echo json_encode($ActiveReports);
    } // end SpeedReports()
    
    
}
