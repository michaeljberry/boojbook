<?php

use Carbon\Carbon;

function fileUpload($path, $field, $hasfile, $default = '', $type = ''){
  switch ($type) {
  case 'S3':
    # code...
    break;
  
  default:
  
    $destinationPath = $path;
    if($hasfile){
      if($field->isValid()){
        $filename = $field->getClientOriginalName();
        $extension = $field->getClientOriginalExtension();
        $file = $destinationPath.'/'.pathinfo(str_replace(' ', '_', $filename), PATHINFO_FILENAME).'_'.Carbon::now()->format('Ymdhis').'.'.$extension;
        $field->move($destinationPath, $file);
      }
    } else {
      $file = $default;
    }
    return isset($file) ? $file : '';

    break;
  }
}