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

class Otomat extends xData
{
    public $jsonData = array();
    
    public function __construct()
    {
        parent::__construct();
        $Parametre = array();
        $this->load->library('VendingOtomat', $Parametre);
        $this->load->library('AutoSensor', $Parametre);
        $this->load->model('otomat_model');
    } // end __construct()
    
    public function index()
    {
        echo "otomat";
    } // end index()
    
    /**
     * for ($i = 0;$i < count($data);$i++){
     *     echo $this->hex2bin($data[$i]->otomatdata);   
     * }
     */
    public function TotalMoney_Otomat()
    {
        $data = $this->otomat_model->TotalMoney_model();
        if($data == true)
        {
            $OtomatData = $this->vendingotomat->hex2binTotalMoney($data->otomatdata); 
            $OtomatJson['otomatTotalMoney'] = $this->vendingotomat->TotalMoneyPareser( $OtomatData );
        } else {
            $OtomatJson['otomatTotalMoney'] = '-1';
        }
        echo json_encode($OtomatJson);
    }
    
    ############################################################################
    ############################################################################
    ############################################################################
    /**
     * 
     */
    public function ProductShelf_Otomat()
    {
        $a1 = array(
        "\u0000", "\u0001", "\u0002", "\u0003", "\u0004",
        "\u0005", "\u0006", "\u0007", "\u0008", "\u0009", "\u000A",
        "\u000B", "\u000C", "\u000D", "\u000E", "\u000F", "\u0010", "\u0011",
        "\u0012", "\u0013", "\u0014", "\u0015", "\u0016", "\u0017", "\u0018",
        "\u0019", "\u001A", "\u001B", "\u001C", "\u001D", "\u001E", "\u001F"
        );
        $a2 = array('');
        $OtomatJson = '';
        if($_GET)
        {
            $DataId = $this->input->get('xdataid');
            $data = $this->otomat_model->ProductShelf_model( $DataId );
            $ArrayData['dataId'] = $data[0]->id;
            for ($i = 0;$i < count($data);$i++) {
                $OtomatJson .= $this->vendingotomat->hex2binProductShelf($data[$i]->otomatdata);
            }
            $par1 = explode("\n", $OtomatJson);
            for ($j = 0;$j < count($par1)-1;$j++)
            {
                $this->jsonData[] = trim($par1[$j]);
            }
            if (is_array($this->jsonData))
            {
                $JSONfiltre =  json_encode($this->jsonData, JSON_NUMERIC_CHECK);
                $par = str_replace($a1, $a2, $JSONfiltre);
                $silinsin=array(""," ");
                $Array = json_decode($par);
                $Array = array_diff($Array, $silinsin);
                $ProductShelf = array_chunk($Array, 4);
                $ProductShelf = array(
                    'ProductShelf' => array_reverse($ProductShelf)
                );
            }
            $ArrayId = array_merge($ArrayData, $ProductShelf);
            echo json_encode($ArrayId);
        }
        
    } // end ProductShelf_Otomat()
    
    
    public function ProductShelfxSensorData()
    {
        $data = $this->otomat_model->ProductShelfxSensorData_model( '86107402547416775' );
        $LBSData = $this->autosensor->AutoSensorControl( $data[0]->sensordata );
        $GSMLAT = $LBSData['Sensor13']['GSMLokasyon']['gsmlat'];
        $GSMLNG = $LBSData['Sensor13']['GSMLokasyon']['gsmlng'];
        $GSMLATLNG = array(
            'GsmLat' => $GSMLAT,
            'GsmLng' => $GSMLNG
        );
        echo json_encode($GSMLATLNG);
    }
    ############################################################################
    ############################################################################
    ############################################################################

}
