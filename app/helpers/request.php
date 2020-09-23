<?php


  if(!function_exists('old_value')){
      function old_value($object,$key){
        return old($key) ? old($key) : ($object->$key ? $object->$key : '');
      }
  }
