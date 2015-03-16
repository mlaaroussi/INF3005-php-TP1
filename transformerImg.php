<?php
header('Content-Type: image/png');
if (isset($GLOBALS["HTTP_RAW_POST_DATA"])) {
  $imageData=$GLOBALS['HTTP_RAW_POST_DATA'];
     
  imagepng($imageData, NULL, 0);
  imagedestroy($imageData);
    
  $filteredData=substr($imageData, strpos($imageData, ",")+1);
  $unencodedData=base64_decode($filteredData);
  $fp = fopen('upload/canvas.png', 'wb' );
  fwrite( $fp, $unencodedData);
  fclose( $fp );
 
}
/*
  $data = substr($_POST['imageData'], strpos($_POST['imageData'], ",") + 1);
        $decodedData = base64_decode($data);
        $fp = fopen("canvas.png", 'wb');
        fwrite($fp, $decodedData);
        fclose();
       // echo "/canvas.png";
 
  $image = base64_decode($data);
  //$image = imageCreateFromPng("img/cadrage.png");
  imagefilter($image, IMG_FILTER_GRAYSCALE);
  header('Content-Type: image/png');
  imagepng($image, NULL, 0);
  imagedestroy($image);
 
 */