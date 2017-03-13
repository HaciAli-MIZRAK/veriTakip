<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of "cpanel_os_view.php" MnetPanel ajax data programming
 * This Admin Panel Homepage OS data json format
 * cPanel_OS_view Class
 * @author NorthStarz
 */

class VendingOtomat
{
    public function __construct()
    {        
    } // end __construct()
    
    public function index()
    {        
    } // end index()
    
    /**
     * 
     * @param type $parametre
     * @return type
     */
    public function TotalMoneyPareser( $parametre = false )
    {
        setlocale(LC_MONETARY, 'tr_TR');
        $parametre = rtrim($parametre, "\n");
        $par  = explode("\n", $parametre);
        $pars = explode("*", $par[5]);
        //if (function_exists("money_format")) {
        //    return money_format('%i', $pars[1]);
        //} else {
            return number_format(($pars[1] - 002)/100, 2, ',', '.');
        //}
    } // end TotalMoneyPareser()
    
    /**
     * 
     * @param type $parametre
     */
    public function ProductShelfPareser( $parametre = false, $value )
    {
        $parametre = rtrim($parametre, "\n");
        $pars = explode("\n", $parametre);
        //$pars = explode("*", $pars[0]);
        //$parss = explode("*", $pars[0]);
        //if(in_array("PA2*" . $value . "*100", $pars))
        //{
            $arrad[] = $pars[1];
            $arrad[] = $pars[2];
            $arrad[] = $pars[3];
            $arrad[] = $pars[4];
            $arradx = explode("*", $arrad[0]);
            $arradxx = explode("*", $arrad[1]);
            $arradxxx = explode("*", $arrad[2]);
            $arradxxxx = explode("*", $arrad[3]);
            $dizimiz = array_merge($arradx, $arradxx, $arradxxx, $arradxxxx);
            return ($pars); 
        //}
        //return $pars;
    } // end ProductShelfPareser( $parametre = false )
    
    
    /**
     * 
     * @param type $str
     * @return type
     */
    public function hex2binTotalMoney( $parametre = false )
    {
        $sbin = "";
        $search = array("F" ,"X", "$" ,"v", "q", "!",
                        "_", "n", "~", "[", "]", "?",
                        "@", "^", "o", " ", ")", "\t",
                        "\r", "'", "&nbsp", "&nbsp;",
                        ">", "\"", "Q", "u", "N", "&",
                        "??-???@???)???", "j", "J", "`",
                        "-", "p", "+", "O", ":", "\\", "/"
        );
        $instead = array("");
        $len = strlen( $parametre );
        for ( $i = 0; $i < $len; $i += 2 ) {
            $hextoascii = pack( "H*", substr( $parametre, $i, 2 ) );
            $utf8to     = utf8_decode($hextoascii);
            if(!strstr($sbin, "EA"))
            {
                $sbin .= str_replace($search, $instead, $utf8to);
            }
        }
        return strstr($sbin, "VA"); 
    } // end hex2bin( $str )
    
    /**
     * 
     * @param type $str
     * @return type
     */
    public function hex2binProductShelf( $parametre = false )
    {
        $sbin = "";
        $search = array("F" ,"X", "$" ,"v", "q", "!",
                        "_", "n", "~", "[", "]", "?",
                        "@", "^", "o", " ", ")", "\t",
                        "\r", "'", "&nbsp", "&nbsp;",
                        ">", "\"", "Q", "u", "N", "&",
                        "??-???@???)???", "j", "J", "`",
                        "-", "p", "+", "O", ":", "\\", "/",
                        "}", "{", "("
        );
        $instead = array("");
        $len = strlen( $parametre );
        for ( $i = 0; $i < $len; $i += 2 ) {
            $hextoascii = pack( "H*", substr( $parametre, $i, 2 ) );
            $utf8to     = utf8_decode($hextoascii);
            if(!strstr($sbin, "EA"))
            {
                $sbin .= str_replace($search, $instead, $utf8to);
            }
        }
        return strstr($sbin, "PA"); 
    } // end hex2bin( $str )

}
