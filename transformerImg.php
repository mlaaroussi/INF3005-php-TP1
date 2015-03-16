<?php
/*
  $data = substr($_POST['imageData'], strpos($_POST['imageData'], ",") + 1);
        $decodedData = base64_decode($data);
        $fp = fopen("canvas.png", 'wb');
        fwrite($fp, $decodedData);
        fclose();
        echo "/canvas.png";
 */
  $image = imageCreateFromPng("img/cadrage.png");
  imagefilter($image, IMG_FILTER_GRAYSCALE);
  header('Content-Type: image/png');
  imagepng($image, NULL, 0);
  imagedestroy($image);