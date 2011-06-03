<?php

  $files = array();
  $path = 'i/s/';

  if ( $dir = opendir( $path ) ) {
    while ( false !== ( $file = readdir( $dir ) ) ){
      switch( mime_content_type( $path.$file ) ) {
        case 'image/jpeg':
        case 'image/jpg':
        case 'image/png':
        case 'image/gif':
          $files[] = $path . $file;
          break;
      }
    }
  }

  $key = ( array_rand( $files ) );

  header('Content-Description: File Transfer');
  header('Content-Type: ' . mime_content_type($files[$key]));
  header('Content-Disposition: attachment; filename='.basename($files[$key]));
  header('Content-Transfer-Encoding: binary');
  header('Expires: 0');
  header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
  header('Pragma: public');
  header('Content-Length: ' . filesize($files[$key]));
  ob_clean();
  flush();
  readfile($files[$key]);

  ?>