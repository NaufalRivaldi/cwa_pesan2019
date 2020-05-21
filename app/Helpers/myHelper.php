<?php

function statusFormPenangananIt($status){
  $text = '';
  
  switch ($status) {
    case '1':
      $text = '<span class="badge badge-primary">Pending</span>';
      break;

    case '2':
      $text = '<span class="badge badge-info">Progress</span>';
      break;

    case '3':
      $text = '<span class="badge badge-success">Selesai</span>';
      break;
    
    default:
      $text = '<span class="badge badge-danger">Ditolak</span>';
      break;
  }

  return $text;
}