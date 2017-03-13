<?php
function languageSelect( $Lang = false)
{
    if($Lang == false){
        if(substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2) == 'tr'){
            return $language = 'turkish';  
        } else
        if(substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2) == 'en'){
            return $language = 'english';
        }
    } else
    if($Lang == 'tr'){
        return $language = 'turkish';
    } else
    if($Lang == 'en'){
        return $language = 'english';
    } else 
    if($Lang == 'irn'){
        return $language = 'farsca';
    }
 } // end language_select()
?>