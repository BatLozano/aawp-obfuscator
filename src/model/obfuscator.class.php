<?php
namespace batlz_aawpobf;

class obfuscator{

    public function __construct(){

       \add_filter( 'aawp_func_button' , [$this , "aawp_func_button_filter"] , 1 , 3);
       \add_filter( 'the_content' , [$this , 'filter'] , 100 , 1);

    }

    public function filter($content){

        if(!stristr($content, '<a class="aawp-button')) return $content;

        $rows = explode('<a class="aawp-button' , $content);
        unset($rows[0]);
        foreach($rows as $k => $row){
            $ex             = explode("</a>" , $row);
            $link_content   = $ex[0];
            $new_link       = '<span class="aawp-button '.str_ireplace('href="#"' , '' , $link_content).'</span>';
            $content        = str_replace('<a class="aawp-button'.$link_content.'</a>' , $new_link , $content);
        }


        return $content;
    }

    public function aawp_func_button_filter($button_args, $type, $atts ){

        if(empty($button_args)) return $button_args;

        $button_args["attributes"] = "data-aawp-web=".$this->obfuscate_url($button_args["url"]);
        $button_args["url"]     = "#";
        $button_args["target"]  = "";
        $button_args["rel"]     = "";
        $button_args["classes"] .= " aawp-external-link";

        return $button_args;

    }


    private function obfuscate_url($url){

        $array_characters = str_split($url);
        $array_characters = array_reverse($array_characters);

        $obfuscated_chars = [];
        foreach($array_characters as $caractere) $obfuscated_chars[] = base64_encode(\ord($caractere) + BATLZ_AAWPOBF_OBFUSCATE_NUMBER);
        
        foreach($obfuscated_chars as $k => $char) $obfuscated_chars[$k] = str_ireplace("MT" , "" , $char);
        
        $obfuscated_url = join($obfuscated_chars);
        $obfuscated_url = base64_encode($obfuscated_url);
        
        return $obfuscated_url;
        
    }

}