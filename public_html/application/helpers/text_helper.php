<?php

function url_reformat($array) {
    $CI =& get_instance(); 
    $CI->webconfig = $CI->config->item('webconfig');

    $day = isset($array['created_at'])?date('d', strtotime($array['created_at'])):0;
    $month = isset($array['created_at'])?date('m', strtotime($array['created_at'])):0;
    $year = isset($array['created_at'])?date('Y', strtotime($array['created_at'])):0;
    $id = isset($array['id'])?$array['id']:0;
    $slug = isset($array['slug'])?addslashes($array['slug']):'-';
    $id_category = isset($array['id_category'])?$array['id_category']:'1';
   

    if($CI->webconfig['category-id-berita'] == $id_category){
      $url_tipe = "berita";
    } elseif($CI->webconfig['category-id-grafik'] == $id_category){
      $url_tipe = "grafik";
    } elseif($CI->webconfig['category-id-analisis'] == $id_category){
      $url_tipe = "analisa";
    } elseif($CI->webconfig['category-id-video'] == $id_category){
      $url_tipe = "video";
    } else{
      $url_tipe = "";
    }    
    return base_url().$url_tipe.'/'.$year.'/'.$month.'/'.$day.'/'.$slug;  

}
