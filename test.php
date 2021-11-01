<?php 

$privateKey = 'b7ffc1d48867027bb23ef8bd95bcdb69';
$publicKey = '345543b7ffc1d48867027bb23ef8bd95bcdb69ojhkfdngfs';

$parameters = array('status' => 'upcoming');
$postData = json_encode($parameters);
$accessKey = base64_encode(hash_hmac('sha256', $postData, $privateKey, true));

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://foundico.com/api/v1/filters");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'X-Foundico-Public-Key: '.$publicKey,
    'X-Foundico-Access-Key: '.$accessKey,
]);

$response = curl_exec($ch);
curl_close($ch);
echo $response;

?>