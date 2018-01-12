<?php
$access_token = 'มหาวิทยาลัยราชภัฏมหาสารคาม';

$url = 'FTAdDbJGsMUtmLTNqwOjUIe7qr0BGt/2y53y5kLiBEletJdkqL14wFVXbeIl5CiqSw6n/iXXq+96GzgacfYNnf3apBSlWAfmey+QSWx2lcrQF87OX5WmzePZar5mos520Tu0IaQvAmOsjbNCSD8+4QdB04t89/1O/w1cDnyilFU=';

$headers = array('Authorization: Bearer'.$access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;
