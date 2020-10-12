<?php


  if(!function_exists('excerpt')){
    function excerpt($content,$length){
        $content_ar = explode(' ',$content);
        if(count($content_ar) <= $length )
            return implode(' ',$content_ar);
        $content    = array_splice($content_ar,0,$length);
        $content    = implode(' ',$content);
        return $content.'...';
    }
  }
